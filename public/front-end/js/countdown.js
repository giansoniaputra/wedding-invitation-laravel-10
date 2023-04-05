$(document).ready(function () {
    // Atur waktu akhir hitung mundur (YYYY/MM/DD HH:MM:SS)
    let tanggal = document.getElementById('tanggal_akad_db').value;
    let waktu = document.getElementById('waktu_akad_db').value;
    let waktuResepsi = document.getElementById('waktu_resepsi_db').value;
    let waktuResepsiBaru = waktuResepsi.split(':');
    let waktuBaru = waktu.split(':');
    let tanggalBaru = tanggal.split("-").join("/");
    var countDownDate = new Date(tanggalBaru+' '+waktu).getTime();

    // Update hitung mundur setiap 1 detik
    var x = setInterval(function () {

        // Dapatkan tanggal dan waktu saat ini
        var now = new Date().getTime();

        // Hitung selisih waktu antara sekarang dan waktu akhir hitung mundur
        var distance = countDownDate - now;

        // Hitung waktu dalam hari, jam, menit, dan detik
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Tampilkan hitung mundur dalam elemen HTML yang ditentukan
        document.getElementById("cd-hari").innerHTML = days
        document.getElementById("cd-jam").innerHTML = hours
        document.getElementById("cd-menit").innerHTML = minutes
        document.getElementById("cd-detik").innerHTML = seconds

        // Jika hitung mundur selesai, hentikan hitung mundur
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Waktu hitung mundur sudah berakhir!";
            document.getElementById("countdown").classList.add('text-center');
        }
    }, 1000);

    document.getElementById("waktuBaru").innerHTML = waktuBaru[0]+':'+waktuBaru[1];
    document.getElementById("waktu_res").innerHTML = waktuResepsiBaru[0]+':'+waktuResepsiBaru[1];
});
