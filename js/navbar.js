function updateClock() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();

  // Tambahkan leading zero jika angkanya di bawah 10
  hours = hours < 10 ? "0" + hours : hours;
  minutes = minutes < 10 ? "0" + minutes : minutes;
  seconds = seconds < 10 ? "0" + seconds : seconds;

  // Format tampilan jam digital
  var currentTime = hours + ":" + minutes + ":" + seconds;

  // Tampilkan pada elemen dengan ID 'digitalClock'
  document.getElementById("digitalClock").innerHTML = currentTime;
}

setInterval(updateClock, 1000);

updateClock();
