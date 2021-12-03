<?php
declare(strict_types=1);

namespace Project\Domain\Feature;

class Wool extends AbstractFeature
{
    protected static string $featureName = 'wool';

    private bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }
}
