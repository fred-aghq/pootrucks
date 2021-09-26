<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Util\Test;
use Tests\TestCase;

class MissionStoreTest extends TestCase
{
    public function test_it_accepts_xml()
    {
        $xml = file_get_contents(base_path('tests/data/poo.xml'));
        $res = $this->postXML(route('missions.store'), $xml);
        $res->assertOk();
        dump($res->json());
    }

    protected function postXML(string $uri, string $xml)
    {
        return $this->call('POST', $uri, [], [], [], [], $xml);
    }
}
