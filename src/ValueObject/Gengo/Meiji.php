<?php

namespace Tyamahori\Koyomi\ValueObject\Gengo;

use DateTimeImmutable;
use Exception;
use InvalidArgumentException;

class Meiji implements GengoInterface
{
    private static string $lablel = '明治';
    private static string $code = 'meiji';
    private static int $startDate = 18680125;
    private static int $diffYear = 1867;

    private int $inputSeirekiYear;
    private string $inputMonth;
    private string $inputDate;

    /**
     * @param DateTimeImmutable $date
     * @throws InvalidArgumentException
     */
    public function __construct(
        DateTimeImmutable $date
    ) {
        $this->validateParameter($date);

        $this->inputSeirekiYear = (int) $date->format('Y');
        $this->inputMonth = $date->format('m');
        $this->inputDate = $date->format('d');
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
     * @return DateTimeImmutable
     * @throws Exception
     */
    public static function startDate(): DateTimeImmutable
    {
        return new DateTimeImmutable(self::$startDate);
    }

    /**
     * @return int
     */
    public function gengoYear(): int
    {
        return $this->inputSeirekiYear - self::$diffYear;
    }

    /**
     * @return string
     */
    public function gengoDate(): string
    {
        $gengoLabel = self::$lablel;

        $gengoYear = match (true) {
            $this->gengoYear() === 1 => "元年",
            $this->gengoYear() <= 9 => "0{$this->gengoYear()}年",
            default => "{$this->gengoYear()}年",
        };

        return "$gengoLabel$gengoYear{$this->inputMonth}月{$this->inputDate}日";
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
     * @return int
     */
    public function month(): int
    {
        return $this->inputMonth;
    }

    /**
     * @return int
     */
    public function date(): int
    {
        return $this->inputDate;
    }
}
