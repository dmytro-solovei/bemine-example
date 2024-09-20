<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
//use voku\helper\AntiXSS;

/**
 * Class Requests
 * @package App\Http\Requests
 *
 */
abstract class Request extends FormRequest
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
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        //TODO: remove after tasks
        if($this->get('_debug')) {
            dd($validator->errors());
        }

        throw new HttpResponseException(response()->json(['status' => 'failure'], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * @param array $arInsert
     * @return array
     */
    public function sanitize(array $arInsert): array
    {
//        array_walk_recursive($arInsert, function (&$value) {
//            $value = app(AntiXSS::class)->xss_clean($value);
//        });

        return $arInsert;
    }
}
