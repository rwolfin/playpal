function downloadVideo() {
    const url = document.getElementById("url").value;
    const videoContainer = document.getElementById('video-container');
    videoContainer.innerHTML = 'Загрузка...';

    fetch('download.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `url=${encodeURIComponent(url)}`,
    })
        .then(response => {
            if (!response.ok) {
              
                return response.text().then(errorMessage => {
                  throw new Error(`HTTP error! Status: ${response.status}. ${errorMessage}`);
                   });
            }
            return response.json(); // Изменяем на json, потому что ждем ответа в json
        })
        .then(data => {
            if (data && data.done) {
                if (data.urlYT) {
                    window.location.href = `http://files.kolobok5447.ru/videos/youtube-site/${data.urlYT}`;
                  
                }
                else {
                  console.error("Ошибка: urlYT не получен с сервера");
                    videoContainer.innerHTML = "Ошибка: URL для перенаправления не был получен";
                 }
              }
                
             else {
                 
                return fetch('download.php', {
                  method: 'POST',
                headers: {
                 'Content-Type': 'application/x-www-form-urlencoded',
                },
               body: `url=${encodeURIComponent(url)}`,
                 })
                .then(response => {
                   if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                       }
                    return response.blob();
                     })
                  .then(blob => {
                         const videoURL = URL.createObjectURL(blob);
                        videoContainer.innerHTML = `<video controls width="100%"><source src="${videoURL}" type="video/mp4"></video>`;
                         })
                
                }
         
        })
        .catch(error => {
            console.error("Ошибка:", error);
            videoContainer.innerHTML = `Ошибка: ${error.message}`;
        });
}
