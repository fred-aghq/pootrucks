<?php

namespace Tests\TestConcerns;
use Illuminate\Testing\TestResponse;

trait PostsXML
{
    protected function xmlToArray(string $xml): array
    {
        return (array) new \SimpleXMLElement($xml);
    }

    protected function loadXMLFile(string $relPath): string
    {
        return file_get_contents(base_path('tests/data/' . $relPath));
    }

    /**
     * @param string $uri
     * @param string $xml
     * @return \Illuminate\Testing\TestResponse
     * @deprecated we're switching to JSON
     */
    protected function postRawXML(string $uri, string $xml): TestResponse
    {
        return $this->call('POST', $uri, [], [], [], [], $xml);
    }
}
