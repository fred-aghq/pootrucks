<?php

namespace App\Transformers;

use App\Http\Requests\MissionStoreRequest;
use League\Fractal\TransformerAbstract;

class MissionStoreXMLTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(string $xmlContent)
    {
        return (array) new \SimpleXMLElement($xmlContent);
    }
}
