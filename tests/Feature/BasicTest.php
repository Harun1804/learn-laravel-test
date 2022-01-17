<?php

namespace Tests\Feature;

use App\Services\Box;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasicTest extends TestCase
{
    public function testBoxContents()
    {
        $box = new Box(['toy']);
        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }

    public function testTakeOneFromTheBox()
    {
        $box = new Box(['torch']);
        $this->assertEquals('torch',$box->takeOne());

        $this->assertNull($box->takeOne());
    }

    public function testStartsWithALetter()
    {
        $box = new Box(['toy','torch','ball','cat','tissue']);
        $result = $box->startsWith('t');

        $this->assertCount(3,$result);
        $this->assertContains('toy',$result);
        $this->assertContains('torch',$result);
        $this->assertContains('tissue',$result);

        //empty array if passed even
        $this->assertEmpty($box->startsWith('s'));
    }
}
