<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 * @package App\Http\Requests\Admin
 */
class SectionStoreRequest extends FormRequest
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
            'ru' => 'sometimes|string',
            'en' => 'sometimes|string',
            'am' => 'sometimes|string',
            'parent_id' => 'nullable|numeric',
        ];
    }



}
