<?php

namespace App\Services;


use App\Models\Advertisement;

class Export
{
    public function advertisements(){
        $fileName = 'tasks.csv';
        $advertisements = Advertisement::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Image', 'Title', 'Created At', 'Description','Phone', 'Country', 'Email', 'Address', 'Author email');

        $callback = function() use($advertisements, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($advertisements as $advertisement) {
                $row['Image'] = $advertisement->hasMedia('advertisement') ? $advertisement
                    ->getFirstMedia('advertisement')->getFullUrl() : '';
                $row['Title']  = $advertisement->title;
                $row['Created At'] = $advertisement->created_at;
                $row['Description']    = $advertisement->description;
                $row['Phone']  = $advertisement->phone;
                $row['Country']  = $advertisement->country;
                $row['Email'] = $advertisement->email;
                $row['Address'] = $advertisement->address;
                $row['Author email'] = $advertisement->user->email;

                fputcsv($file, array($row['Title'], $row['Assign'], $row['Description'], $row['Start Date'], $row['Due Date']));
            }

            fclose($file);
        };


        return response()->stream($callback, 200, $headers);
    }

}