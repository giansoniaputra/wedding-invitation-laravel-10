$(window).scroll(function () {
    let wScroll = $(this).scrollTop();
    console.log(wScroll)
    if (wScroll > 200) {
        $("#salam").css({
            'animation': 'scale 2s ease-in-out',
            'opacity': '100%'
        })
        $("#pembukaan").css({
            'animation': 'topToBottom 2s ease-in-out',
            'opacity': '100%'
        })
        $("#img-pria").css({
            'animation': 'leftToRight 2s ease-in-out',
            'opacity': '100%'
        })
        $("#img-pria .foto-pria").addClass('muncul')
        $("#img-wanita").css({
            'animation': 'rightToLeft 2s ease-in-out',
            'opacity': '100%'
        })
        $("#img-wanita .foto-wanita").addClass('muncul')
        $("#img-love").css({
            'animation': 'scale 2s ease-in-out',
            'opacity': '100%'
        })
        $("#nama-pria").css({
            'animation': 'scale 2s ease-in-out',
            'opacity': '100%'
        })
        $("#nama-wanita").css({
            'animation': 'scale 2s ease-in-out',
            'opacity': '100%'
        })
        $("#ortu-pria").css({
            'animation': 'leftToRight 2s ease-in-out',
            'opacity': '100%'
        })
        $("#ortu-wanita").css({
            'animation': 'rightToLeft 2s ease-in-out',
            'opacity': '100%'
        })
    }

    if (wScroll > 900) {
        $("#day").css({
            'animation': 'scale 1.5s ease-in-out',
            'opacity': '100%'
        })
        $("#akad").css({
            'animation': 'scale-delay-1 2s ease-in-out',
            'opacity': '100%'
        })
        $("#hari").css({
            'animation': 'scale-delay-1 2.4s ease-in-out',
            'opacity': '100%'
        })
        $("#tanggal").css({
            'animation': 'scale-delay-1 2.6s ease-in-out',
            'opacity': '100%'
        })
        $("#bulan").css({
            'animation': 'scale-delay-1 2.8s ease-in-out',
            'opacity': '100%'
        })
        $("#tahun").css({
            'animation': 'scale-delay-1 3s ease-in-out',
            'opacity': '100%'
        })
        $("#hari-s").css({
            'animation': 'scale-delay-1 2.4s ease-in-out',
            'opacity': '100%'
        })
        $("#tanggal-s").css({
            'animation': 'scale-delay-1 2.5s ease-in-out',
            'opacity': '100%'
        })
        $("#bulan-s").css({
            'animation': 'scale-delay-1 2.8s ease-in-out',
            'opacity': '100%'
        })
        $("#tahun-s").css({
            'animation': 'scale-delay-1 3s ease-in-out',
            'opacity': '100%'
        })
        $("#pukul").css({
            'animation': 'scale-delay-1 3.2s ease-in-out',
            'opacity': '100%'
        })
        $("#maps").css({
            'animation': 'scale-delay-1 3.2s ease-in-out',
            'opacity': '100%'
        })
        $("#countdown").css({
            'animation': 'scale-delay-1 3.3s ease-in-out',
            'opacity': '100%'
        })

    }

    if (wScroll >= 1500) {
        $("#resepsi").css({
            'animation': 'scale 1s ease-in-out',
            'opacity': '100%'
        })
        $("#hari-r").css({
            'animation': 'scale-delay-1 1.9s ease-in-out',
            'opacity': '100%'
        })
        $("#tanggal-r").css({
            'animation': 'scale-delay-1 2.1s ease-in-out',
            'opacity': '100%'
        })
        $("#bulan-r").css({
            'animation': 'scale-delay-1 2.3s ease-in-out',
            'opacity': '100%'
        })
        $("#tahun-r").css({
            'animation': 'scale-delay-1 2.5s ease-in-out',
            'opacity': '100%'
        })
        $("#hari-sr").css({
            'animation': 'scale-delay-1 1.9s ease-in-out',
            'opacity': '100%'
        })
        $("#tanggal-sr").css({
            'animation': 'scale-delay-1 2.1s ease-in-out',
            'opacity': '100%'
        })
        $("#bulan-sr").css({
            'animation': 'scale-delay-1 2.3s ease-in-out',
            'opacity': '100%'
        })
        $("#tahun-sr").css({
            'animation': 'scale-delay-1 2.5s ease-in-out',
            'opacity': '100%'
        })
        $("#pukul-r").css({
            'animation': 'scale-delay-1 2.7s ease-in-out',
            'opacity': '100%'
        })
        $("#maps-r").css({
            'animation': 'scale-delay-1 2.7s ease-in-out',
            'opacity': '100%'
        })
    }
    if ($("#status-story").val() == 1) {
        if (wScroll > 2600) {
            $(".judul-history").css({
                'animation': 'scale-delay-1 1.5s ease-in-out',
                'opacity': '100%'
            })
            $(".card-story").css({
                'animation': 'leftToRight 2s ease-in-out',
                'opacity': '100%'
            })
            $(".tanggal-story").css({
                'animation': 'leftToRight 2s ease-in-out',
                'opacity': '100%'
            })
            $(".card-text-story").css({
                'animation': 'leftToRight 2.5s ease-in-out',
                'opacity': '100%'
            })
        }

        if (wScroll > 3100) {
            $("#judul-2").css({
                'animation': 'scale 1.5s ease-in-out',
                'opacity': '100%'
            })
            $(".foto").css({
                'animation': 'scale-delay-1 2.7s ease-in-out',
                'opacity': '100%'
            })
        }
    } else {

        if (wScroll > 2450) {
            $("#judul-2").css({
                'animation': 'scale 1.5s ease-in-out',
                'opacity': '100%'
            })
            $(".foto").css({
                'animation': 'scale-delay-1 2.7s ease-in-out',
                'opacity': '100%'
            })
        }
    }
})
