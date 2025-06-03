<?php
// 今日の日付
$today = date('Y-m-d');

// 1年後の日付
$one_year_later = strtotime('+1 year', strtotime($today));

// 開始日
$current_date = strtotime($today);

// ループで出力
for ($i = 0; $current_date <= $one_year_later; $i++) {
    echo date('n/j(D)', $current_date) . " ";
    $current_date = strtotime('+1 day', $current_date);
}
?>
