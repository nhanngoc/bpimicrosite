var toSlug = function (str) {
    // Chuyển hết sang chữ thường
    str = str.toLowerCase();

    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');

    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');

    // xóa phần dư - ở đầu
    str = str.replace(/^-+/g, '');

    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');

    // return
    return str;
};


var getQueryString = function (field, url) {
    var href = url ? url : window.location.href;
    var reg = new RegExp('[?&]' + field + '=([^&#]*)', 'i');
    var string = reg.exec(href);
    return string ? string[1] : null;
};

var isInArray = function (value, array) {
    return array.indexOf(value) > -1;
};

var increaseTotalBadge = function (container) {
    if ($(container).length > 0) {
        var currentTotal = parseInt($(container + ' span.badge').text());
        $(container + ' span.badge').text(currentTotal + 1);
    }
};

var decreaseTotalBadge = function (container) {
    if ($(container).length > 0) {
        var currentTotal = parseInt($(container + ' span.badge').text());
        $(container + ' span.badge').text(currentTotal - 1);
    }
};

var formElements = function () {

    //Select2 select

    var feSelect2 = function () {
        if ($(".select2-basic").length > 0) {
            $('.select2-basic').select2({
                minimumResultsForSearch: Infinity
            });
        }
        if ($(".select2-search").length > 0) {
            $('.select2-search').select2({
                width: '100%'
            });
        }
        if ($(".select2-tags").length > 0) {
            $('.select2-tags').select2({
                tokenSeparators: [','],
            });
        }
        /*$('.select2-multiple').select2({
            placeholder: "Please choose."
        });

        $(".select2-multiple-categories").select2({
            placeholder: "Select category."
        });*/

    };
    return {
        init: function () {
            feSelect2();
        }
    }
}();


$(function () {
    // Initialize all plugins
    formElements.init();
});
