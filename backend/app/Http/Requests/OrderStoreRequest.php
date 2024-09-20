<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use voku\helper\AntiXSS;

/**
 * Class OrderStoreRequest
 * @package App\Http\Requests
 */
class OrderStoreRequest extends FormRequest
{
    /**
     * @var array $arXssClean
     */
    protected array $arXssClean = [
        'name',
        'phone',
        'orders',
        'address'
    ];

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
        //todo: lyuboy post yndunuma
        return [
            'orders' => 'required|array',
            'orders.*' => 'required|array',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ];
        //todo: purify injections
    }

    /**
     * @void
     */
    protected function prepareForValidation(): void
    {
        $this->merge(
            $this->sanitize($this->only($this->arXssClean))
        );
    }

    /**
     * @param array $arInsert
     * @return array
     */
    public function sanitize(array $arInsert): array
    {
        array_walk_recursive($arInsert, function (&$value) {
            $value = app(AntiXSS::class)->xss_clean($value);
        });

        return $arInsert;
    }

}
