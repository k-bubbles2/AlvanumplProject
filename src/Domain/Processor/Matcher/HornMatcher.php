<?php
declare(strict_types=1);

namespace Project\Domain\Processor\Matcher;

use Project\Domain\Feature\Horn;


class HornMatcher
{
    private array $matched = [];

    private const MAP = [
        'red' => [
            'type' => 'straight',
        ],
        'green' => [
            'type' => 'spiral',
        ],
        'blue' => [
            'type' => 'spiral',
        ],
    ];

    public function match(Horn $horn): array
    {
        foreach (self::MAP as $kind => $hornParams) {
            $checkResult = $horn->value() === $hornParams['type'];

            if (isset($checkResult) && true === $checkResult) {
                $this->matched[$horn->name()][$kind] = true;
            }
        }

        return $this->matched;
    }
}
