<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Google_Client;
use App\Services\YoutubeService;
use App\Services\BeatService;
use App\Services\WordService;


class YoutubeController extends Controller
{
    public function index()
    {
        return view('layouts/app', ['title' => 'Home', 'page' => 'home']);
    }

    public function search(Request $request)
    {
        $auth_url = YoutubeService::search($request, $request->post('search'));
        
        $response = false;
        
        if(is_array($auth_url) && isset($auth_url['auth']) && $auth_url['auth'])
            $response =  $auth_url['response'];
        else
            return redirect('oauth2callback');
        
        return $response;
    }

    public function getBeat()
    {
        $beat = BeatService::getBeat();

        return json_encode($beat);
    }

    public function getWords()
    {
        $words = WordService::getWords();

        return json_encode($words);
    }

    public function oauth2callback(Request $request)
    {
        $auth_url = YoutubeService::oauth2callback($request);
        
        return redirect($auth_url);
    }
}
