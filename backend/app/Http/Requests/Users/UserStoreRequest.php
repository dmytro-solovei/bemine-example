<?php namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 * @package App\Http\Requests\Users
 */
class UserStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'username' => 'required|string',
            'avatar' => 'nullable|image',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'active' => 'required|in:true,false,0,1,on,off',
            'verified' => 'required|in:true,false,0,1,on,off',
        ];
    }



}
