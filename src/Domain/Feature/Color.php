<?php
declare(strict_types=1);

namespace Project\Domain\Feature;

class Color extends AbstractFeature
{
    protected static string $featureName = 'color';

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
