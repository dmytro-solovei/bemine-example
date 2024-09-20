<?php namespace App\Http\Requests;

use App\Classes\Dto\OffsetDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OffsetRequest
 * @package App\Http\Requests
 *
 */
class OffsetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'offset' => 'sometimes|integer',
            'limit'  => 'sometimes|integer|max:50|min:1',
        ];
    }

    /**
     * @return OffsetDto
     */
    public function getDto(): OffsetDto
    {
        return new OffsetDto($this->validated());
    }
}
