<?php
namespace App\Classes\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Lang;

/**
 * Class DataTransferObject
 * @package App\Classes\Dto
 *
 */
abstract class DataTransferObject implements Arrayable
{
    /**
     * DataTransferObject constructor.
     * @param array $aParameters
     */
    public function __construct(array $aParameters = [])
    {
        $this->unpackParameters($aParameters);
    }

    /**
     * @param array $aParameters
     */
    protected function unpackParameters(array $aParameters): void
    {
        foreach($aParameters as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \RuntimeException(
                    Lang::get('general.dto.prop_not_exists', [
                        'key'   => $key,
                        'class' => static::class,
                    ])
                );
            }

            $this->{$key} = $value;
        }
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $obReflection = new \ReflectionClass(static::class);
        $arProperties = $obReflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        $arItems = [];
        foreach ($arProperties as $obProperty) {
            if ($obProperty->isStatic()) {
                continue;
            }

            $arItems[$obProperty->getName()] = $obProperty->getValue($this);
        }

        return $arItems;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->all();
    }
}
