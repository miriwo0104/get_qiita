<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//        $current_user_info = Token::where('user_id', $current_user_id)->get();
        $current_user_info = Token::firstWhere('user_id', $current_user_id);
        // curlの初期化
        $ch = curl_init();
        // 使用するURL
        $url = "https://qiita.com/api/v2/authenticated_user/items?page=1&per_page=1";
        // curlのオプション設定
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                // データの形式、文字コード記載
                'Content-Type: application/json; charser=UTF-8',
                // 自身のアクセストークン
                'Authorization: Bearer ' . $current_user_info['token'],
            ),
            // 返り値を文字列で取得
            CURLOPT_RETURNTRANSFER => true,
            // HTTPメソッド指定
            CURLOPT_CUSTOMREQUEST => 'GET',
        );
        // 複数のオプションを設定
        curl_setopt_array($ch, $options);
        // curlの実行
        $json = curl_exec($ch);
        // curlを閉じる
        curl_close($ch);
        // json文字列をデコード
        $decode_res = json_decode($json);
        return view('infos.output', ['decode_res' => $decode_res]);
    }
}
