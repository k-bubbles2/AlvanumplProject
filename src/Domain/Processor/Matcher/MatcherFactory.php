<?php
declare(strict_types=1);

namespace Project\Domain\Processor\Matcher;

use Project\Domain\Feature\FeatureInterface;

class MatcherFactory
{
    public function buildMatcher(FeatureInterface $feature)
    {
        switch ($feature->name()) {
            case 'size' === $feature->name():
                return new SizeMatcher();
            case 'horn' === $feature->name():
                return new HornMatcher();
            case 'wool' === $feature->name():
                return new WoolMatcher();
            case 'color' === $feature->name():
                return new ColorMatcher();
            default:
                return new EmptyMatcher();

        }
    }
}
