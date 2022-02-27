<?php

namespace Tyamahori\Koyomi\Factory;

interface SeirekiFactoryInterface
{
    /**
     * @param string $gengoCode
     * @param int $gengoYear
     * @return int
     */
    public static function year(
        string $gengoCode,
        int $gengoYear
    ): int;
}
