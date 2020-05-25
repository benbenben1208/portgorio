<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;
class CsvDownloadController extends Controller
{
   

    public function download_users()
    {
        $users = User::all();
        $filename = "user_profiles_".date('Ymd').".csv";
        
        $stream = fopen('php://temp','w');

        foreach($users as $user) {

            fputcsv($stream, $user->toArray());
        }
       
        
        rewind($stream);

        $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename"' . $filename . '"'
        ];
        
        return \Response::make($csv, 200, $headers);


    }
    public function download_flozened()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        
        $filename = "flozened_user_profiles_".date('Ymd').".csv";
        
        $stream = fopen('php://temp','w');

        foreach($users as $user) {

            fputcsv($stream, $user->toArray());
        }
       
        
        rewind($stream);

        $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename"' . $filename . '"'
        ];
        
        return \Response::make($csv, 200, $headers);


    }
}
