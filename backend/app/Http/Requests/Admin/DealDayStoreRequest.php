<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BrandStoreRequest
 * @package App\Http\Requests\Admin
 */
class DealDayStoreRequest extends FormRequest
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
            'deals' => 'array|required',
            'deals.*' => 'array|required',
            'deals.*.product_id' => 'required|numeric|exists:App\Models\Product,id',
            'deals.*.date_start' => 'required|date_format:d/m/Y H:i',
            'deals.*.date_end' => 'required|date_format:d/m/Y H:i',
          //  'end_date'    =>  'required|date_format:d/m/Y H:i|after_or_equal:start_date' //todo
        ];
    }


}
