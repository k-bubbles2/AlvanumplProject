<?php
declare(strict_types=1);

namespace Project\Domain\AlvanumplCard;

class BlueAlvanumplCard extends AbstractCard
{
    public const KIND = 'blue';
    private const KIND__BLUE = 'Синий';

    public function kind(): string
    {
        return self::KIND__BLUE;
    }

    public function food(): array
    {
        return [
            'Орехи',
            'Виноград'
        ];
    }

    public function ability(): array
    {
        return [
            'Плюётся ядом',
            'Бьется током'
        ];
    }
}
