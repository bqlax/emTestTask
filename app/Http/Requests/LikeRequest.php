<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Exception;

class LikeRequest extends FormRequest
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
     * @return array
     * @throws Exception
     */
    public function rules()
    {
        //Check available request fields
        $available = ['photo_id', 'news_id', '_token'];
        foreach ($this->request->all() as $key => $value) {
            if (!in_array($key, $available)) {
                throw new Exception('Нет таких полей!');
            }
        }
        return [
            'news_id' => "sometimes|required|integer",
            'photo_id' => "sometimes|required|integer"
        ];
    }
}
