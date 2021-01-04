<?php

namespace App\Services;


use App\Models\Advertisement;
use Carbon\Carbon;
use Exception;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.weather.key');
    }

    public function getWeather(Advertisement $advertisement)
    {
        $weathers = null;
        if ($advertisement->latitude && $advertisement->longitude) {
            $weathers = $this->current($advertisement);
            $weathers['daily'] = $this->oneCall($advertisement);
        }

        return $weathers;

    }

    public function current(Advertisement $advertisement)
    {
        $url = 'https://api.openweathermap.org/data/2.5/find?lat=' . $advertisement->latitude . '&lon=' . $advertisement->longitude . '&lang=' . app()->getLocale() .
            '&cnt=1&units=metric&appid=' . $this->apiKey;
        $response = file_get_contents($url);

        return $this->parseCurrentResponse($response);
    }

    public function oneCall(Advertisement $advertisement)
    {
        $url = 'https://api.openweathermap.org/data/2.5/onecall?lat=' . $advertisement->latitude . '&lon=' . $advertisement->longitude . '&lang=' . app()->getLocale() .
            '&exclude=current,hourly&cnt=1&units=metric&appid=' . $this->apiKey;
        $response = file_get_contents($url);
        return $this->parseOneCallResponse($response);

    }

    public function parseOneCallResponse(string $response)
    {
        $response = json_decode($response, TRUE);
        if (isset($response['cod'])) {
            if($response['cod'] == 401 || $response['cod'] == 404 || $response['cod'] == 419){
                throw new Exception($response['message']);
            }

        }
        $weathers = [];
        for ($i = 1; $i <= 3; $i++) {
            $weather['date'] = Carbon::parse($response['daily'][$i]['dt'])->format('d-m-Y');
            $weather['day'] = $response['daily'][$i]['temp']['day'];
            $weather['night'] = $response['daily'][$i]['temp']['night'];
            $weathers[] = $weather;
        }
        return $weathers;
    }

    public function parseCurrentResponse(string $response)
    {
        $response = json_decode($response, TRUE);
        if (!isset($response['cod'])) {
            if($response['cod'] == 401 || $response['cod'] == 404 || $response['cod'] == 419){
                throw new Exception($response['message']);
            }
            if($response['cod'] != 200){
                return FALSE;
            }
        }
        $response = $response['list'][0];
        return [
            'city' => $response['name'],
            'current' => [
                'temp' => $response['main']['temp'] . '°C',
                'pressure' => intval($response['main']['pressure'] / 1.333) . 'мм рт. ст.',
                'humidity' => $response['main']['humidity'],
                'description' => $response['weather'][0]['description'],
                'icon' => 'https://openweathermap.org/img/wn/' . $response['weather'][0]['icon'] . '@2x.png'
            ],

        ];

    }
}