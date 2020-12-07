<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\YoutubeService;

class YoutubeServiceTest extends TestCase
{
    // ./vendor/bin/phpunit --filter testStart tests/Unit/YoutubeServiceTest.php
    public function testStart()
    {
        $youtube = YoutubeService::start();
        $this->assertNotNull(true);
    }
}
