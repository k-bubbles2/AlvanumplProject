<?php
declare(strict_types=1);

namespace Project\Domain\AlvanumplCard;

use JsonSerializable;

abstract class AbstractCard implements CardInterface, JsonSerializable
{
    private const FIELD__KIND    = 'kind';
    private const FIELD__FOOD    = 'food';
    private const FIELD__ABILITY = 'ability';

    public function jsonSerialize()
    {
        return [
            self::FIELD__KIND    => $this->kind(),
            self::FIELD__FOOD    => $this->food(),
            self::FIELD__ABILITY => $this->ability(),
        ];
    }
}
