<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/items.css?ver=1.0">
    <title>PlayPal Загрузчик и плеер YouTube</title>
</head>
<body>

    <div class="container">
        <img class="qr"  src="img/qr.jpg" alt="">
        <br>
        <strong class="p">Поддержать проект на развитие</strong>
        <br><br>
        <img src="img/logo.png">
    <h1>Загрузчик и плеер YouTube</h1>
    <input type="text" id="url" placeholder="Вставьте URL видео"><br>
    <br>
    <div class="toggle-container">
        <input type="checkbox" id="audio" class="toggle-checkbox">
        <label for="audio" class="toggle-label"></label>
        <span class="toggle-text">Только аудио</span>
    </div>
    <br>
    <button onclick="downloadVideo()">Загрузить и воспроизвести</button>
     <br>
    <div id="video-container">
    </div>
    </div>
   <script src="js/main.js"></script>
</body>
</html>