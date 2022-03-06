<?php

namespace Tyamahori\Koyomi\ValueObject\Gengo;

use DateTimeImmutable;

interface GengoInterface
{
    /**
     * @return string
     */
    public static function label(): string;

    /**
     * @return string
     */
    public static function code(): string;

    /**
     * @param DateTimeImmutable $date
     * @return bool
     */
    public static function canApply(DateTimeImmutable $date): bool;

    /**
     * @return int
     */
    public function gengoYear(): int;

    /**
     * @param int $gengoYear
     * @return int
     */
    public static function seirekiYear(int $gengoYear): int;

    /**
     * @return DateTimeImmutable
     */
    public function datetimeImmutable(): DateTimeImmutable;
}
