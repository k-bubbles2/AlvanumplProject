<?php
declare(strict_types=1);

namespace Project\Domain\Feature;

abstract class AbstractFeature implements FeatureInterface
{
    protected static string $featureName = 'unknown';

    final public function name(): string
    {
        return static::$featureName;
    }
}
