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

    // NAVIGASI
    data.on("click", function () {
        akad_card.addClass("d-none")
        gallery_card.addClass("d-none")
        other_card.addClass("d-none")
        data_card.removeClass("d-none")

        data.removeClass("text-info")
        data.addClass("text-white")
        akad.removeClass("text-white")
        akad.addClass("text-info")
        gallery.removeClass("text-white")
        gallery.addClass("text-info")
        other.removeClass("text-white")
        other.addClass("text-info")
    })
    akad.on("click", function () {
        akad_card.removeClass("d-none")
        data_card.addClass("d-none")
        gallery_card.addClass("d-none")
        other_card.addClass("d-none")

        akad.removeClass("text-info")
        akad.addClass("text-white")
        data.removeClass("text-white")
        data.addClass("text-info")
        gallery.removeClass("text-white")
        gallery.addClass("text-info")
        other.removeClass("text-white")
        other.addClass("text-info")
    })
    gallery.on("click", function () {
        gallery_card.removeClass("d-none")
        akad_card.addClass("d-none")
        data_card.addClass("d-none")
        other_card.addClass("d-none")

        gallery.removeClass("text-info")
        gallery.addClass("text-white")
        akad.removeClass("text-white")
        akad.addClass("text-info")
        data.removeClass("text-white")
        data.addClass("text-info")
        other.removeClass("text-white")
        other.addClass("text-info")
    })
    other.on("click", function () {
        akad_card.addClass("d-none")
        gallery_card.addClass("d-none")
        data_card.addClass("d-none")
        other_card.removeClass("d-none")

        other.removeClass("text-info")
        other.addClass("text-white")
        data.removeClass("text-white")
        data.addClass("text-info")
        gallery.removeClass("text-white")
        gallery.addClass("text-info")
        akad.removeClass("text-white")
        akad.addClass("text-info")
    })

    $("#btn-back-1").on("click", function () {
        akad_card.addClass("d-none")
        gallery_card.addClass("d-none")
        other_card.addClass("d-none")
        data_card.removeClass("d-none")

        data.removeClass("text-info")
        data.addClass("text-white")
        akad.removeClass("text-white")
        akad.addClass("text-info")
        gallery.removeClass("text-white")
        gallery.addClass("text-info")
        other.removeClass("text-white")
        other.addClass("text-info")
    })
    $("#btn-back-3").on("click", function () {
        gallery_card.removeClass("d-none")
        akad_card.addClass("d-none")
        data_card.addClass("d-none")
        other_card.addClass("d-none")

        gallery.removeClass("text-info")
        gallery.addClass("text-white")
        akad.removeClass("text-white")
        akad.addClass("text-info")
        data.removeClass("text-white")
        data.addClass("text-info")
        other.removeClass("text-white")
        other.addClass("text-info")
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
                    displayErrors(response.errors);
                } else {
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
                    displayErrors(response.errors);
                } else {
                    console.log(response.success);
                    $("#data-card").addClass("d-none")
                    $("#gallery-card").removeClass("d-none")
                    $("#other-card").addClass("d-none")
                    $("#akad-card").addClass("d-none")

                    $("#gallery").removeClass("text-info")
                    $("#gallery").addClass("text-white")
                    $("#data").removeClass("text-white")
                    $("#data").addClass("text-info")
                    $("#other").removeClass("text-white")
                    $("#other").addClass("text-info")
                    $("#akad").removeClass("text-white")
                    $("#akad").addClass("text-info")
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
                            $('#refresh-gallery').html(data);
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
                } else {
                    $.ajax({
                        url: '/load-content',
                        data: {
                            id: response.success.mempelai_id
                        },
                        success: function (data) {
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
})
