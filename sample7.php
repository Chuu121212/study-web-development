<?php
// 和食の連想配列
$foods = [
    '寿司' => 'Sushi',
    'ラーメン' => 'Ramen',
    '天ぷら' => 'Tempura',
    'たこ焼き' => 'Takoyaki',
    'カツ' => 'Katsu',
    'おにぎり' => 'Onigiri',
    'もち' => 'Mochi',
    'うどん' => 'Udon'
];

// ループして表示
foreach ($foods as $japanese => $english) {
    echo "日本語: $japanese<br>";
    echo "英語: $english<br><br>";
}
?>
