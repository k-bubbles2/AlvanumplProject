<?php
declare(strict_types=1);

namespace Project\Domain\Processor\Matcher;

use Project\Domain\Feature\FeatureInterface;

class EmptyMatcher
{
    private array $matched = [];

    private const MAP = [
        'red' => [],
        'green' => [],
        'blue' => [],
    ];

    public function match(FeatureInterface $feature): array
    {
        return $this->matched;
    }
}
