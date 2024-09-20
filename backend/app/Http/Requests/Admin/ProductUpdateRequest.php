<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductUpdateRequest
 * @package App\Http\Requests\Admin
 */
class ProductUpdateRequest extends FormRequest
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
            'avatar' => 'nullable|image',
            'old_price' => 'nullable|numeric|gt:0',
            'price' => 'required|numeric|gt:0',
            'viewed' => 'nullable|numeric|gt:0',
            'stars_rate' => 'nullable|numeric|gt:0',
            'description' => 'required|string',
            'gallery.*.images.*' => 'nullable|image',
            'sizes' => 'nullable|array',
            'sizes.*' => 'required|array',
            'sizes.*.*' => 'required|numeric',
            'existing_gallery' => 'nullable|array',
            'existing_gallery.*' => 'nullable|array',
            'popular_by' => 'array',
            'popular_by.*' => 'in:true,false,0,1,on,off',
            'slide_groups' => 'array',
            'slide_groups.*' => 'numeric',
            'additional' => 'nullable|array',
            'information' => 'nullable|array',
            'available' => 'required|string',
            'sections' => 'required|array',
            'sections.*' => 'required|numeric',
            'suggested_products' => 'nullable|array',
            'suggested_products.*' => 'required|numeric',
            'sort' => 'required|numeric',
        ];
    }



}
