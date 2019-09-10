<script>
    var cname = "<?php echo $cname ?>";
    var lg_username = "<?php echo $this->session->userdata('lg_username') ?>";
    var table_data;
    $(document).ready(function() {

        $('#table-data thead tr').clone(true).appendTo('#table-data thead');
        $('#table-data thead tr:eq(1) th').each(function(i) {
            if ($(this).data('filter') == "text") {
                $(this).html('<input type="text" placeholder="Search" class="form-control" style="width:100%"/>');
                $('input', this).on('keyup change', function() {
                    if (table_data.column(i).search() !== this.value) {
                        table_data
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            }
        });
        table_data = $('#table-data').DataTable({
            orderCellsTop: true,
            'ajax': {
                'url': $('#table-data').data('url')
            },
            "order": [
                [1, "asc"]
            ],
            dom: '<"pull-left"<"pull-right ml-1"l>B>fr<"table-responsive"t>ip',
            buttons: [{
                    text: '<i class="fa fa-plus"></i> Tambah',
                    className: 'btn btn-sm btn-primary',
                    action: function(e, dt, node, config) {
                        create_prompt(node);
                    }
                },
                {
                    text: '<i class="fa fa-trash"></i> Delete All',
                    className: 'btn btn-sm btn-danger',
                    action: function(e, dt, node, config) {
                        if ($('.check:checked').length) {
                            delete_prompt(node);
                        } else {
                            Swal.fire(
                                'Information',
                                'Tidak ada baris yang dicentang',
                                'info'
                            );
                        }
                    }
                }
            ],
            'columns': [{
                    'title': '<input type="checkbox" name="r1" id="check-all">',
                    "width": "15px",
                    'orderable': false,
                    'data': (data) => {
                        let ret = "";
                        ret += '<input type="checkbox" name="select[]" class="check" value="' + data.id + '">';
                   
                        return ret;
                    }
                },
                {
                    "title": "No",
                    "width": "15px",
                    "data": null,
                    "visible": true,
                    "class": "text-center",
                    render: (data, type, row, meta) => {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    'title': '',
                    "width": "79px",
                    'data': (data) => {
                        let ret = "";
                        ret += '<div class="btn-group">';
                        ret += '<a href="javascript:void(0)" onclick="update_prompt(this)" class="btn btn-xs btn-flat text-success" data-id="' + data.id + '"><i class="fa fa-pencil"></i> Edit</a>';
                        ret += '<a href="javascript:void(0)" onclick="delete_prompt(this)" class="btn btn-xs btn-flat text-danger" data-id="' + data.id + '"><i class="fa fa-trash"></i> Hapus</a>';
                       
                        ret += '</div>';
                        return ret;
                    }
                },
                {
                    'title': 'Nama',
                    'data': 'name'
                },
                {
                    'title': 'Panggilan',
                    'data': 'nickname'
                },
                {
                    'title': 'Nama Game',
                    'data': 'ign'
                },
                {
                    'title': 'Last War',
                    'data': 'last_war'
                }
            ],
            "fnInitComplete": function(oSettings) {
                $('#check-all').click(function() {
                    if ($('#check-all').is(':checked')) {
                        $('.check').prop('checked', true);
                    } else {
                        $('.check').prop('checked', false);
                    }
                });
            }
        });
    });

    var create_prompt = (btnObject) => {
        let elementModal = $('#modal-default');
        elementModal.find('.modal-title').text('Tambah Member');
        elementModal.find('#modal-btn-accept').text('Tambah');
        elementModal.find('#modal-btn-accept').attr('form', 'form-create');
        $.ajax({
            url: base_url + "/" + cname + "/create",
            type: 'POST',
            success: (data) => {
                elementModal.find('#modal-body-container').html(data);
                elementModal.modal('show');

                $("form#form-create").submit(function(e) {
                    e.preventDefault();

                    let elementForm = $(this);
                    let formData = new FormData(this);

                    $.ajax({
                        url: elementForm.attr('action'),
                        type: 'POST',
                        data: formData,
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.code == '0') {
                                Swal.fire(
                                    data.title,
                                    data.message,
                                    data.type
                                );
                                elementModal.modal('hide');
                                table_data.ajax.reload(null, false);
                            } else {
                                $('.has-error').removeClass('has-error');
                                $('.help-block').remove();
                                Object.keys(data.array_error).forEach(function(key) {
                                    let elementInput = $('[name="' + key + '"]');
                                    elementInput.parents('.form-group').addClass('has-error');
                                    elementInput.parent().append('<span class="help-block">' + data.array_error[key] + '</span>');

                                });
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });
            }
        })
    };

    var update_prompt = (btnObject) => {
        let elementButton = $(btnObject);
        let elementModal = $('#modal-default');
        let id = elementButton.data('id');
        elementModal.find('.modal-title').text('Edit Member');
        elementModal.find('#modal-btn-accept').text('Edit');
        elementModal.find('#modal-btn-accept').attr('form', 'form-update');
        $.ajax({
            url: base_url + "/" + cname + "/update",
            type: 'POST',
            data: {
                id: id
            },
            success: (data) => {
                elementModal.find('#modal-body-container').html(data);
                elementModal.modal('show');

                $("form#form-update").submit(function(e) {
                    e.preventDefault();

                    let elementForm = $(this);
                    let formData = new FormData(this);

                    $.ajax({
                        url: elementForm.attr('action'),
                        type: 'POST',
                        data: formData,
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.code == '0') {
                                Swal.fire(
                                    data.title,
                                    data.message,
                                    data.type
                                );
                                elementModal.modal('hide');
                                table_data.ajax.reload(null, false);
                            } else {
                                $('.has-error').removeClass('has-error');
                                $('.help-block').remove();
                                Object.keys(data.array_error).forEach(function(key) {
                                    let elementInput = $('[name="' + key + '"]');
                                    elementInput.parents('.form-group').addClass('has-error');
                                    elementInput.parent().append('<span class="help-block">' + data.array_error[key] + '</span>');

                                });
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                });
            }
        })
    };


    var delete_prompt = (btnObject) => {
        let id;
        let message = "";
        if ($(btnObject).data('id') == null) {
            let list_select = [];
            $('.check:checked').each(function(i, obj) {
                list_select.push($(obj).val());
            });
            id = list_select;
            message = "Baris yang dicentang akan dihapus secara permanent";
        } else {
            id = $(btnObject).data('id')
            message = "Kamu tidak bisa mengembalikannya";
        }
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak, Jangan!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + "/" + cname + "/action_delete",
                    type: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'JSON',
                    success: (data) => {
                        Swal.fire(
                            data.title,
                            data.message,
                            data.type
                        );
                        table_data.ajax.reload(null, false);
                    }
                });
            }
        })
    };
</script>