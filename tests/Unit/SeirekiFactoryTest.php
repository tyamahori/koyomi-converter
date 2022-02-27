<?php

namespace Tests\Unit;

use Exception;
use InvalidArgumentException;
use Tests\TestCase;
use Tyamahori\Koyomi\Factory\SeirekiFactory;

class SeirekiFactoryTest extends TestCase
{
    /**
     * @test
     * @param string $gengoCode
     * @param int $gengoYear
     * @param int $expectedSeirekiYear
     * @return void
     * @throws Exception
     * @dataProvider dataSource
     */
    public function 和暦が表示される(
        string $gengoCode,
        int $gengoYear,
        int $expectedSeirekiYear
    ): void {
        self::assertSame($expectedSeirekiYear, SeirekiFactory::year($gengoCode, $gengoYear));
    }

    /**
     * @return array[]
     */
    public function dataSource(): array
    {
        return [
            '令和5年' => ['reiwa', 5, 2023],
            '令和4年' => ['reiwa', 4, 2022],
            '令和3年' => ['reiwa', 3, 2021],
            '令和2年' => ['reiwa', 2, 2020],
            '令和1年' => ['reiwa', 1, 2019],
            '平成31年' => ['heisei', 31, 2019],
            '平成1年' => ['heisei', 1, 1989],
            '昭和64年' => ['showa', 64, 1989],
            '昭和1年' => ['showa', 1, 1926],
            '大正15年' => ['taisho', 15, 1926],
            '大正1年' => ['taisho', 1, 1912],
            '明治45年' => ['meiji', 45, 1912],
            '明治1年' => ['meiji', 1, 1868],
        ];
    }

    /**
     * @test
     * @param string $gengoCode
     * @param int $gengoYear
     * @return void
     * @throws Exception
     * @dataProvider invalidDataSource
     */
    public function 予期しない元号コードではエラーが発生する(string $gengoCode, int $gengoYear): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('対応する元号コードではありません');
        SeirekiFactory::year($gengoCode, $gengoYear);
    }

    /**
     * @return array[]
     */
    public function invalidDataSource(): array
    {
        return [
            '不正な令和のコード' => ['reiwaa', 5],
            '不正な平成のコード' => ['heiseii', 5],
            '不正な昭和のコード' => ['shouwaa', 5],
            '不正な大正のコード' => ['taishoo', 5],
            '不正な明治のコード' => ['meijii', 5],
        ];
    }
}
