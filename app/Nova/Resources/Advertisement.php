<?php

namespace App\Nova\Resources;

use App\Nova\Resource;
use Bissolli\NovaPhoneField\PhoneNumber;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Jagdeepbanga\NovaDateTime\NovaDateTime as DateTime;
use Whitecube\NovaGoogleMaps\GoogleMaps;

class Advertisement extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Advertisement::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('User', 'user', User::class),
            Trix::make('Description')->hideFromIndex(),

            PhoneNumber::make('Phone Number', 'phone')
                ->rules('required')
                ->hideFromIndex(),

            Country::make('Country')->rules('required')->hideFromIndex(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->hideFromIndex(),

            DateTime::make('End Date')
                ->pickerDefaultHour(23)
                ->pickerDefaultMinute(59)
                ->pickerDefaultSeconds(59)
                ->rules('required')
                ->hideFromIndex()
                ->hideFromDetail(),

            Files::make('Image', 'advertisement'),

            GoogleMaps::make('Map')
                ->zoom(8)
                ->hideFromIndex()

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
