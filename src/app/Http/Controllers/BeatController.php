<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BeatService;

class BeatContoller extends Controller
{
    public function getBeat()
    {
        $beat = BeatService::getBeat();

        return json_encode($beat);
    }
}
