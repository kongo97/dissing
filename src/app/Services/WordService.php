<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Word;

use Mailgun\Mailgun;

class WordService
{

    public static function getWords()
    {
        $words = Word::inRandomOrder()->take(500)->get();

        return $words;
    }

}