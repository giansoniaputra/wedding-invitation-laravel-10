// Inisialisasi Data Table
$(document).ready(function () {
    let table = $('#dataTables').DataTable({
        "processing": true,
        "responsive": true,
        "searching": true,
        "bLengthChange": true,
        "info": false,
        "ordering": true,
        "serverSide": true,
        "ajax": "/dataTables",
        "columnDefs": [{
            "targets": [5], // index kolom atau sel yang ingin diatur
            "className": 'text-center' // kelas CSS untuk memposisikan isi ke tengah
        }],
        "columns": [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                "data": "name"
            },
            {
                "data": "username"
            },
            {
                "data": "email"
            },
            {
                "data": "roles"
            },
            {
                "data": "action",
                "orderable": true,
                "searchable": true
            },
        ],
        "order": [
            [0, 'desc']
        ]
    });

    // Declarasi Field Input
    let username = $("#username")
    let password = $("#password")
    let password_confirmation = $("#password_confirmation")
    let name = $("#name")
    let email = $("#email")
    let roles = $("#roles")

    // Reset Input
    $("#btn-close").on('click', function () {
        username.val('')
        password.val('')
        password_confirmation.val('')
        name.val('')
        email.val('')
        roles.val('')
        name.removeClass('is-invalid')
        username.removeClass('is-invalid')
        password_confirmation.removeClass('is-invalid')
        password.removeClass('is-invalid')
        email.removeClass('is-invalid')
        roles.removeClass('is-invalid')
    })
    $("#btn-x").on('click', function () {
        username.val('')
        password.val('')
        password_confirmation.val('')
        name.val('')
        email.val('')
        roles.val('')
        name.removeClass('is-invalid')
        username.removeClass('is-invalid')
        password.removeClass('is-invalid')
        password_confirmation.removeClass('is-invalid')
        email.removeClass('is-invalid')
        roles.removeClass('is-invalid')

    })

    $("#btn-tambah").on('click', function () {
        $(".btn-update").addClass('d-none')
        $(".btn-save").removeClass('d-none')
        $("#judul-modal").html('Tambah Data User')
        let password = $(".password")
        let password_c = $(".password_confirmation")

        $(".current-id").html('')
        $(".method").html('')

        password_c.html("Konfirmasi Password")
        password.html("Password")
        username.val('')
        password.val('')
        password_confirmation.val('')
        name.val('')
        email.val('')
        roles.val('')
    })

    name.on('keyup', function () {
        name.removeClass('is-invalid')
    })
    username.on('keyup', function () {
        username.removeClass('is-invalid')
    })
    password.on('keyup', function () {
        password.removeClass('is-invalid')
    })
    password_confirmation.on('keyup', function () {
        password_confirmation.removeClass('is-invalid')
    })
    email.on('keyup', function () {
        email.removeClass('is-invalid')
    })
    roles.on('change', function () {
        roles.removeClass('is-invalid')
    })

    // Action Save
    $('.btn-save').on('click', function (e) {
        var formdata = $("#modal-user form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#modal-user form').serialize(),
            url: "/users",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(data);
                if (response.errors) {
                    // Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    $('#modal-user').modal('hide');
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
        });
    });

    // ACTION EDIT
    // Ambil datanya
    $('#dataTables').on('click', '.edit-button', function () {
        let modal = $("#modal-user")
        let id = $(this).attr('data-id')
        let title = $("#judul-modal")
        // let current_id = $("#id")
        let sEdit = $(".btn-update")
        let sSave = $(".btn-save")
        let password = $(".password")
        let password_c = $(".password_confirmation")

        password_c.html("Konfirmasi Password Baru")
        password.html("Password Baru")
        sSave.addClass('d-none')
        sEdit.removeClass('d-none')
        title.html('Update Data User')
        modal.modal('show');
        $.ajax({
            data: {
                id: id
            },
            url: "/editUser",
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $(".current-id").html('<input type="hidden" name="id" value="' + data.id + '">')
                $(".method").html('<input type="hidden" name="_method" value="PUT">')
                $("#name").val(data.name)
                $("#username").val(data.username)
                $("#email").val(data.email)
                $("#roles").val(data.roles)
            }
        })
    });
    // Action updatenya
    $('.btn-update').on('click', function (e) {
        var formdata = $("#modal-user form").serializeArray();
        var data = {};
        $(formdata).each(function (index, obj) {
            data[obj.name] = obj.value;
        });
        $.ajax({
            data: $('#modal-user form').serialize(),
            url: "/users/"+formdata[0].value,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                if (response.errors) {
                    //Jika ada pesan error, tampilkan pesan error pada form
                    displayErrors(response.errors);
                } 
                else {
                    // Jika tidak ada pesan error, tampilkan pesan sukses pada form
                    // console.log(response);
                    $('#modal-user').modal('hide');
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
        });
    });

    //Menghapus data transaksi
    $('#dataTables').on('click', '.delete-button', function () {
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
                        _method: method,
                    },
                    url: "/users/"+id,
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data)
                        table.ajax.reload()
                        Swal.fire(
                            'Deleted!',
                            data.success,
                            'success'
                        )
                    }
                })
            }
        })
    });


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
