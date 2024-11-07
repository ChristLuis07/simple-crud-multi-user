<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigitalClock</title>
    <link
      rel="stylesheet"
      href="../bootstrap-5.0.2-dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div id="digital-clock bg-primary" class="fs-3 text-end me-5">
      <div id="time" class="time"></div>
    </div>
    <script>
      function updateTime() {
        const clock = document.getElementById("time");
        const now = new Date();
        let hours = now.getHours().toString().padStart(2, "0");
        let minutes = now.getMinutes().toString().padStart(2, "0");
        let seconds = now.getSeconds().toString().padStart(2, "0");
        clock.textContent = `${hours}:${minutes}:${seconds}`;
      }

      // Memanggil fungsi setiap detik
      setInterval(updateTime, 1000);

      // Memanggil fungsi pertama kali saat halaman dimuat
      window.onload = updateTime;
    </script>
  </body>
</html>
