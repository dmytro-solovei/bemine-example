<?php

namespace App\Http\Requests;

use App\Classes\Dto\FilterDto;
use Illuminate\Support\Arr;

/**
 * Class FilterRequest
 * @package App\Http\Requests
 */
class FilterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => 'sometimes|array',
            'search' => 'nullable|string',
            'sort' => 'sometimes|string'
        ];
    }

    /**
     * @return FilterDto
     */
    public function getDto(): FilterDto
    {
        return new FilterDto(Arr::only($this->validated(), ['filter', 'search']));
    }

}
