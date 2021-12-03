<?php
declare(strict_types=1);

namespace Project\Domain\Processor\Matcher;

use Project\Domain\Feature\Wool;

class WoolMatcher
{
    private array $matched = [];

    private const MAP = [
        'red' => [
            'exists' => true,
        ],
        'green' => [
            'exists' => true,
        ],
        'blue' => [
            'exists' => false,
        ],
    ];

    public function match(Wool $wool): array
    {
        foreach (self::MAP as $kind => $woolParams) {
            $checkResult = $wool->value() === $woolParams['exists'];

            if (isset($checkResult) && true === $checkResult) {
                $this->matched[$wool->name()][$kind] = true;
            }
        }

        return $this->matched;
    }
}
