$(document).ready(function () {
    //Deklarasi DataTables
    let table = $('#dataTables').DataTable({
        "processing": true,
        "responsive": true,
        "searching": true,
        "bLengthChange": true,
        "info": false,
        "ordering": true,
        "serverSide": true,
        "ajax": {
            url: '/dataTablesInvited',
            type: 'GET',
            data: function (d) {
                d.id = $("#id_mempelai").val();
            }
        },
        "columnDefs": [{
            "targets": [2], // index kolom atau sel yang ingin diatur
            "className": 'text-center' // kelas CSS untuk memposisikan isi ke tengah
        }],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                "data": "terundang"
            },
            {
                "data": "action",
                "orderable": true,
                "searchable": true
            },
        ],
    });

    let data = $("#data")
    let akad = $("#akad")
    let gallery = $("#gallery")
    let other = $("#other")

    let data_card = $("#data-card")
    let akad_card = $("#akad-card")
    let gallery_card = $("#gallery-card")
    let other_card = $("#other-card")
    // Reset Data
    $("#invited").on('click', function () {
        $("#invited").removeClass("is-invalid")
    })
    $("#nama_pria").on("click", function () {
        $("#nama_pria").removeClass("is-invalid")
    })
    $("#nama_wanita").on("click", function () {
        $("#nama_wanita").removeClass("is-invalid")
    })
    $("#ibu_pria").on("click", function () {
        $("#ibu_pria").removeClass("is-invalid")
    })
    $("#bapak_pria").on("click", function () {
        $("#bapak_pria").removeClass("is-invalid")
    })
    $("#ibu_wanita").on("click", function () {
        $("#ibu_wanita").removeClass("is-invalid")
    })
    $("#bapak_wanita").on("click", function () {
        $("#bapak_wanita").removeClass("is-invalid")
    })
    $("#putri_ke").on("change", function () {
        $("#putri_ke").removeClass("is-invalid")
    })
    $("#putra_ke").on("change", function () {
        $("#putra_ke").removeClass("is-invalid")
    })

    //Reset Akad
    $("#tanggal_akad").on("click", function () {
        $("#tanggal_akad").removeClass("is-invalid")
    })
    $("#alamat_akad").on("click", function () {
        $("#alamat_akad").removeClass("is-invalid")
    })
    $("#map_akad").on("click", function () {
        $("#map_akad").removeClass("is-invalid")
    })
    $("#tanggal_resepsi").on("click", function () {
        $("#tanggal_resepsi").removeClass("is-invalid")
    })
    $("#alamat_resepsi").on("click", function () {
        $("#alamat_resepsi").removeClass("is-invalid")
    })
    $("#map_resepsi").on("click", function () {
        $("#map_resepsi").removeClass("is-invalid")
    })
    $("#waktu_akad").on("click", function () {
        $("#waktu_akad").removeClass("is-invalid")
    })
    $("#waktu_resepsi").on("click", function () {
        $("#waktu_resepsi").removeClass("is-invalid")
    })
    $("#link_akad").on("click", function () {
        $("#link_akad").removeClass("is-invalid")
    })
    $("#link_resepsi").on("click", function () {
        $("#link_resepsi").removeClass("is-invalid")
    })

    $("#btn-back-1").on("click", function () {
        document.location.href = "#"
        akad_card.addClass("d-none")
        gallery_card.addClass("d-none")
        other_card.addClass("d-none")
        data_card.removeClass("d-none")

        $("#data").removeClass('d-none')
        $("#data span").removeClass('text-info')
        $("#data span").addClass('text-white')
        $("#akad").addClass('d-none')
    })
    $("#btn-back-3").on("click", function () {
        akad_card.removeClass("d-none")
        data_card.addClass("d-none")
        other_card.addClass("d-none")

        $("#akad span").removeClass('text-info')
        $("#akad span").addClass('text-white')
        $("#other").addClass('d-none')
    })
    $("#btn-back-2").on("click", function () {
        document.location.href = "#"
        gallery_card.addClass("d-none")
        akad_card.removeClass("d-none")
        data_card.addClass("d-none")
        other_card.addClass("d-none")
        $("#akad span").removeClass('text-info')
        $("#akad span").addClass('text-white')
        $("#gallery").addClass('d-none')
    })

    $("#refresh-gallery").on("click", "#save-gallery", function () {
        gallery_card.addClass("d-none")
        akad_card.addClass("d-none")
        data_card.addClass("d-none")
        other_card.removeClass("d-none")

        $("#other").removeClass('d-none')
        $("#other span").removeClass('text-info')
        $("#other span").addClass('text-white')
        $("#gallery span").removeClass('text-white')
        $("#gallery span").addClass('text-info')
    })

    // SLUGGEBLE
    $("#nama_wanita").on('change', function () {
        let title = $("#nama_pria").val() + " " + $("#nama_wanita").val();
        let token = $("#token").val();
        $.ajax({
            data: {
                title: title,
                _token: token
            },
            url: "/createSlug",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $("#slug").val(data.slug);
            }
        })
    })
    $("#nama_pria").on('change', function () {
        let title = $("#nama_pria").val() + " " + $("#nama_wanita").val();
        let token = $("#token").val();
        $.ajax({
            data: {
                title: title,
                _token: token
            },
            url: "/createSlug",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $("#slug").val(data.slug);
            }
        })
    })

    // Update Data Mempelai
    $('#save-data').on('click', function (e) {
        $("#akad").removeClass('d-none')
        $("#akad span").removeClass('text-info')
        $("#akad span").addClass('text-white')
        $("#data span").removeClass('text-white')
        $("#data span").addClass('text-info')


        NProgress.start();
        var formdata = $("#data-card form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#data-card form').serialize(),
            url: "/dataMempelai",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    $("#data").removeClass('d-none')
                    $("#data span").removeClass('text-info')
                    $("#data span").addClass('text-white')
                    $("#akad").addClass('d-none')
                    document.location.href = "#"
                    NProgress.done();
                    displayErrors(response.errors);
                } else {
                    NProgress.done();
                    $("#data-card").addClass("d-none")
                    $("#gallery-card").addClass("d-none")
                    $("#other-card").addClass("d-none")
                    $("#akad-card").removeClass("d-none")

                    $("#akad").removeClass("text-info")
                    $("#akad").addClass("text-white")
                    $("#data").removeClass("text-white")
                    $("#data").addClass("text-info")
                    $("#other").removeClass("text-white")
                    $("#other").addClass("text-info")
                    $("#gallery").removeClass("text-white")
                    $("#gallery").addClass("text-info")

                    document.location.href = "#"
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        });
    });

    // Update Data Akad dan REsepsi
    $('#save-akad').on('click', function (e) {
        $("#other").removeClass('d-none')
        $("#other span").removeClass('text-info')
        $("#other span").addClass('text-white')
        $("#akad span").removeClass('text-white')
        $("#akad span").addClass('text-info')
        NProgress.start();
        var formdata = $("#akad-card form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#akad-card form').serialize(),
            url: "/akadMempelai",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    $("#akad").removeClass('d-none')
                    $("#akad span").removeClass('text-info')
                    $("#akad span").addClass('text-white')
                    $("#data span").removeClass('text-white')
                    $("#data span").addClass('text-info')
                    $("#gallery").addClass('d-none')
                    NProgress.done();
                    displayErrors(response.errors);
                    document.location.href = "#"
                } else {
                    NProgress.done();
                    $("#data-card").addClass("d-none")
                    $("#other-card").removeClass("d-none")
                    $("#akad-card").addClass("d-none")

                    $("#data").removeClass("text-white")
                    $("#data").addClass("text-info")
                    $("#other").removeClass("text-info")
                    $("#other").addClass("text-white")
                    $("#akad").removeClass("text-white")
                    $("#akad").addClass("text-info")
                    document.location.href = "#"
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        });
    });
    // TAMU UNDANGAN
    //Tambah Tamu Undangan
    $('#save-invite').on('click', function (e) {
        var formdata = $("#other-card form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#other-card form').serialize(),
            url: "/inviteMempelai",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    $("#invited").val('')
                    table.ajax.reload();
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        });
    });
    // Edit tamu undangan
    // Ambil datanya
    $('#dataTables').on('click', '.edit-invited-button', function () {
        let id = $(this).attr('data-id')
        $("#modal-invited").modal('show');
        $.ajax({
            data: {
                id: id
            },
            url: "/editInvited",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $("#id_edit_mempelai").val(data.invited.id)
                $("#edit_invited").val(data.invited.invited)
            }
        })
    });

    //Actionnya
    $('.btn-update-tamu').on('click', function (e) {
        var formdata = $("#modal-invited form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#modal-invited form').serialize(),
            url: "/updateInvited",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    //Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    // console.log(response);
                    $('#modal-invited').modal('hide');
                    table.ajax.reload()
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        });
    });

    // Hapus Data Tamu Undangan
    $('#dataTables').on('click', '.delete-invited-button', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let token = $(this).attr('data-token');
                let id = $(this).attr('data-id');
                let method = $(this).attr('data-method');
                $.ajax({
                    data: {
                        id: id,
                        _token: token,
                    },
                    url: "/deleteInvited",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data)
                        table.ajax.reload()
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                })
            }
        })
    });

    $("#save-photo").on('click', function () {
        NProgress.start();
        var formdata = $("#gallery-card form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        // console.log(formdata);
        $.ajax({
            data: $('#gallery-card form').serialize(),
            url: "/uploadPhoto",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    //Jika ada pesan error, tampilkan pesan error pada form
                    NProgress.done();
                    displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    // console.log(response.success.mempelai_id);
                    $.ajax({
                        url: '/load-content',
                        data: {
                            id: response.success.mempelai_id
                        },
                        success: function (data) {
                            NProgress.done();
                            $('#refresh-gallery').html(data);
                            $("#photo").val(null)
                            $("#base64img").val('')
                        }
                    });
                    // $('#modal-invited').modal('hide');
                    // table.ajax.reload()
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: response.success,
                    //     showConfirmButton: false,
                    //     timer: 1000
                    //   })
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        })
    })

    $("#photo").on('click', function () {
        $("#base64img").removeClass("is-invalid");
    })

    $("#refresh-gallery").on('click', '.btn-hapus-foto', function () {
        NProgress.start();
        let id = $(this).attr('data-id');
        let mempelai_id = $(this).attr('data-mempelai_id');
        $.ajax({
            data: {
                id: id,
                mempelai_id: mempelai_id
            },
            url: "/deletePhoto",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    //Jika ada pesan error, tampilkan pesan error pada form
                    // displayErrors(response.errors);
                    NProgress.done();
                } else {
                    $.ajax({
                        url: '/load-content',
                        data: {
                            id: response.success.mempelai_id
                        },
                        success: function (data) {
                            NProgress.done();
                            $('#refresh-gallery').html(data);
                        }
                    });
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        })
    })


    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $('input.form-control').removeClass('is-invalid');
        $('div.invalid-feedback').remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            var inputElement = $('input[name=' + field + ']');
            var selectElement = $('select[name=' + field + ']');
            var feedbackElement = $('<div class="invalid-feedback"></div>');

            $.each(messages, function (index, message) {
                feedbackElement.append($('<p>' + message + '</p>'));
            });

            if (inputElement.length > 0) {
                inputElement.addClass('is-invalid');
                inputElement.after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass('is-invalid');
                selectElement.after(feedbackElement);
            }
        });
    }


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

    // Crop Foto Wanita
    $("body").on("change", "#photo_wanita", function (e) {
        $(".crop_wanita").removeClass("d-none")
        $(".crop_gallery").addClass("d-none")
        $(".crop_pria").addClass("d-none")
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

    // Crop Foto Galley
    $("body").on("change", "#photo", function (e) {
        $(".crop_gallery").removeClass("d-none")
        $(".crop_wanita").addClass("d-none")
        $(".crop_pria").addClass("d-none")
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

    $(".crop_wanita").on('click', function () {
        canvas = cropper.getCroppedCanvas({
            width: 1000,
            height: 1000,
        })

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            let reader = new FileReader();
            reader.readAsDataURL(blob)
            reader.onload = function () {
                document.getElementById('fotoWanita').value = reader.result;
            }

            const imgPre = document.querySelector('.show-foto-wanita');
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function (oFREvent) {
                imgPre.src = oFREvent.target.result;
            }
        })

        modal.modal("hide")
    })

    $(".crop_gallery").on('click', function () {
        canvas = cropper.getCroppedCanvas({
            width: 1000,
            height: 1000,
        })

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            let reader = new FileReader();
            reader.readAsDataURL(blob)
            reader.onload = function () {
                document.getElementById('base64img').value = reader.result;
            }
        })

        modal.modal("hide")
    })

})
