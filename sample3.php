<?php
// 商品ごとの個数と単価を設定
$apple_quantity = 2;
$apple_price = 100;

$meat_quantity = 1;
$meat_price = 1000;

$egg_quantity = 2;
$egg_price = 200;

// 税抜き合計金額を計算
$total_excluding_tax = ($apple_quantity * $apple_price) +
                       ($meat_quantity * $meat_price) +
                       ($egg_quantity * $egg_price);

// 税率10%
$tax_rate = 0.10;

// 税込み金額を計算
$total_including_tax = $total_excluding_tax * (1 + $tax_rate);

// 表示
echo "購入商品<br>";
echo "りんご：{$apple_quantity}個、{$apple_price}円<br>";
echo "肉：{$meat_quantity}個、{$meat_price}円<br>";
echo "卵：{$egg_quantity}個、{$egg_price}円<br><br>";

echo "合計金額（税抜）：{$total_excluding_tax}円<br>";
echo "合計金額（税込）：{$total_including_tax}円<br>";
?>
