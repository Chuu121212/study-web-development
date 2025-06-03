<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seconds in a Day</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding-top: 100px;
        }
        .box {
            background-color: white;
            display: inline-block;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .formula, .result {
            font-size: 24px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="box">
        <?php
            $hours = 24;
            $minutes = 60;
            $seconds = 60;
            $totalSeconds = $hours * $minutes * $seconds;

            echo "<div class='formula'>Formula: {$hours} × {$minutes} × {$seconds}</div>";
            echo "<div class='result'>Result: {$totalSeconds} seconds in a day</div>";
        ?>
    </div>
</body>
</html>
