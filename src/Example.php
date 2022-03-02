<?php

namespace Tyamahori\Koyomi;

use DateTimeImmutable;
use Tyamahori\Koyomi\Factory\GengoFactory;
use Tyamahori\Koyomi\Factory\SeirekiFactory;

class Example
{
    /**
     * @return void
     */
    public function exampleGengo(): void
    {
        /**
         * 調べたい日をDateTimeImmutableにて入れる。
         * 注意としては明治以降に対応している
         */
        $gengo = GengoFactory::create(new DateTimeImmutable('2022-02-27'));
        echo $gengo::label() . PHP_EOL; // 令和;
        echo $gengo::code() . PHP_EOL; // reiwa;
        echo $gengo->gengoDate() . PHP_EOL; // 令和04年02月27日
        echo $gengo->gengoYear() . PHP_EOL; // 4
        echo $gengo->month() . PHP_EOL; // 2
        echo $gengo->date() . PHP_EOL; // 27
        echo $gengo::seirekiYear(4) . PHP_EOL; // 2022
        echo $gengo::startDate()->format('Y-m-d') . PHP_EOL; // 2019-05-01
    }

    /**
     * @return void
     */
    public function exampleSeireki(): void
    {
        /**
         * 和暦から西暦にする場合のメソッド
         * 第1引数は reiwa, heisei, showa, taisho, meiji のいずれか。それ以外は例外が発生する
         * 第2引数は数値。元号の年数を設定する
         */
        $reiwaSeireki = SeirekiFactory::year('reiwa', 5); // 令和5年を西暦に変更する
        $showaSeireki = SeirekiFactory::year('showa', 100); // 昭和100年を西暦に変更する
        echo $reiwaSeireki . PHP_EOL; // 2023
        echo $showaSeireki . PHP_EOL; // 2025
    }
}
