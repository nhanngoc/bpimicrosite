$(document).ready(function () {
    //=== Setting for menu items list table ===//
    var menuItemsTable = $('#menu_items.dataTable').DataTable({
        "bSort": false,
        "buttons": []
    });

    //=== Deleting for one menu item ===//
    $('#menu_items tbody').on('click', '.data-controls a.data-delete', function () {
        var thisRow = $(this).parents('tr[role=row]');
        var thisChild = thisRow.hasClass('parent') ? thisRow.next('tr.child') : false;
        var id = thisRow.attr('index');
        if (window.confirm('Bạn có chắc muốn xóa trình đơn #' + id)) {
            $.ajax({
                'url': $(this).attr('href'),
                'type': 'POST',
                'data': {'_method': 'DELETE', '_token': $(this).data('token')},
                'async': true,
                'dataType': 'json',
            }).done(function (data, statusText, xhr) {
                console.log(data);
                if (data.status == 200) {
                    menuItemsTable.row(thisRow).remove().draw(false);
                    if (thisChild) {
                        thisChild.remove();
                    }
                    $.jGrowl(data.msg, {theme: 'bg-success', position: 'bottom-right'});
                } else {
                    $.jGrowl(data.msg, {theme: 'bg-danger', position: 'bottom-right'});
                }
            }).fail(function (data) {
                alert('Quy trình xóa dữ liệu gặp sự cố (mã ' + data.status + '), vui lòng quay lại sau');
            });
        }
        return false;
    });

    //=== CREATE PAGE ===//
    function getMenuItemList(group_id) {
        var index_path = $('input[name=index_path]').val();
        $.ajax({
            'url': index_path,
            'type': 'GET',
            'async': true,
            'success': function (itemList) {
                $('select[name=related_id]').html(itemList);
                $('select[name=related_id]').select2({
                    language: "vi",
                    tokenSeparators: [','],
                    width: '100%',
                });
            }
        });
    }

    if ($('input:hidden[name=menu_id]').length > 0) {
        getMenuItemList($('input:hidden[name=menu_id]').val());
    }


    function disabledLink() {
        $('input[name="link"]').val(null);
        $('input[name="link"]').prop('disabled', true);
        $('select[name=data_id]').prop('disabled', false);
    }

    function enabledLink() {
        $('input[name="link"]').prop('disabled', false);
        $('select[name=data_id]').empty();
        $('select[name=data_id]').prop('disabled', true);
    }

    if ($('select[name=type_id]').val() == 0) {
        enabledLink();
    } else {
        disabledLink();
    }
    $('select[name=type_id]').change(function () {
        var type_id = $(this).val();
        if (type_id == 0) {
            enabledLink();
        } else {
            disabledLink();
            var index_path = $('input[name=index_path]').val();
            $.ajax({
                'url': index_path + '/get_data/' + type_id,
                'type': 'GET',
                'async': true,
                'success': function (dataList) {
                    $('select[name=data_id]').html(dataList);
                    $('select[name=data_id]').select2({
                        language: "vi",
                        tokenSeparators: [','],
                        width: '100%',
                    });
                }
            });
        }
        $('select[name=data_id]').select2({
            language: "vi",
            tokenSeparators: [','],
            width: '100%',
        });
    });
});
