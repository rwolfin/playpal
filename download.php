<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST["url"];

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
          http_response_code(400);
            exit("Неверный URL");
    }
  $urlDL = str_replace(array("https://www.youtube.com/", "https://youtu.be/", "https://youtube.com/"), array("", "") ,$url); //костыль который убирает https://www.youtube.com/
    $command = "/youtube/yt-dlp_linux --config-location /youtube/youtube-dl.conf -o '/Second_Disk/youtube-site/'".escapeshellarg($urlDL)."'.%(ext)s' " . escapeshellarg($url) . " 2>&1";
	$urlYT = urlencode($urlDL); //костыль чтобы оно из обычного текста переводилось в текст для адресной строки. Ну я хз как объяснить. Там типо всё в процентиках.

  $done = 1;

    exec($command, $output, $return_var);

        if ($return_var !== 0) {
             http_response_code(500);
             exit("Ошибка выполнения yt-dlp");
        }

    if ($done == 1) {
    echo json_encode(["done" => true, "urlYT" => $urlYT . ".mp4"]);
    exit(); // Прекращаем выполнение скрипта после ответа JSON
    } else {
    echo json_encode(["done" => false]);
    }
    
        $files = glob("*.mp4");
        if (empty($files)) {
         http_response_code(500);
         exit("Видео не найдено");
        }
        $file_path = $files[0];
       
        header('Content-Type: video/mp4');
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
       unlink($file_path);

}

?>
