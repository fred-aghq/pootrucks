<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Util\Test;
use Tests\TestCase;

class MissionStoreTest extends TestCase
{
    public function test_it_accepts_json()
    {
        $xml = file_get_contents(base_path('tests/data/poo.xml'));
        $payload = (array) new \SimpleXMLElement($xml);
        $res = $this->json('POST', route('missions.store'), $payload);
        $res->assertOk();
    }

    /**
     * @param string $uri
     * @param string $xml
     * @return \Illuminate\Testing\TestResponse
     * @deprecated we're switching to JSON
     */
    protected function postXML(string $uri, string $xml)
    {
        return $this->call('POST', $uri, [], [], [], [], $xml);
    }
}
