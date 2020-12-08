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
use App\Models\Beat;

use Mailgun\Mailgun;

class BeatService
{

    public static function getBeat()
    {
        $count = count(Beat::all());
        $random = rand(1, $count);
        $beat = Beat::inRandomOrder()->first();

        return $beat;
    }

}