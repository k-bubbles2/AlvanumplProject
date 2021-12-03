<?php
declare(strict_types=1);

namespace Project\Domain\Processor;


use Project\Domain\Feature\Color;
use Project\Domain\Feature\Horn;
use Project\Domain\Feature\Size;
use Project\Domain\Feature\Wool;
use Project\Domain\Processor\Matcher\MatcherFactory;

class Processor
{
    private array $result = [];

    private array $weights = [
        'blue'  => 3,
        'red'   => 2,
        'green' => 1,
    ];

    private bool $useWeights = false;

    public function result(): array
    {
        $scored = [];

        foreach ($this->result as $feature => $matchedKinds) {
            foreach ($matchedKinds as $kind => $matchingResolution) {
                if (true === $matchingResolution) {
                    if (!isset($scored[$kind])) {
                        $scored[$kind] = 0;
                    }

                    ++$scored[$kind];
                }
            }
        }

        if (!empty($this->useWeights)) {
            foreach ($this->weights as $kind => $weight) {
                if (isset($scored[$kind])) {
                    $scored[$kind] = $scored[$kind] * $weight;
                }
            }
        }

        arsort($scored);

        $lastScore = 0;

        $data = [];
        foreach ($scored as $kind => $score) {
            $data[$score][] = $kind;
        }

        return $data;
    }

    public function process(array $searchParams, ?bool $useWeights = false)
    {
        if ($useWeights) {
            $this->useWeights = true;
        }

        foreach ($searchParams as $name => $value) {
            $feature = $this->buildFeature($name, $value);
            $matcher = (new MatcherFactory())->buildMatcher($feature);
            $matched = $matcher->match($feature);

            if (!empty($matched)) {
                $this->result = array_merge($this->result, $matched);
            }
        }
    }

    private function buildFeature(string $name, $value)
    {
        switch ($name) {
            case 'size':
                return new Size($value);
            case 'horn':
                return new Horn($value);
            case 'wool':
                return new Wool($value);
            case 'color':
                return new Color($value);
        }
    }
}
