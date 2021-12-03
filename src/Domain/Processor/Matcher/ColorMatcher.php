<?php
declare(strict_types=1);

namespace Project\Domain\Processor\Matcher;

use Project\Domain\Feature\Color;


class ColorMatcher
{
    private array $matched = [];

    private const MAP = [
        'red' => [
            'base' => 'red'
        ],
        'green' => [
            'base' => 'green'
        ],
        'blue' => [
            'base' => 'blue'
        ],
    ];

    public function match(Color $color): array
    {
        foreach (self::MAP as $kind => $colorParams) {
            if (isset($colorParams['base'])) {
                $checkResult = $color->value() === $colorParams['base'];
            }

            if (isset($checkResult) && true === $checkResult) {
                $this->matched[$color->name()][$kind] = true;
            }
        }

        return $this->matched;
    }
}
