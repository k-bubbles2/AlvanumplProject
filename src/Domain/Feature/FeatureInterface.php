<?php
declare(strict_types=1);

namespace Project\Domain\Feature;

interface FeatureInterface
{
    public function name(): string;

    /**
     * @return mixed
     */
    public function value();
}
