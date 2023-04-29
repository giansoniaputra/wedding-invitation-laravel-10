<!doctype html>
<html lang="en">

<head>
    <title>Wedding</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/front-end/css/flower-pink/style2.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- FONT GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Pacifico -->
    <!-- font-family: 'Pacifico', cursive; -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <!-- Dencing -->
    <!-- font-family: 'Dancing Script', cursive; -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

</head>

<body class="bodyku">
    {{-- NavBar --}}
    <header>
        <nav class="navbar rounded fixed-bottom mx-1 mb-1" style="background-color:rgba(59, 72, 109, 0.8)">
            <div class="container">
                <a class="btn btn-outline-light rounded py-1 px-2" href="#"><i data-feather="home"
                        style="width:17px"></i></a>
                <a class="btn btn-outline-light rounded py-1 px-2" href="#mempelai"><i data-feather="book-open"
                        style="width:17px"></i></a>
                <a class="btn btn-outline-light rounded py-1 px-2" href="#waktu"><i data-feather="calendar"
                        style="width:17px"></i></a>
                <a class="btn btn-outline-light rounded py-1 px-2" href="#party"><i data-feather="gift"
                        style="width:17px"></i></a>
                @if($mempelai->story == 1)
                    <a class="btn btn-outline-light rounded py-1 px-2" href="#story"><i data-feather="heart"
                            style="width:17px"></i></a>
                @endif
                <a class="btn btn-outline-light rounded py-1 px-2" href="#gallery"><i data-feather="aperture"
                        style="width:17px"></i></a>
                <a class="btn btn-outline-light rounded py-1 px-2" href="#doa"><i data-feather="mail"
                        style="width:17px"></i></a>
                <a class="btn btn-outline-light rounded py-1 px-2" href="#mengundang"><i data-feather="list"
                        style="width:17px"></i></a>
            </div>
        </nav>
    </header>
    {{-- Hidden Input --}}
    <input type="hidden" id="status-story" value="{{ $mempelai->story }}">
    {{-- Bunga Di Pinggir --}}
    <section id="pinggiran">
        <div id="atas" class="position-relative">
            <img width="140px" src="/front-end/img/bunga-atas.png" alt=""
                class="img-fluid position-fixed top-0 start-0 bunga-atas">
        </div>
        <div id="bawah" class="position-relative">
            <img width="140px" src="/front-end/img/bunga-bawah.png" alt=""
                class="img-fluid position-fixed bottom-0 end-0 bunga-bawah">
        </div>
    </section>
    <main>
        <i id="pause" data-feather="pause-circle" class="text-white"
            style="position: fixed; left : 10px; border-radius: 50%; bottom : 100px;  background-color:rgba(59, 72, 109, 0.8); z-index:100"></i>
        <i id="play" data-feather="play-circle" class="text-white d-none"
            style="position: fixed; left : 10px; border-radius: 50%; bottom : 100px;  background-color:rgba(59, 72, 109, 0.8); z-index:100"></i>
        {{-- Halaman Utama Mempelai --}}
        <section id="home" class="home" style=" height: 100vh;
        background-image: url('storage/{{ $mempelai->cover }}');
        background-size: cover;
        background-position: center;">
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="row">
                    <div id="judul" class="col">
                        <h2 class="fw-bold text-center"
                            style="font-family: 'Pacifico', cursive; color: white; font-size : 5vmax; text-shadow: 3px 2px 1px black;">
                            The Wedding
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div id="bunga" class="col d-flex justify-content-center align-items-center">
                        <img src="/front-end/img/badge.png" class="img-fluid">
                    </div>
                    <div id="nama-mempelai" class="col position-absolute top-50 start-50 translate-middle pt-5">
                        <h1 class="text-center text-white fst-bold fs-1"
                            style="font-family: 'Dancing Script', cursive; text-shadow: 3px 2px 1px black;">
                            {{ ucwords(strtolower($mempelai->nama_pria)) }}
                            <br> & <br> {{ ucwords(strtolower($mempelai->nama_wanita)) }}</h1>
                    </div>
                </div>
            </div>
        </section>
        {{-- Data Mempelai --}}
        <section id="mempelai">
            <!-- Container -->
            <div class="conteiner kartu m-2 " style="padding : 10px 10px; height: 90vh;">
                <!-- Salam -->
                <div class="row mb-3 pt-5">
                    <div id="salam" class="col">
                        <h1 class="fs-3 fw-bold text-center"
                            style="font-family: 'Times New Roman', Times, serif; color: #3B486D;">
                            Assalamualaikum
                            Wr. Wb.</h1>
                    </div>
                </div>
                <!-- Pembukaan -->
                <div class="row">
                    <div id="pembukaan" class="col">
                        <p class="text-center mb-5 mx-1 tulisan fs-6"
                            style="font-family: 'Times New Roman', Times, serif;">Dengan memohon rahmatdan ridho Allah
                            Subhanahu Wa
                            Ta’ala, insyaaAllah kami akan menyelenggarakan acara pernikahan :</p>
                    </div>
                </div>
                <!-- Gambar -->
                <div class="row text-center">
                    <div id="img-pria" class="col-5">
                        <img width="120px" src="/storage/post-images/mempelai/{{ $mempelai->photo_pria }}"
                            class="img-thumbnail rounded-circle foto-pria" alt="">
                    </div>
                    <div id="img-love" class="col-2 d-flex justify-content-center align-items-center">
                        <img src="/front-end/img/love.png" alt="" class="mx-2 img-fluid love">
                    </div>
                    <div id="img-wanita" class="col-5">
                        <img width="120px" src="/storage/post-images/mempelai/{{ $mempelai->photo_wanita }}"
                            class="img-thumbnail rounded-circle foto-wanita" alt="">
                    </div>
                </div>
                <!-- Nama Pria -->
                <div class="container d-flex flex-column justify-content-center align-items-center">
                    <div class="row mt-5">
                        <div id="nama-pria" class="col">
                            <h1 style="font-family: 'Dancing Script', cursive; color: #3B486D;" class="fs-1 fw-bold">
                                {{ ucwords(strtolower( $mempelai->nama_pria)) }}
                            </h1>
                        </div>
                    </div>
                    <!-- Ortu Pria -->
                    <div class="row">
                        <div id="ortu-pria" class="col">
                            <p class="fs-6 text-center">Putra {{ $mempelai->putra_ke }} dari Bpk
                                {{ ucwords(strtolower($mempelai->bapak_pria)) }} dan Ibu
                                {{ ucwords(strtolower($mempelai->ibu_pria)) }}</p>
                        </div>
                    </div>
                    <!-- Nama Wanita -->
                    <div class="row">
                        <div id="nama-wanita" class="col">
                            <h1 style="font-family: 'Dancing Script', cursive; color: #3B486D;" class="fs-1 fw-bold">
                                {{ ucwords(strtolower( $mempelai->nama_wanita)) }}</h1>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <!-- ortu Wanita -->
                        <div id="ortu-wanita" class="col">
                            <p class="fs-6 text-center">Putra {{ $mempelai->putra_ke }} dari Bpk
                                {{ ucwords(strtolower( $mempelai->bapak_wanita)) }} dan Ibu
                                {{ ucwords(strtolower( $mempelai->ibu_wanita)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Akad Mempelai --}}
        <section id="waktu" class="p-2">
            {{-- Rangkaian Acara --}}
            <div class="container-fluid kartu" style="padding : 10px 10px;">
                <div class="row">
                    <div id="day" class="col">
                        <h1 class="h1 text-center fw-bold fs-1"
                            style="font-family: 'Times New Roman', Times, serif; color:#3B486D">Acara</h1>
                    </div>
                </div>
                <div class="kartu2" style="padding : 10px 10px;">
                    {{-- Judul Akad --}}
                    <div class="row">
                        <div id="akad" class="col">
                            <p class="text-center fs-4 fw-bold mb-2 border rounded"
                                style="font-family: 'Times New Roman', Times, serif; color:#3B486D">Akad Nikah</p>
                        </div>
                    </div>
                    {{-- Hari Akad --}}
                    <div class="row">
                        <div id="hari" class="col-12">
                            <h5 class="text-center fw-bold"
                                style="font-family: 'Times New Roman', Times, serif; color:#3B486D">
                                {{ $hari[date('l', strtotime($mempelai->tanggal_akad))] }}
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-1" style="color:#3B486D;font-family: 'Times New Roman', Times, serif;">
                        {{-- Tanggal Akad --}}
                        <div id="tanggal" class="col-4 border-end">
                            <h5 class="text-center fw-bold">
                                {{ date('d', strtotime($mempelai->tanggal_akad)) }}</h5>
                        </div>
                        {{-- Bulan Akad --}}
                        <div id="bulan" class="col-4 border-end">
                            <h5 class="text-center fw-bold">
                                {{ $bulan[date('F', strtotime($mempelai->tanggal_akad))] }}
                            </h5>
                        </div>
                        {{-- Tahun Akad --}}
                        <div id="tahun" class="col-4">
                            <h5 class="text-center fw-bold">
                                {{ date('Y', strtotime($mempelai->tanggal_akad)) }}</h5>
                        </div>
                    </div>
                    {{-- Keterangan --}}
                    <div class="row" style="color:#3B486D;font-family: 'Times New Roman', Times, serif;">
                        <div id="tanggal-s" class="col-4">
                            <h4 class="text-center fs-6">Tanggal</h4>
                        </div>
                        <div id="bulan-s" class="col-4">
                            <h4 class="text-center fs-6">Bulan</h4>
                        </div>
                        <div id="tahun-s" class="col-4">
                            <h4 class="text-center fs-6">Tahun</h4>
                        </div>
                    </div>
                    <div id="pukul" class="row mt-2">
                        {{-- Waktu Akad --}}
                        <div class="col-12">
                            <h6 class="text-center" style="font-size: 0.8em;">Pukul <span
                                    id="waktuBaru">{{ $mempelai->waktu_akad }}</span> - Selesai</h6>
                        </div>
                        {{-- Alamat Akad --}}
                        <div class="col-12">
                            <h6 class="text-center">Alamat:</h6>
                        </div>
                        <div class="col-12">
                            <h6 class="text-center" style="font-size: 0.8em;">{{ $mempelai->alamat_akad }}</h6>
                        </div>
                    </div>
                    <div id="maps" class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    {{-- Map Iframe Akad --}}
                                    <?= $mempelai->map_akad; ?>
                                    {{-- Link Google Map --}}
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ $mempelai->link_akad }}" target="_blank" class="badge mt-2"
                                            style="background-color: rgb(59, 72, 109)"><i data-feather="map"
                                                class="me-2"></i>Lihat
                                            Lokasi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kartu2 mt-4 p-2" id="countdown">
                        {{-- Data tanggal yang diambil javascript untuk countdown --}}
                        <input type="hidden" id="tanggal_akad_db" value="{{ $mempelai->tanggal_akad }}">
                        {{-- Data waktu yang diambil javascript untuk countdown --}}
                        <input type="hidden" id="waktu_akad_db" value="{{ $mempelai->waktu_akad }}">

                        <div class="row d-flex justify-content-center align-items-center">
                            {{-- Countdown Hari, Jam, Menit dan detik di isi oleh javascript --}}
                            <div class="col-3">
                                <div class="card d-flex justify-content-center align-items-center">
                                    <div class="card-body p-2 text-center">
                                        <span class="d-block fs-2" id="cd-hari">3</span>
                                        <span>Hari</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card d-flex justify-content-center align-items-center">
                                    <div class="card-body text-center p-2">
                                        <span class="d-block fs-2" n id="cd-jam">23</span>
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card d-flex justify-content-center align-items-center">
                                    <div class="card-body text-center p-2">
                                        <span class="d-block fs-2" id="cd-menit">45</span>
                                        <span>Menit</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card d-flex justify-content-center align-items-center">
                                    <div class="card-body text-center p-2">
                                        <span class="d-block fs-2" id="cd-detik">59</span>
                                        <span>Detik</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="party" style="padding-top:15px;">
                        {{-- Judul Resepsi --}}
                        <div id="resepsi" class="col">
                            <p class="text-center fs-4 fw-bold mb-2 border rounded"
                                style="font-family: 'Times New Roman', Times, serif; color:#3B486D">Resepsi</p>
                        </div>
                    </div>
                    {{-- Waktu hidden resepsi --}}
                    <input type="hidden" id="waktu_resepsi_db" value="{{ $mempelai->waktu_resepsi }}">
                    <div class="row">
                        {{-- Hari resepsi --}}
                        <div id="hari-r" class="col-12">
                            <h5 class="text-center fw-bold"
                                style="font-family: 'Times New Roman', Times, serif; color:#3B486D">
                                {{ $hari[date('l', strtotime($mempelai->tanggal_resepsi))] }}
                            </h5>
                        </div>
                    </div>
                    <div class="row mt-1" style="color:#3B486D;font-family: 'Times New Roman', Times, serif;">
                        {{-- Tanggal Resepsi --}}
                        <div id="tanggal-r" class="col-4 border-end">
                            <h5 class="text-center fw-bold">
                                {{ date('d', strtotime($mempelai->tanggal_resepsi)) }}</h5>
                        </div>
                        {{-- BUlan Resepsi --}}
                        <div id="bulan-r" class="col-4 border-end">
                            <h5 class="text-center fw-bold">
                                {{ $bulan[date('F', strtotime($mempelai->tanggal_resepsi))] }}
                            </h5>
                        </div>
                        {{-- Tahun Resepsi --}}
                        <div id="tahun-r" class="col-4">
                            <h5 class="text-center fw-bold">
                                {{ date('Y', strtotime($mempelai->tanggal_resepsi)) }}</h5>
                        </div>
                    </div>
                    {{-- Keterangan waktu --}}
                    <div class="row" style="color:#3B486D;font-family: 'Times New Roman', Times, serif;">
                        <div id="tanggal-sr" class="col-4">
                            <h4 class="text-center fs-6">Tanggal</h4>
                        </div>
                        <div id="bulan-sr" class="col-4">
                            <h4 class="text-center fs-6">Bulan</h4>
                        </div>
                        <div id="tahun-sr" class="col-4">
                            <h4 class="text-center fs-6">Tahun</h4>
                        </div>
                    </div>
                    <div id="pukul-r" class="row mt-2">
                        {{-- Waktu resepsi --}}
                        <div class="col-12">
                            <h6 class="text-center" style="font-size: 0.8em;">Pukul <span id="waktu_res"></span> -
                                Selesai</h6>
                        </div>
                        {{-- Alamat Resepsi --}}
                        <div class="col-12">
                            <h6 class="text-center">Alamat:</h6>
                        </div>
                        <div class="col-12">
                            <h6 class="text-center" style="font-size: 0.8em;">M5W6+HVG, Jalan, Bungursari, Tasikmalaya
                                Regency, West Java 46151</h6>
                        </div>
                    </div>
                    <div id="maps-r" class="row" style="padding-bottom:70px">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    {{-- Map Iframe Resepsi --}}
                                    <?= $mempelai->map_resepsi; ?>
                                    {{-- Link Google Map Resepsi --}}
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ $mempelai->link_resepsi }}" target="_blank" class="badge mt-2"
                                            style="background-color: rgb(59, 72, 109)"><i data-feather="map"
                                                class="me-2"></i>Lihat
                                            Lokasi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if($mempelai->story == 1)
            <section id="story" class="mb-3 p-2">
                <div class="container-fluid kartu" style="padding : 10px 10px;">
                    <div class="row">
                        <div class="col">
                            <h1 id="judul-3" class="h1 text-center judul-history"
                                style="font-family: 'Times New Roman', Times, serif; color:#3B486D">
                                Perjalanan Cinta</h1>
                        </div>
                    </div>
                    @foreach($stories as $story)
                        <div class="row mt-3 ps-3">
                            @php
                                $day = $hari[date('l', strtotime($story->tanggal))];
                                $month = $bulan[date('F', strtotime($story->tanggal))];
                            @endphp
                            <div class="col">
                                <p class="m-0 fw-bold tanggal-story" style="color:#3B486D">{{ $day }},
                                    {{ date('d', strtotime($story->tanggal)) }} {{ $month }}
                                    {{ date('Y', strtotime($story->tanggal)) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ps-4">
                                <div class="card text-start card-story">
                                    <div class="card-body card-text-story">
                                        <p class="fst-italic fs-6">{{ $story->story }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        {{-- Gallery --}}
        <section id="gallery" class="mb-3 p-2">
            <div class="container-fluid kartu" style="padding : 10px 10px;">
                <div class="row mb-3">
                    <div class="col">
                        {{-- Judul Gallery --}}
                        <h1 id="judul-2" class="h1 text-center"
                            style="font-family: 'Times New Roman', Times, serif; color:#3B486D">
                            Gallery</h1>
                    </div>
                </div>
                {{-- Pengulangan Foto --}}
                <div id="foto-head" class="row">
                    @foreach($photos as $photo)
                        <div class="col-6 mb-3">
                            <div>
                                <div class="kartu2 foto">
                                    <img src="/storage/post-images/gallery/{{ $photo->photo }}" alt=""
                                        class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </section>
        {{-- Ucapan kepada mempelai --}}
        <section id="doa" class="mb-3 p-2">
            {{-- Judul Ucapan --}}
            <div class="container-fluid kartu" style="padding : 10px 10px;">
                <h1 class="h1 text-center" style="font-family: 'Times New Roman', Times, serif; color:rgb(59, 72, 109)">
                    Ucapan &
                    Doa</h1>
                <div class="card">
                    <div class="card-body">
                        {{-- Form --}}
                        <form action="javascript:void(0)">
                            @csrf
                            <input type="hidden" name="id" value="{{ $mempelai->id }}">
                            {{-- Nama Pengirim --}}
                            <div class="mb-3">
                                <label for="nama-pengirim" class="form-label">Nama Pengirim</label>
                                <input type="text" class="form-control" id="nama-pengirim" name="nama_pengirim"
                                    placeholder="Masukan Nama Anda">
                            </div>
                            {{-- Hadir/Tidak Hadir --}}
                            <div class="mb-3">
                                <label for="kehadiran">Kehadiran</label>
                                <select class="form-control" id="kehadiran" name="kehadiran">
                                    <option value="">...</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Belum Pasti">Belum Pasti</option>
                                    <option value="Tidak Bisa Hadir">Tidak Bisa Hadir</option>
                                </select>
                            </div>
                            {{-- Pesan dari pengirim --}}
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea type="text" class="form-control" id="pesan" name="pesan"
                                    placeholder="Masukan Pesan Anda" style="height: 100px"></textarea>
                            </div>
                            <div class="mt-1 mb-3">
                                <small class="terkirim text-success fst-italic"></small>
                            </div>
                            {{-- TOmbol Kirim --}}
                            <button type="submit" class="btn send-ucapan text-white"
                                style="background-color: rgb(59, 72, 109)">Kirim Ucapan</button>
                        </form>
                    </div>
                    {{-- Pengulangan Ucapan --}}
                    <div class="card border-0 p-2" style="height: 300px; overflow: auto;">
                        <div class="card-body rounded refresh"
                            style="background-image: url('/img/bg-pesan.png'); background-repeat: cover; ">
                            @foreach($ucapan as $row)
                                <div class="row mb-2">
                                    <div class="col d-flex align-items-center">
                                        <img src="/front-end/img/icon/poster.png" alt=""
                                            class="img-fluid rounded-circle" width="30px">
                                        <p class="ms-3 mb-0 ml-1 text-white">
                                            {{ $row->pengirim }} @if($row->kehadiran == 'Hadir') (<small
                                                class="text-info"><b> Hadir </b></small>) @elseif($row->kehadiran ==
                                            'Belum Pasti') (<small class="text-warning"><b> Belum Pasti </b></small>)
                                            <blade
                                                elseif|(%24row-%3Ekehadiran%20%3D%3D%20%26%2339%3BTidak%20Bisa%20Hadir%26%2339%3B)%20(%3Csmall />
                                            class="text-danger"><b> Tidak Bisa Hadir </b></small>) @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row mb-2 ms-3">
                                    <div class="col d-flex">
                                        <img src="/front-end/img/pojok.png" alt="" width="15px" height="9px"
                                            class="d-inline border-0">
                                        <div class="card border-0"
                                            style="border-radius:0 7px 7px 7px; background-color:#202C33;">
                                            <div class="card-body p-2">
                                                <small
                                                    class="mb-0 ml-1 fst-italic text-white">{{ $row->ucapan }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Turut Mengundangan --}}
        <section id="mengundang" class="mb-3 p-2">
            <div class="container kartu" style="padding : 10px 10px;">
                <div class="row mb-3">
                    <div class="col">
                        <h1 class="h1 text-center" style="font-family: 'Times New Roman', Times, serif; color:#3B486D">
                            Turut Mengundang</h1>
                    </div>
                </div>
                {{-- Pengulangan Unfangan --}}
                <div class="kartu2 p-2">
                    @foreach($invited as $invite)
                        <p class="p-0 mb-2">{{ $invite->invited }}</p>
                    @endforeach
                </div>
            </div>
        </section>
        <section id="protokol" class="mb-3 p-2">
            <div class="container kartu" style="padding : 10px 10px;">
                <div class="row mb-3">
                    <div class="col">
                        <h1 class="h1 text-center" style="font-family: 'Times New Roman', Times, serif; color:#3B486D">
                            Protokol Kesehatan</h1>
                    </div>
                </div>
                <div class="kartu2 p-2" style="background-color: rgb(59, 72, 109)">
                    <div class="row p-4">
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <img src="/front-end/img/protokol/cucitangan.png" alt="" class="img-thumbnail"
                                width="250px">
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <img src="/front-end/img/protokol/masker.png" alt="" class="img-thumbnail" width="250px">
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <img src="/front-end/img/protokol/jarak.png" alt="" class="img-thumbnail" width="250px">
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <img src="/front-end/img/protokol/bersih.png" alt="" class="img-thumbnail" width="250px">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- Footer --}}
    <audio id="audio" src="/music/ATY.mp3" autoplay></audio>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col mt-2">
                    <h1 class="text-center fs-5 text-white">❣ Gian Production</h1>
                    <div class="row">
                        <div class="col mb-2 d-flex justify-content-center align-items-center">
                            <img src="/front-end/img/icon/wa.png" alt="img-thumbnail" width="25px"><span
                                class="ms-2 text-white">082321634181</span>
                        </div>
                        <div class="col mb-2 d-flex justify-content-center align-items-center">
                            <img src="/front-end/img/icon/gmail.png" alt="img-thumbnail" width="25px"><span
                                class="ms-2 text-white">giansonia555@gmail.com</span>
                        </div>
                        <div class="co mb-2l d-flex justify-content-center align-items-center">
                            <a href="https://www.instagram.com/giansonia.io"></a><img src="/front-end/img/icon/ig.png"
                                alt="img-thumbnail" width="25px"><span class="ms-2 text-white">giansoniaputra</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Feater Icon -->
    <script>
        feather.replace()

    </script>
    <script src="/js/page-script/front-end.js"></script>
    <!-- Countdown -->
    <script src="/front-end/js/flower-pink/countdown.js"></script>
    <!-- Animasi Javascript -->
    <script src="/front-end/js/flower-pink/script2.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
