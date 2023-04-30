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
            url: '/dataTablesPayment',
            type: 'GET',
            data: function (d) {
                d.id = $("#id").val();
            }
        },
        // "columnDefs": [{
        //     "targets": [2], // index kolom atau sel yang ingin diatur
        //     "className": 'text-center' // kelas CSS untuk memposisikan isi ke tengah
        // }],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                "data": "jenis_pembayaran"
            },
            {
                "data": "nomor"
            },
            {
                "data": "atas_nama"
            },
            {
                "data": "action",
                "orderable": true,
                "searchable": true
            },
        ],
    });

    //Reset
    $("#jenis_pembayaran").on("click", function () {
        $("#jenis_pembayaran").removeClass('is-invalid');
    })
    $("#nomor").on("click", function () {
        $("#nomor").removeClass('is-invalid');
    })
    $("#atas_nama").on("click", function () {
        $("#atas_nama").removeClass('is-invalid');
    })
    $("#btn-close").on("click", function () {
        $("#atas_nama").val('');
        $("#nomor").val('');
        $("#jenis_pembayaran").val('');
    })
    $("#btn-x").on("click", function () {
        $("#atas_nama").val('');
        $("#nomor").val('');
        $("#jenis_pembayaran").val('');
    })

    //Tombol Action
    $("#btn-tambah").on("click", function () {
        $("#judul-modal").html("Tambah Cara Pembayaran")
        $(".method").html('')
        $(".current-id").html('')
        $(".btn-action").html('<button type="button" class="btn btn-primary btn-save btn-save">Create</button>')
    })

    // Action Save

    $("#modal-gift").on('click', ".btn-save", function () {
        NProgress.start();
        let formdata = $("#modal-gift form").serializeArray();
        let data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value
        });
        $.ajax({
            data: $('#modal-gift form').serialize(),
            url: "/addPayment",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(data);
                if (response.errors) {
                    NProgress.done();
                    // Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    NProgress.done();
                    $("#atas_nama").val('');
                    $("#nomor").val('');
                    $("#jenis_pembayaran").val('');
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    $('#modal-gift').modal('hide');
                    table.ajax.reload()
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    )
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                displayErrors(errors);
            }
        })
    })

    //Action Edit
    $("#dataTables").on("click", '.edit-payment-button', function () {
        let id = $(this).attr("data-id");
        $("#modal-gift").modal('show');
        $("#judul-modal").html('Edit Cara Pembayaran');
        $(".btn-action").html('<button type="button" class="btn btn-primary btn-update">Update</button>');

        $.ajax({
            data: {
                id: id
            },
            url: "/getDataPayment",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let current_id = response.data.id
                let jenis_pembayaran = response.data.jenis_pembayaran
                let nomor = response.data.nomor
                let nama = response.data.atas_nama

                $(".current-id").html('<input type="hidden" name="current_id" id="current_id" value="' + current_id + '">')
                $("#jenis_pembayaran").val(jenis_pembayaran)
                $("#nomor").val(nomor)
                $("#atas_nama").val(nama)
            }
        })
    })

    // Action Update
    $("#modal-gift").on("click", '.btn-update', function () {
        NProgress.start();
        let formdata = $("#modal-gift form").serializeArray()
        let data = {}
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value
        })

        $.ajax({
            data: $("#modal-gift form").serialize(),
            url: '/updateDataPayment',
            type: "POST",
            dataType: "json",
            success: function (response) {
                if (response.errors) {
                    displayErrors(response.errors);
                } else if (response.success) {
                    NProgress.done();
                    $("#atas_nama").val('');
                    $("#nomor").val('');
                    $("#jenis_pembayaran").val('');
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    $('#modal-gift').modal('hide');
                    table.ajax.reload()
                    Swal.fire(
                        'Good job!',
                        response.success,
                        'success'
                    )
                }
            }
        })
    })

    //Action Delete
    $("#dataTables").on('click', '.delete-payment-button', function () {
        let id = $(this).attr('data-id');
        let token = $(this).attr('data-token')

        Swal.fire({
            title: 'Yakin?',
            text: "Data ini akan terhapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data: {
                        id: id,
                        _token: token,
                    },
                    url: "/deleteDataPayment",
                    type: "POST",
                    dataType: 'json',
                    success: function (response) {
                        table.ajax.reload()
                        Swal.fire(
                            'Dihapus!',
                            response.success,
                            'success'
                          )
                    }
                })
            }
          })
    })

    //Errors Handle
    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $('input.form-control').removeClass('is-invalid');
        $('select.form-control').removeClass('is-invalid');
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
