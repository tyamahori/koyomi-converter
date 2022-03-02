<?php

namespace Tyamahori\Koyomi\Factory;

use DateTimeImmutable;
use InvalidArgumentException;
use Tyamahori\Koyomi\ValueObject\Gengo\GengoInterface;
use Tyamahori\Koyomi\ValueObject\Gengo\Heisei;
use Tyamahori\Koyomi\ValueObject\Gengo\Meiji;
use Tyamahori\Koyomi\ValueObject\Gengo\Reiwa;
use Tyamahori\Koyomi\ValueObject\Gengo\Showa;
use Tyamahori\Koyomi\ValueObject\Gengo\Taisho;

class GengoFactory implements GengoFactoryInterface
{
    /**
     * @param DateTimeImmutable $date
     * @return GengoInterface
     * @throws InvalidArgumentException
     */
    public static function create(DateTimeImmutable $date): GengoInterface
    {
        return match (true) {
            Reiwa::canApply($date) => new Reiwa($date),
            Heisei::canApply($date) => new Heisei($date),
            Showa::canApply($date) => new Showa($date),
            Taisho::canApply($date) => new Taisho($date),
            Meiji::canApply($date) => new Meiji($date),
            default => throw new InvalidArgumentException('対応する元号がありません。'),
        };
    }
}
