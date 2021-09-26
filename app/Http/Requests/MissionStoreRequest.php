<?php

namespace App\Http\Requests;

use App\Transformers\MissionStoreXMLTransformer;
use Illuminate\Foundation\Http\FormRequest;

class MissionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'parsed' => fractal($this->getContent(), new MissionStoreXMLTransformer()),
        ]);
    }
}
