# このライブラリについて
- 西暦を和暦に変換する
- 和暦を西暦に変換する 

# 注意点
- 明治時代から対応している。
- 明治時代`以前`は対応していない。

# 使い方
## インストール
```
$ composer require tyamahori/koyomi-converter
```

## サンプル
```php
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
        echo $gengo->gengoYear() . PHP_EOL; // 4
        echo $gengo::seirekiYear(4) . PHP_EOL; // 2022
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
```
