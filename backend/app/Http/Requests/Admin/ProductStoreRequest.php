<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductStoreRequest
 * @package App\Http\Requests\Admin
 */
class ProductStoreRequest extends FormRequest
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
            'title' => 'required|string',
            'brand' => 'required|numeric|exists:App\Models\Brand,id',
            'avatar' => 'required|image',
            'old_price' => 'nullable|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
            'viewed' => 'nullable|numeric|gt:0',
            'stars_rate' => 'nullable|numeric|gt:0',
            'description' => 'required|string',
            'active' => 'required|in:true,false,0,1,on,off',
            'gallery' => 'required|array',
            'gallery.*.sizes' => 'required|array',
            'gallery.*.color' => 'required|numeric',
            'gallery.*.images' => 'required|array',
            'gallery.*.images.*' => 'required|image',
            'sections' => 'required|array',
            'sections.*' => 'required|numeric',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|numeric',
            'sort' => 'required|numeric',
        ];
    }

}
