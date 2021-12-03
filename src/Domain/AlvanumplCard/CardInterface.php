<?php
declare(strict_types=1);

namespace Project\Domain\AlvanumplCard;

interface CardInterface
{
    public function kind(): string;
    public function food(): array;
    public function ability(): array;
}
