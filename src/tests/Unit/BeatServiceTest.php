<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\BeatService;

class BeatServiceTest extends TestCase
{
    // ./vendor/bin/phpunit --filter testGet tests/Unit/BeatServiceTest.php
    public function testGetBeat()
    {
        $youtube = BeatService::getBeat();
        $this->assertNotNull($youtube);
    }
}
