<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SlideGroupUpdateRequest
 * @package App\Http\Requests\Admin
 */
class SlideGroupUpdateRequest extends FormRequest
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
            'name' => 'required|string|unique:slide_groups,name,' . $this->slide,
            'active' => 'in:true,false,0,1,on,off',
        ];
    }

}
