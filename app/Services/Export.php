<?php

namespace App\Services;

use App\Jobs\DeleteFileJobs;
use App\Models\Advertisement;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\File;


class Export
{
    public static function advertisements()
    {
        $fileName = 'advertisements.csv';
        if (!File::exists(public_path($fileName))) {
            $advertisements = Advertisement::all();

            $columns = array('Image', 'Title', 'Created_at', 'Description', 'Phone', 'Country', 'Email', 'Address', 'Author_email');

            $file = fopen(public_path($fileName), 'w');
            header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv, charset=UTF-8');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            fputcsv($file, $columns);

            foreach ($advertisements as $advertisement) {
                $row['Image'] = $advertisement->hasMedia('advertisement') ? $advertisement
                    ->getFirstMedia('advertisement')->getFullUrl() : '';
                $row['Title'] = $advertisement->title;
                $row['Created_at'] = $advertisement->created_at;
                $row['Description'] = $advertisement->description;
                $row['Phone'] = $advertisement->phone;
                $row['Country'] = $advertisement->country;
                $row['Email'] = $advertisement->email;
                $row['Address'] = $advertisement->address;
                $row['Author_email'] = $advertisement->user->email;

                fputcsv($file, array($row['Image'], $row['Title'], $row['Created_at'], $row['Description'], $row['Phone'],
                    $row['Country'], $row['Email'], $row['Address'], $row['Author_email']));
            }
            fclose($file);
            dispatch((new DeleteFileJobs($fileName))->delay(now()->addMinutes(15)));
        }
        return url($fileName);
    }

    public static function users()
    {
        $fileName = 'users.csv';
        if (!File::exists(public_path($fileName))) {
            $users = User::all();

            $columns = array('First_name', 'Last_name', 'Email', 'Advertisements_qty');

            $file = fopen(public_path($fileName), 'w');
            header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv, charset=UTF-8');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                $row['First_name'] = $user->first_name;
                $row['Last_name'] = $user->last_name;
                $row['Email'] = $user->email;
                $row['Advertisements_qty'] = $user->advertisements->count();

                fputcsv($file, array($row['First_name'], $row['Last_name'], $row['Email'], $row['Advertisements_qty']));
            }
            fclose($file);
            dispatch((new DeleteFileJobs($fileName))->delay(now()->addMinutes(15)));
        }
        return url($fileName);
    }

    public static function comments(Advertisement $advertisement)
    {
        $fileName = 'comments' . $advertisement->id . '.csv';
        if (!File::exists(public_path($fileName))) {
            $comments = $advertisement->comments;
            $columns = array('User_name', 'User_email', 'Created_at', 'Content');

            $file = fopen(public_path($fileName), 'w');
            header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv, charset=UTF-8');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            fputcsv($file, $columns);
            foreach ($comments as $comment) {
                $row['User_name'] = $comment->user->name;
                $row['User_email'] = $comment->user->email;
                $row['Created_at'] = $comment->created_at;
                $row['Content'] = $comment->content;

                fputcsv($file, array($row['User_name'], $row['User_email'], $row['Created_at'], $row['Content']));
            }
            fclose($file);
        }
        return url($fileName);
    }
}