<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ColorStoreRequest
 * @package App\Http\Requests\Admin
 */
class ColorStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:colors',
            'code' => 'required|string|unique:colors',
            'description' => 'required|string',
        ];
    }

}
