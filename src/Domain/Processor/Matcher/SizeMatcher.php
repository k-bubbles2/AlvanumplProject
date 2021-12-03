<?php
declare(strict_types=1);

namespace Project\Domain\Processor\Matcher;

use Project\Domain\Feature\Size;


class SizeMatcher
{
    private array $matched = [];

    private const MAP = [
        'red' => [
            'max' => 10
        ],
        'green' => [
            'min' => 15,
            'max' => 30
        ],
        'blue' => [
            'max' => 10
        ],
    ];

    public function match(Size $size): array
    {
        foreach (self::MAP as $kind => $sizeParams) {
            if (isset($sizeParams['min'], $sizeParams['max'])) {
                $checkResult = $size->value() >= $sizeParams['min'] && $size->value() <= $sizeParams['max'];
            } elseif (isset($sizeParams['min'])) {
                $checkResult = $size->value() >= $sizeParams['min'];
            } else {
                $checkResult = $size->value() <= $sizeParams['max'];
            }

            if (isset($checkResult) && true === $checkResult) {
                $this->matched[$size->name()][$kind] = true;
            }
        }

        return $this->matched;
    }
}
