<?php

namespace Tyamahori\Koyomi\Factory;

use DateTimeImmutable;
use Tyamahori\Koyomi\ValueObject\Gengo\GengoInterface;

interface GengoFactoryInterface
{
    /**
     * @param DateTimeImmutable $date
     * @return GengoInterface
     */
    public static function create(DateTimeImmutable $date): GengoInterface;
}
