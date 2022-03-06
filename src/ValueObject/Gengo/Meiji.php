<?php

namespace Tyamahori\Koyomi\ValueObject\Gengo;

use DateTimeImmutable;
use InvalidArgumentException;

class Meiji implements GengoInterface
{
    private static string $lablel = '明治';
    private static string $code = 'meiji';
    private static int $startDate = 18680125;
    private static int $diffYear = 1867;

    /**
     * @param DateTimeImmutable $date
     * @throws InvalidArgumentException
     */
    public function __construct(
        private DateTimeImmutable $date
    ) {
        $this->validateParameter($date);
    }

    /**
     * @param DateTimeImmutable $date
     * @return void
     */
    private function validateParameter(DateTimeImmutable $date): void
    {
        if ((int) $date->format('Ymd') < self::$startDate) {
            $gengoLabel = self::$lablel;
            throw new InvalidArgumentException("引数の日付が{$gengoLabel}の開始日以前です。");
        }
    }

    /**
     * @return string
     */
    public static function label(): string
    {
        return self::$lablel;
    }

    /**
     * @return string
     */
    public static function code(): string
    {
        return self::$code;
    }

    /**
     * @return int
     */
    public function gengoYear(): int
    {
        return (int) $this->date->format('Y') - self::$diffYear;
    }

    /**
     * @param DateTimeImmutable $date
     * @return bool
     */
    public static function canApply(DateTimeImmutable $date): bool
    {
        return (int) $date->format('Ymd') >= self::$startDate;
    }

    /**
     * @param int $gengoYear
     * @return int
     */
    public static function seirekiYear(int $gengoYear): int
    {
        return self::$diffYear + $gengoYear;
    }

    /**
     * @return DateTimeImmutable
     */
    public function datetimeImmutable(): DateTimeImmutable
    {
        return $this->date;
    }
}
