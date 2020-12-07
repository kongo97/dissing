<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Mail\RegistrationMail;
use App\Services\HelpService;
use App\Models\User;
use Carbon\Carbon;
use \Google_Client;
use \Google_Service_YouTube;
use Illuminate\Http\Request;

use Mailgun\Mailgun;

class YoutubeService
{

    public static function search(Request $request, $search)
    {
        $client = new Google_Client();
        $client->setAuthConfig(env('YOUTUBE_API_PATH'));
        $client->addScope(GOOGLE_SERVICE_YOUTUBE::YOUTUBE_FORCE_SSL);

        $response = [];

        if ($request->session()->has('access_token')) 
        {
            $client->setAccessToken($request->session()->get('access_token'));
            $youtube = new Google_Service_YouTube($client);

            $queryParams = [
                'maxResults' => 25,
                'q' => $search
            ];
            
            $list = $youtube->search->listSearch('snippet', $queryParams);

            $response = [
                'auth' => true,
                'response' => json_encode($list)
            ];
        } 
        else {
            $redirect_uri = env('APP_URL') . '/oauth2callback';

            return redirect($redirect_uri);
        }

        return $response;
    }


    public static function oauth2callback(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfigFile(env('YOUTUBE_API_PATH'));
        $client->setRedirectUri(env('APP_URL') . '/oauth2callback');
        $client->addScope(GOOGLE_SERVICE_YOUTUBE::YOUTUBE_FORCE_SSL);

        $response = [];

        if (! isset($_GET['code'])) 
        {
            $auth_url = $client->createAuthUrl();

            return $auth_url;
        } 
        else 
        {
            $client->authenticate($_GET['code']);
            $request->session()->put('access_token', $client->getAccessToken());
            $redirect_uri = env('APP_URL');

            return $redirect_uri;
        }

        return $response;
    }

}