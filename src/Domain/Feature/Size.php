<?php
declare(strict_types=1);

namespace Project\Domain\Feature;

class Size extends AbstractFeature
{
    protected static string $featureName = 'size';

    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
