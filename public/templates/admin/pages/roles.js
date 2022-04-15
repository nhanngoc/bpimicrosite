$(function () {
//=== Deleting for one user ===//
    $('#roles tbody').on('click', '.data-controls a.data-delete', function () {
        var thisRow = $(this).parents('tr[role=row]');
        var thisChild = thisRow.hasClass('parent') ? thisRow.next('tr.child') : false;
        var id = thisRow.attr('index');
        if (window.confirm('Are you sure delete #' + id)) {
            $.ajax({
                'url': $(this).attr('href'),
                'type': 'POST',
                'data': {'_method': 'DELETE', '_token': $(this).data('token')},
                'async': true,
                'dataType': 'json',
            }).done(function (data, statusText, xhr) {
                if (data.status === 200) {
                    rolesDataTable.row(thisRow).remove().draw(false);
                    if (thisChild) {
                        thisChild.remove();
                    }
                    $.jGrowl(data.msg, {theme: 'bg-success', position: 'bottom-right'});
                } else {
                    $.jGrowl(data.msg, {theme: 'bg-danger', position: 'bottom-right'});
                }
            }).fail(function (data) {
                $.jGrowl('Quy trình xóa dữ liệu gặp sự cố (mã ' + data.status + '), vui lòng quay lại sau', {
                    theme: 'bg-danger',
                    position: 'bottom-right'
                });
            });
        }
        return false;
    });
});
