<?php

namespace Tyamahori\Koyomi\Factory;

use Exception;
use InvalidArgumentException;
use Tyamahori\Koyomi\ValueObject\Gengo\Heisei;
use Tyamahori\Koyomi\ValueObject\Gengo\Meiji;
use Tyamahori\Koyomi\ValueObject\Gengo\Reiwa;
use Tyamahori\Koyomi\ValueObject\Gengo\Showa;
use Tyamahori\Koyomi\ValueObject\Gengo\Taisho;

class SeirekiFactory implements SeirekiFactoryInterface
{
    /**
     * @throws Exception
     */
    public static function year(string $gengoCode, int $gengoYear): int
    {
        return match ($gengoCode) {
            Reiwa::code() => Reiwa::seirekiYear($gengoYear),
            Heisei::code() => Heisei::seirekiYear($gengoYear),
            Showa::code() => Showa::seirekiYear($gengoYear),
            Taisho::code() => Taisho::seirekiYear($gengoYear),
            Meiji::code() => Meiji::seirekiYear($gengoYear),
            default => throw new InvalidArgumentException('対応する元号コードではありません'),
        };
    }
}
