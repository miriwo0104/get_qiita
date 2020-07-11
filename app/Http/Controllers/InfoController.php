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
        $current_user_id = Auth::id();
        $new_token = new Token();
        $new_token->user_id = $current_user_id;
        $new_token->token = $request['token'];
        $new_token->save();

        return redirect()->route('home');
    }

    public function output()
    {
        $current_user_id = Auth::id();
        $current_user_info = Token::firstWhere('user_id', $current_user_id);
        

        $http_header = [
            'Content-Type: application/json; charser=UTF-8',//https://www.php.net/manual/ja/function.curl-setopt.php
            'Authorization: Bearer ' . "98c745aff6c68a9c115aa1406b509b4346ef66e0",
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
    }

    public function markdown_output()
    {
        $current_user_id = Auth::id();
        $current_user_info = Token::firstWhere('user_id', $current_user_id);
        

        $http_header = [
            'Content-Type: application/json; charser=UTF-8',//https://www.php.net/manual/ja/function.curl-setopt.php
            'Authorization: Bearer ' . "98c745aff6c68a9c115aa1406b509b4346ef66e0",
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

        return view('infos.markdown_output', ['decode_res' => $decode_res]);
        //情報→https://www.php.net/manual/ja/function.curl-setopt-array.php
        //https://www.php.net/manual/ja/function.curl-setopt.php
        //情報→https://www.php.net/manual/ja/function.curl-init.php
    }
}
