<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beat;

class BeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beat::create([
            'id_youtube' => 'vjWwR5FGj1k',
            'title' => 'reestyle Rap Beat | Hard Boom Bap Type Beat | Hip Hop Instrumental - &quot;Behind Barz&quot;',
            'channel' => 'UCsdTY8O8fMWJ_m4nNpy9JZg',
            'description' => 'Freestyle Rap Beat | Hard Boom Bap Type Beat | Hip Hop Instrumental - Behind Barz',
            'img_url' => 'https://i.ytimg.com/vi/vjWwR5FGj1k/default.jpg',
            'youtube_data' => '{
                "etag":"0dSWvYYtjE0ypNbo7q2veN5AUhg",
                "kind":"youtube#searchResult",
                "id":{
                   "channelId":null,
                   "kind":"youtube#video",
                   "playlistId":null,
                   "videoId":"vjWwR5FGj1k"
                },
                "snippet":{
                   "channelId":"UCsdTY8O8fMWJ_m4nNpy9JZg",
                   "channelTitle":"Anabolic Beatz",
                   "description":"Freestyle Rap Beat | Hard Boom Bap Type Beat | Hip Hop Instrumental - \"Behind Barz\" ○  Purchase | Instant Download (untagged): https://bsta.rs/0ba69f2b ...",
                   "liveBroadcastContent":"none",
                   "publishedAt":"2020-02-25T18:00:11Z",
                   "title":"Freestyle Rap Beat | Hard Boom Bap Type Beat | Hip Hop Instrumental - &quot;Behind Barz&quot;",
                   "thumbnails":{
                      "default":{
                         "height":90,
                         "url":"https://i.ytimg.com/vi/vjWwR5FGj1k/default.jpg",
                         "width":120
                      },
                      "medium":{
                         "height":180,
                         "url":"https://i.ytimg.com/vi/vjWwR5FGj1k/mqdefault.jpg",
                         "width":320
                      },
                      "high":{
                         "height":360,
                         "url":"https://i.ytimg.com/vi/vjWwR5FGj1k/hqdefault.jpg",
                         "width":480
                      }
                   }
                }
             }',
        ]);
    }
}
