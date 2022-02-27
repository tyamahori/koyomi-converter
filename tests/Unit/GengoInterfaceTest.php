<?php

namespace Tests\Unit;

use DateTimeImmutable;
use Exception;
use InvalidArgumentException;
use Tests\TestCase;
use Tyamahori\Koyomi\ValueObject\Gengo\GengoInterface;
use Tyamahori\Koyomi\ValueObject\Gengo\Heisei;
use Tyamahori\Koyomi\ValueObject\Gengo\Meiji;
use Tyamahori\Koyomi\ValueObject\Gengo\Reiwa;
use Tyamahori\Koyomi\ValueObject\Gengo\Showa;
use Tyamahori\Koyomi\ValueObject\Gengo\Taisho;

class GengoInterfaceTest extends TestCase
{
    /**
     * @test
     * @param GengoInterface $gengo
     * @param string $expectedGengoLabel
     * @param string $expectedGengoCode
     * @return void
     * @dataProvider dataSource
     */
    public function 元号のクラスが意図したものになる(
        GengoInterface $gengo,
        string $expectedGengoLabel,
        string $expectedGengoCode
    ): void {
        self::assertSame($expectedGengoLabel, $gengo::label());
        self::assertSame($expectedGengoCode, $gengo::code());
    }

    /**
     * @return array[]
     * @throws Exception
     */
    public function dataSource(): array
    {
        return [
            '令和の始まり' => [new Reiwa(new DateTimeImmutable('2019-05-01')), '令和', 'reiwa'],
            '平成の終わり' => [new Heisei(new DateTimeImmutable('2019-04-30')), '平成', 'heisei'],
            '平成の始まり' => [new Heisei(new DateTimeImmutable('1989-01-08')), '平成', 'heisei'],
            '昭和の終わり' => [new Showa(new DateTimeImmutable('1989-01-07')), '昭和', 'showa'],
            '昭和の始まり' => [new Showa(new DateTimeImmutable('1926-12-25')), '昭和', 'showa'],
            '大正の終わり' => [new Taisho(new DateTimeImmutable('1926-12-24')), '大正', 'taisho'],
            '大正の始まり' => [new Taisho(new DateTimeImmutable('1912-07-30')), '大正', 'taisho'],
            '明治の終わり' => [new Meiji(new DateTimeImmutable('1912-07-29')), '明治', 'meiji'],
            '明治の始まり' => [new Meiji(new DateTimeImmutable('1868-01-25')), '明治', 'meiji'],
        ];
    }

    /**
     * @test
     * @param string $gengClassName
     * @param DateTimeImmutable $date
     * @return void
     * @dataProvider invalidDataSource
     */
    public function 元号クラスに対応していない日付を割り当てるとエラーになる(
        string $gengClassName,
        DateTimeImmutable $date
    ): void {
        $this->expectException(InvalidArgumentException::class);
        new $gengClassName($date);
    }

    /**
     * @return array[]
     * @throws Exception
     */
    public function invalidDataSource(): array
    {
        return [
            '令和に対応しない' => [Reiwa::class, new DateTimeImmutable('2019-04-30')],
            '平成に対応しない' => [Heisei::class, new DateTimeImmutable('1989-01-07')],
            '昭和に対応しない' => [Showa::class, new DateTimeImmutable('1926-12-24')],
            '大正に対応しない' => [Taisho::class, new DateTimeImmutable('1912-07-29')],
            '明治に対応しない' => [Meiji::class, new DateTimeImmutable('1868-01-24')],
        ];
    }
}
