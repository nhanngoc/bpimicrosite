$(document).ready(function () {
    // Deleting for one manufacturer
    $('#products tbody').on('click', '.data-controls a.data-delete', function () {
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
                    productDataTable.row(thisRow).remove().draw(false);
                    if (thisChild) {
                        thisChild.remove();
                    }
                } else {
                }
            }).fail(function (data) {
            });
        }
        return false;
    });
});
