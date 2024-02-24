<!doctype html>
<html lang="en">

<head>
    <title>Wedding</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="/front-end/css/flower-pink/style2.css">

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

    <style>
        .container-fluid {
            background-image: url('/storage/{{ $mempelai->cover }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        a {
            text-decoration: none
        }

        a:visited {
            color: white;
        }

    </style>

</head>

<body>

    <main>
        <div class="container-fluid">
            <section id="pinggiran">
                <div id="atas" class="position-relative">
                    <img width="140px" src="/front-end/img/bunga-atas.png" alt="" class="img-fluid position-fixed top-0 start-0 bunga-atas">
                </div>
                <div id="bawah" class="position-relative">
                    <img width="140px" src="/front-end/img/bunga-bawah.png" alt="" class="img-fluid position-fixed bottom-0 end-0 bunga-bawah">
                </div>
            </section>
            <div class="row" style="padding-top: 25vh">
                <div id="judul-cover" class="col">
                    <h2 class="fw-bold text-center" style="font-family: 'Pacifico', cursive; color: white; font-size : 5vmax; text-shadow: 3px 2px 1px black;">The Wedding
                    </h2>
                </div>
            </div>
            <div class="row" style="margin-top:26vh; font-size:0.8em">
                <div class="col d-flex justify-content-center align-items-center">
                    <p class="p-0 fst-italic text-white" style="text-shadow: 3px 2px 1px black;">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card d-flex justify-content-center align-items-center" style="background-color: rgba(255, 255, 255, 0.8); padding: 25px 0">
                        <div class="card-body">
                            <p class="m-0 fs-3" style="font-family: 'Times New Roman', Times, serif; color:black">{{ $nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="d-flex justify-content-center align-items-center ">
                        <a href="/{{ $mempelai->slug }}" class="badge mt-2 border-1" style="background-color: white; color: grey"><i data-feather="book-open" class="me-2"></i>Buka Undangan</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        feather.replace()

    </script>
    <script src="/js/page-script/front-end.js"></script>
    <!-- Countdown -->
    <script src="/front-end/js/flower-pink/countdown.js"></script>
    <!-- Animasi Javascript -->
    <script src="/front-end/js/flower-pink/script2.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
