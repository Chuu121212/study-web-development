<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>1から365までの数字表示</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 20px;
      padding: 0;
      background-color: #f4f4f9;
    }
    #output {
      display: grid;
      grid-template-columns: repeat(10, 1fr);
      gap: 5px;
      font-size: 14px;
      color: #333;
    }
    .number {
      text-align: center;
      padding: 5px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 3px;
    }
  </style>
</head>
<body>
  <h1>1から365までの数字を表示</h1>
  <div id="output"></div>

  <script>
    const outputDiv = document.getElementById('output');
    for (let i = 1; i <= 365; i++) {
      const numberDiv = document.createElement('div');
      numberDiv.classList.add('number');
      numberDiv.textContent = i;
      outputDiv.appendChild(numberDiv);
    }
  </script>
</body>
</html>
