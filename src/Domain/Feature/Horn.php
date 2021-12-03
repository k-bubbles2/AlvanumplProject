<?php
declare(strict_types=1);

namespace Project\Domain\Feature;

class Horn extends AbstractFeature
{
    protected static string $featureName = 'horn';

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
