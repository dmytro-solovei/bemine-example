<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BrandStoreRequest
 * @package App\Http\Requests\Admin
 */
class GalleryDeleteRequest extends FormRequest
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
            'productId' => 'required|numeric|exists:App\Models\Product,id',
            'ids' => 'required|string', //todo: check exists for each id
        ];
    }



}
