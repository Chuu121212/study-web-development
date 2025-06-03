<?php
// 日本時間に設定する
date_default_timezone_set('Asia/Tokyo');

// 現在の時間を指定されたフォーマットで表示
echo "PHPでの時間表示<br>";
echo "現在の時間は " . date("Y-m-d H:i:s") . "<br>";
?>