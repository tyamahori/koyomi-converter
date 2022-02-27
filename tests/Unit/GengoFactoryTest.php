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
     * @param string $expectedGengo
     * @return void
     * @throws Exception
     * @dataProvider dataSource
     */
    public function 和暦が表示される(DateTimeImmutable $date, string $expectedGengo): void
    {
        $gengo = GengoFactory::create($date);
        self::assertSame($expectedGengo, $gengo::label());
    }

    /**
     * @return array[]
     */
    public function dataSource(): array
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
