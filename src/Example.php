<?php

namespace Tyamahori\Koyomi;

use DateTimeImmutable;
use Exception;
use Tyamahori\Koyomi\Factory\GengoFactory;
use Tyamahori\Koyomi\Factory\SeirekiFactory;

class Example
{
    /**
     * @throws Exception
     */
    public function exampleGengo(): void
    {
        $gengo = GengoFactory::create(new DateTimeImmutable('2022-02-27')); // 調べたい日を入れる。注意としては明治以降に対応している
        echo $gengo::label() . PHP_EOL; // 令和;
        echo $gengo::code() . PHP_EOL; // reiwa;
        echo $gengo->gengoDate() . PHP_EOL; // 令和04年02月27日
        echo $gengo->gengoYear() . PHP_EOL; // 4
        echo $gengo::seirekiYear(4) . PHP_EOL; // 2022
        echo $gengo::startDate()->format('Y-m-d') . PHP_EOL; // 2019-05-01
    }

    /**
     * @return void
     * @throws Exception
     */
    public function exampleSeireki()
    {
        $reiwaSeireki = SeirekiFactory::year('reiwa', 5); // 令和5年を西暦に変更する
        $showaSeireki = SeirekiFactory::year('showa', 100); // 昭和100年を西暦に変更する
        echo $reiwaSeireki . PHP_EOL; // 2023
        echo $showaSeireki . PHP_EOL; // 2025
    }
}
