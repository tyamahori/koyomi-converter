<?php

namespace Tests\Unit;

use DateTimeImmutable;
use Exception;
use InvalidArgumentException;
use Tests\TestCase;
use Tyamahori\Koyomi\Factory\GengoFactory;

class GengoFactoryTest extends TestCase
{
    /**
     * @test
     * @param DateTimeImmutable $date
     * @param string $expectedGengoLabel
     * @return void
     * @throws Exception
     * @dataProvider dataSourceForLabel
     */
    public function 和暦ラベルが表示される(
        DateTimeImmutable $date,
        string $expectedGengoLabel
    ): void {
        $gengo = GengoFactory::create($date);
        self::assertSame($expectedGengoLabel, $gengo::label());
    }

    /**
     * @return array[]
     */
    public function dataSourceForLabel(): array
    {
        return [
            '令和の始まり' => [new DateTimeImmutable('2019-05-01'), '令和'],
            '平成の終わり' => [new DateTimeImmutable('2019-04-30'), '平成'],
            '平成の始まり' => [new DateTimeImmutable('1989-01-08'), '平成'],
            '昭和の終わり' => [new DateTimeImmutable('1989-01-07'), '昭和'],
            '昭和の始まり' => [new DateTimeImmutable('1926-12-25'), '昭和'],
            '大正の終わり' => [new DateTimeImmutable('1926-12-24'), '大正'],
            '大正の始まり' => [new DateTimeImmutable('1912-07-30'), '大正'],
            '明治の終わり' => [new DateTimeImmutable('1912-07-29'), '明治'],
            '明治の始まり' => [new DateTimeImmutable('1868-01-25'), '明治'],
        ];
    }

    /**
     * @test
     * @param DateTimeImmutable $date
     * @param string $expectedGengoCode
     * @return void
     * @throws Exception
     * @dataProvider dataSourceForCode
     */
    public function 和暦コードが表示される(
        DateTimeImmutable $date,
        string $expectedGengoCode
    ): void {
        $gengo = GengoFactory::create($date);
        self::assertSame($expectedGengoCode, $gengo::code());
    }

    /**
     * @return array[]
     */
    public function dataSourceForCode(): array
    {
        return [
            '令和の始まり' => [new DateTimeImmutable('2019-05-01'), 'reiwa'],
            '平成の終わり' => [new DateTimeImmutable('2019-04-30'), 'heisei'],
            '平成の始まり' => [new DateTimeImmutable('1989-01-08'), 'heisei'],
            '昭和の終わり' => [new DateTimeImmutable('1989-01-07'), 'showa'],
            '昭和の始まり' => [new DateTimeImmutable('1926-12-25'), 'showa'],
            '大正の終わり' => [new DateTimeImmutable('1926-12-24'), 'taisho'],
            '大正の始まり' => [new DateTimeImmutable('1912-07-30'), 'taisho'],
            '明治の終わり' => [new DateTimeImmutable('1912-07-29'), 'meiji'],
            '明治の始まり' => [new DateTimeImmutable('1868-01-25'), 'meiji'],
        ];
    }

    /**
     * @test
     * @param DateTimeImmutable $date
     * @param int $expectedGengoYear
     * @return void
     * @throws Exception
     * @dataProvider dataSourceForGengoYear
     */
    public function 和暦の年が表示される(
        DateTimeImmutable $date,
        int $expectedGengoYear
    ): void {
        $gengo = GengoFactory::create($date);
        self::assertSame($expectedGengoYear, $gengo->gengoYear());
    }

    /**
     * @return array[]
     */
    public function dataSourceForGengoYear(): array
    {
        return [
            '令和の始まり' => [new DateTimeImmutable('2019-05-01'), 1],
            '平成の終わり' => [new DateTimeImmutable('2019-04-30'), 31],
            '平成の始まり' => [new DateTimeImmutable('1989-01-08'), 1],
            '昭和の終わり' => [new DateTimeImmutable('1989-01-07'), 64],
            '昭和の始まり' => [new DateTimeImmutable('1926-12-25'), 1],
            '大正の終わり' => [new DateTimeImmutable('1926-12-24'), 15],
            '大正の始まり' => [new DateTimeImmutable('1912-07-30'), 1],
            '明治の終わり' => [new DateTimeImmutable('1912-07-29'), 45],
            '明治の始まり' => [new DateTimeImmutable('1868-01-25'), 1],
        ];
    }

    /**
     * @test
     * @param DateTimeImmutable $date
     * @return void
     * @throws Exception
     * @dataProvider invalidDataSource
     */
    public function 対応していない西暦はエラーが発生する(DateTimeImmutable $date): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('対応する元号がありません。');
        GengoFactory::create($date);
    }

    /**
     * @return array[]
     */
    public function invalidDataSource(): array
    {
        return [
            '明治時代前日' => [new DateTimeImmutable('1868-01-24')],
            '江戸時代末期' => [new DateTimeImmutable('1860-01-13')],
        ];
    }
}
