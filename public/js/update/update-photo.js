$(document).ready(function () {
    let modal = $("#modal-cropper")
    let image = document.getElementById('image');
    let cropper, reader, file
    // Crop Foto Pria
    $("body").on("change", "#photo_pria", function (e) {
        $(".crop_pria").removeClass("d-none")
        $(".crop_gallery").addClass("d-none")
        $(".crop_wanita").addClass("d-none")
        let files = e.target.files;
        let done = function (url) {
            image.src = url;
            modal.modal("show");
        }

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                }
                reader.readAsDataURL(file)
            }
        }

    })

    modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1 / 1,
            preview: '.preview'
        })
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    })

    $(".crop_pria").on('click', function () {
        canvas = cropper.getCroppedCanvas({
            width: 1000,
            height: 1000,
        })

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            let reader = new FileReader();
            reader.readAsDataURL(blob)
            reader.onload = function () {
                document.getElementById('fotoPria').value = reader.result;
            }

            const imgPre = document.querySelector('.show-foto-pria');
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function (oFREvent) {
                imgPre.src = oFREvent.target.result;
            }
        })

        modal.modal("hide")
    })
})