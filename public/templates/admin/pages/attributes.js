$(function () {
    var attributeTable = $('#attributes').dataTable({
        responsive: true,
        dom:
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend: 'csvHtml5',
                text: 'CSV',
                titleAttr: 'Generate CSV',
                className: 'btn-outline-default'
            },
            {
                extend: 'print',
                text: 'Print',
                titleAttr: 'Print Table',
                className: 'btn-outline-default'
            }
        ]
    });

    $('#attributes tbody').on('click', '.data-controls a.data-delete', function () {
        var thisRow = $(this).parents('tr[role=row]');
        var thisChild = thisRow.hasClass('parent') ? thisRow.next('tr.child') : false;
        var id = thisRow.attr('index');
        if (window.confirm('Do you really want to delete this record?')) {
            $.ajax({
                'url': $(this).attr('href'),
                'type': 'POST',
                'data': {'_method': 'DELETE'},
                'async': true,
                'dataType': 'json',
            }).done(function (data, statusText, xhr) {
                if (data.status === 200) {
                    attributeTable.row(thisRow).remove().draw(false);
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
