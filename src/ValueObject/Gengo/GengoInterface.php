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
     * @return DateTimeImmutable
     */
    public static function startDate(): DateTimeImmutable;

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
     * @return string
     */
    public function gengoDate(): string;

    /**
     * @param int $gengoYear
     * @return int
     */
    public static function seirekiYear(int $gengoYear): int;
}
