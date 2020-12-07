<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Google_Client;
use App\Services\YoutubeService;

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

    public function oauth2callback(Request $request)
    {
        $auth_url = YoutubeService::oauth2callback($request);
        
        return redirect($auth_url);
    }
}
