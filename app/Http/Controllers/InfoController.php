<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Token;

class InfoController extends Controller
{
    public function input()
    {
        return view('infos.input');
    }

    public function get(Request $request)
    {
        $token = $request['token'];
        $strings = [
            'str' => $token,
        ];
        return redirect(route('info.output'))->withInput($strings);
    }

    public function output(Request $request)
    {
        $token = $request->old('str');

        $http_header = [
            'Content-Type: application/json; charser=UTF-8',
            'Authorization: Bearer ' . $token,
        ];
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $http_header);

        $page = 1;
        $ii = 1;
        $output = 0;

        while ($output !== '[]' && $ii <= 100) {
            curl_setopt($curl, CURLOPT_URL, "https://qiita.com/api/v2/authenticated_user/items?page={$page}&per_page=100");
            $output = curl_exec($curl);
            $decode_res[] = json_decode($output);
            $page++;
            $ii++;
        }
        Log::debug($ii);          

        curl_close($curl);

        return view('infos.output', ['decode_res' => $decode_res]);
        //情報→https://www.php.net/manual/ja/function.curl-setopt-array.php
        //https://www.php.net/manual/ja/function.curl-setopt.php
        //情報→https://www.php.net/manual/ja/function.curl-init.php
        //https://www.php.net/manual/ja/function.curl-setopt.php
    }
}
