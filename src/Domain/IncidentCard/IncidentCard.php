<?php
declare(strict_types=1);

namespace Project\Domain\IncidentCard;

use DateTimeImmutable;
use JsonSerializable;
use Project\Domain\AlvanumplCard\AbstractCard;

class IncidentCard implements JsonSerializable
{
    private array $searchParams;
    private array $detectedKinds;
    private string $detectionType;
    private DateTimeImmutable $detectionTime;

    /**
     * @param array $searchParams
     * @param AbstractCard[] $detectedKinds
     */
    public function __construct(
        array $searchParams,
        ?array $detectedKinds = []
    )
    {
        $this->detectedKinds = [];

        $this->detectionTime = new DateTimeImmutable();
        $this->searchParams = $searchParams;

        if (!empty($detectedKinds)) {
            foreach ($detectedKinds as $card) {
                $this->detectedKinds[] = $card->kind();
            }
        }

        if (0 === count($this->detectedKinds)) {
            $this->detectionType = 'mismatch';
        } else {
            $this->detectionType = 1 == count($this->detectedKinds) ? 'exact' : 'multiple';
        }
    }

    public function hash(): string
    {
        return md5(json_encode($this));
    }

    public function searchParams(): array
    {
        return $this->searchParams;
    }

    public function detectionTime(): DateTimeImmutable
    {
        return $this->detectionTime;
    }

    public function detectionType(): string
    {
        return $this->detectionType;
    }

    public function detectedKinds(): array
    {
        return $this->detectedKinds;
    }

    public function jsonSerialize(): array
    {
        return [
            'search_params' => $this->searchParams,
            'detection_time' => $this->detectionTime->getTimestamp(),
            'detection_type' => $this->detectionType,
            'detected_kinds' => $this->detectedKinds,
        ];
    }
}
