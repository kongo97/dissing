<?php

namespace Database\Seeders;
use App\Models\Word;

use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = public_path().'/words.italian.txt';
        $contents = file($filename);

        foreach($contents as $line) {
            $word = trim($line);

            Word::create([
                'word' => $word
            ]);
        }

    }
}
