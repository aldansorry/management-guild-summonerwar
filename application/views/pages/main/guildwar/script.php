<script>
    var cname = "<?php echo $cname ?>";
    var lg_username = "<?php echo $this->session->userdata('lg_username') ?>";
    var table_data;
    var table_member;
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
                        if (data.status == 1) {
                            ret += '<a href="javascript:void(0)" onclick="end_war_prompt(this)" class="btn btn-xs btn-flat text-success" data-id="' + data.id + '"><i class="fa fa-pencil"></i> End War</a>';
                        }
                        ret += '<a href="javascript:void(0)" onclick="delete_prompt(this)" class="btn btn-xs btn-flat text-danger" data-id="' + data.id + '"><i class="fa fa-trash"></i> Hapus</a>';

                        ret += '</div>';
                        return ret;
                    }
                },
                {
                    'title': 'Kode',
                    'data': 'code'
                },
                {
                    'title': 'Member',
                    'data': (data) => {
                        let ret = "";
                        ret += '<span class="label label-primary" onclick="memberlist_prompt(this)">'+data.member_count+' Members</span>';
                        return ret;
                    }
                },
                {
                    'title': 'War Start',
                    'data': 'start_ts'
                },
                {
                    'title': 'War End',
                    'data': 'end_ts'
                },
                {
                    'title': 'State',
                    'data': (data) => {
                        let ret = "";
                        if (data.state == '1') {
                            ret += '<span class="label label-primary">Victory</span>';
                        } else if (data.state == '2') {
                            ret += '<span class="label label-default">Draw</span>';
                        } else if (data.state == '3') {
                            ret += '<span class="label label-danger">Defeated</span>';
                        }
                        return ret;
                    }
                },
                {
                    'title': 'Status',
                    'data': (data) => {
                        let ret = "";
                        if (data.status == '1') {
                            ret += '<span class="label label-info">On Going</span>';
                        } else if (data.status == '2') {
                            ret += '<span class="label label-default">Done</span>';
                        }
                        return ret;
                    }
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
        elementModal.find('.modal-title').text('Tambah Guild War');
        elementModal.find('#modal-btn-accept').text('Tambah');
        elementModal.find('#modal-btn-accept').attr('form', 'form-create');
        $.ajax({
            url: base_url + "/" + cname + "/create",
            type: 'POST',
            success: (data) => {
                elementModal.find('#modal-body-container').html(data);
                elementModal.modal('show');

                table_member = $('#table-member').DataTable({
                    orderCellsTop: true,
                    'ajax': {
                        'url': $('#table-member').data('url')
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    'columns': [{
                            'title': '<input type="checkbox" name="r1" id="check-all2">',
                            "width": "15px",
                            'orderable': false,
                            'data': (data) => {
                                let ret = "";
                                ret += '<input type="checkbox" name="select[]" class="check2" value="' + data.id + '">';

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
                            'title': 'Nama Game',
                            'data': 'ign'
                        },
                        {
                            'title': 'Nama Game',
                            'data': 'point'
                        }
                    ],
                    "fnInitComplete": function(oSettings) {
                        $('#check-all2').click(function() {
                            if ($('#check-all2').is(':checked')) {
                                $('.check2').prop('checked', true);
                            } else {
                                $('.check2').prop('checked', false);
                            }
                        });
                    }
                });

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
                                Swal.fire(
                                    data.title,
                                    data.message,
                                    data.type
                                );
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

    var end_war_prompt = (btnObject) => {
        let elementButton = $(btnObject);
        let elementModal = $('#modal-default');
        let id = elementButton.data('id');
        elementModal.find('.modal-title').text('End War');
        elementModal.find('#modal-btn-accept').text('End');
        elementModal.find('#modal-btn-accept').attr('form', 'form-update');
        $.ajax({
            url: base_url + "/" + cname + "/war_end",
            type: 'POST',
            data: {
                id: id
            },
            success: (data) => {
                elementModal.find('#modal-body-container').html(data);
                elementModal.modal('show');

                table_member = $('#table-member').DataTable({
                    orderCellsTop: true,
                    'ajax': {
                        'url': $('#table-member').data('url')
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    'columns': [{
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
                            'title': 'Nama Game',
                            'data': 'ign'
                        },
                        {
                            'title': 'Sword Used',
                            'data': (data) => {
                                let ret = "";
                                ret += '<input type="hidden" name="member[' + data.fk_member + '][fk_member]" value="' + data.fk_member + '">';
                                ret += '<input type="number" name="member[' + data.fk_member + '][sword_used]" min="0" max="3" value="3" step="1" class="form-control input-sm">';
                                return ret;
                            }
                        }
                    ],
                    "fnInitComplete": function(oSettings) {
                        $('#check-all2').click(function() {
                            if ($('#check-all2').is(':checked')) {
                                $('.check2').prop('checked', true);
                            } else {
                                $('.check2').prop('checked', false);
                            }
                        });
                    }
                });

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

    var memberlist_prompt = (btnObject) => {
        let elementModal = $('#modal-info');
        elementModal.find('.modal-title').text('Daftar Member');
        elementModal.find('#modal-btn-accept').text('Tambah');
        $.ajax({
            url: base_url + "/" + cname + "/memberlist",
            type: 'POST',
            success: (data) => {
                elementModal.find('#modal-body-container').html(data);
                elementModal.modal('show');

                table_member = elementModal.find('#table-member').DataTable({
                    orderCellsTop: true,
                    'ajax': {
                        'url': $('#table-member').data('url')
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    'columns': [{
                            'title': '<input type="checkbox" name="r1" id="check-all2">',
                            "width": "15px",
                            'orderable': false,
                            'data': (data) => {
                                let ret = "";
                                ret += '<input type="checkbox" name="select[]" class="check2" value="' + data.id + '">';

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
                            'title': 'Nama Game',
                            'data': 'ign'
                        }
                    ],
                    "fnInitComplete": function(oSettings) {
                        $('#check-all2').click(function() {
                            if ($('#check-all2').is(':checked')) {
                                $('.check2').prop('checked', true);
                            } else {
                                $('.check2').prop('checked', false);
                            }
                        });
                    }
                });
            }
        })
    };
</script>