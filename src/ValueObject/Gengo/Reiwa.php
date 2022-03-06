<?php

namespace Tyamahori\Koyomi\ValueObject\Gengo;

use DateTimeImmutable;
use Exception;
use InvalidArgumentException;

class Reiwa implements GengoInterface
{
    private static string $lablel = '令和';
    private static string $code = 'reiwa';
    private static int $startDate = 20190501;
    private static int $diffYear = 2018;

    /**
     * @param DateTimeImmutable $date
     * @throws InvalidArgumentException
     */
    public function __construct(
        private DateTimeImmutable $date
    ) {
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
