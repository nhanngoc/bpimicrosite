var saleOrderItemsDataTable;
(function ($) {
    "use strict";
    if ($("input#DocAmt").length > 0) {
        $("input#DocAmt").inputmask();
    }
    var ExchangeRate = $("#ExchangeRate");
    if (ExchangeRate.length > 0) {
        ExchangeRate.inputmask();
        $(document).on('change', '#Currency', function (evt) {
            evt.preventDefault();
            if ($(this).val() === 'VND') {
                ExchangeRate.prop('disabled', false);
                $('label.ExchangeRateLabel').addClass('required');
            } else {
                $('label.ExchangeRateLabel').removeClass('required');
                ExchangeRate.val(1).prop('disabled', true);
            }
        })
    }

    $(document).on("click", "button#confirmSaleOrdersSendSAP", function (evt) {
        evt.preventDefault();
        var url = $(this).data('url'),
            saleOrderID = $(this).data('id');
        bootbox.confirm({
            message: "Are you sure Send SO?",
            centerVertical: true,
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    $('.bootbox.modal').modal('hide');
                    bootbox.dialog({
                        message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Processing...</div>',
                        centerVertical: true,
                        closeButton: false
                    });
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {
                            id: saleOrderID,
                        },
                        dataType: 'json',
                        url: url,
                        success: response => {
                            $('.bootbox.modal').modal('hide');
                            if (!response.error) {
                                bootbox.alert({
                                    centerVertical: true,
                                    message: '<strong>' + response.data.MESSAGE + ':</strong> ' + response.data.TYPE + ' - ' + response.data.NUMBER,
                                    className: 'rubberBand animated',
                                });
                            } else {
                                bootbox.alert({
                                    centerVertical: true,
                                    message: response.message,
                                    className: 'rubberBand animated',
                                });
                            }
                        },
                        error: res => {
                            console.log(res);
                        }
                    });
                    return false;
                }
            }
        });
    })
    $("#modalFormSaleOrder").on('shown.bs.modal', function (e) {
        e.preventDefault();
        if ($(".select2-modal").length > 0) {
            $('.select2-modal').select2({
                containerCssClass: "custom-container",
                dropdownParent: $("#modalFormSaleOrder"),
            });
        }

        $("input#PRICE").inputmask();
        $("input#PRICE_ORI").inputmask();
        $("input#NET_VALUE").inputmask();
        $("input#EX_RATE").inputmask();
        //validTariff();
        var chargeCodeSelect = $('select#item_number_id');

        chargeCodeSelect.change(function (evt) {
            evt.preventDefault();
            let $charge_code = $(this).val();
            if ($charge_code !== "") {
                getTariffValue($charge_code, $("input#QTY").val());
            }
        });

        var currencyCurrent = $("#PRICE").data('currency');
        var exchangeRateCurrent = $("#EX_RATE").val();

        $("#PRICE").keyup(function (evt) {
            evt.preventDefault();
            validTariff();
            var netValue = getNetValue();

            let percentage = getTaxCode();
            if (percentage > 0) {
                netValue = netValue + (percentage * netValue) / 100;
            }
            /*if (currencyCurrent === 'USD') {
                netValue = netValue * parseInt(exchangeRateCurrent.replace(',', ''));
            }*/
            $("#PRICE_ORI").val($(this).inputmask("unmaskedvalue"));
            $("input#NET_VALUE").val(netValue);
        });

        $("#QTY").keyup(function () {
            if ($('select#item_number_id').val() > 0) {
                getTariffValue($('select#item_number_id').val(), $("#QTY").val());
            } else {
                var netValue = getNetValue();
                let percentage = getTaxCode();
                if (percentage > 0) {
                    netValue = netValue + (percentage * netValue) / 100;
                }
                /*if (currencyCurrent === 'USD') {
                    netValue = netValue * exchangeRateCurrent;
                }*/
                $("input#NET_VALUE").val(netValue);
            }
        });

        $("#TAX_CODE").change(function (evt) {
            evt.preventDefault();
            var percentage = getTaxCode();
            var netValue = getNetValue();
            if (percentage > 0) {
                var newValue = (percentage * netValue) / 100;
                $("input#NET_VALUE").val(netValue + newValue);
            } else {
                $("input#NET_VALUE").val(netValue);
            }
        })
    })

    $("input#ExchangeRate").inputmask();

    $("#modalEditFormSaleOrderItem").on('shown.bs.modal', function (e) {
        e.preventDefault();

        var currencyCurrent = $("#PRICE").data('currency');
        var exchangeRateCurrent = $("#EX_RATE").val();
        var qty = $("#QTY").val();

        validTariff();
        var chargeCodeSelect = $('select#item_number_id');

        chargeCodeSelect.change(function (evt) {
            evt.preventDefault();
            let $charge_code = $(this).val();
            if ($charge_code !== "") {
                getTariffValue($charge_code, $("input#QTY").val());
            }
        });
        $("#PRICE").keyup(function () {
            let netValue = getNetValue();
            let percentage = getTaxCode();
            if (percentage > 0) {
                netValue = netValue + (percentage * netValue) / 100;
            }
            /*if (currencyCurrent === 'USD') {
                netValue = netValue * exchangeRateCurrent;
            }*/
            $("#PRICE_ORI").val($(this).inputmask("unmaskedvalue"));
            $("input#NET_VALUE").val(netValue);
        });

        $("#QTY").keyup(function () {
            if ($('select#item_number_id').val() > 0) {
                getTariffValue($('select#item_number_id').val(), $("#QTY").val());
            } else {
                var netValue = getNetValue();
                let percentage = getTaxCode();
                if (percentage > 0) {
                    netValue = netValue + (percentage * netValue) / 100;
                }
                /*if (currencyCurrent === 'USD') {
                    netValue = netValue * exchangeRateCurrent;
                }*/
                $("input#NET_VALUE").val(netValue);
            }
        });

        $("#TAX_CODE").change(function (evt) {
            evt.preventDefault();
            var percentage = getTaxCode();
            var netValue = getNetValue();
            if (percentage > 0) {
                var newValue = (percentage * netValue) / 100;
                $("input#NET_VALUE").val(netValue + newValue);
            } else {
                $("input#NET_VALUE").val(netValue);
            }
        });
    })
    // Get Net Value
    let getNetValue = function () {
        let price = $('#PRICE').inputmask("unmaskedvalue");
        let qty = $("#QTY").val();
        let netValue = price * qty;
        let currencyCurrent = $("#PRICE").data('currency');
        let exchangeRateCurrent = $("#EX_RATE").val();
        if (currencyCurrent === 'USD') {
            netValue = netValue * parseInt(exchangeRateCurrent.replace(',', ''));
        }
        return netValue;
    }
    let getTaxCode = function () {
        let percentage = $("#TAX_CODE option:selected").data('value');
        if (percentage !== undefined && percentage > 0) {
            return parseFloat(percentage);
        }
        return 0;
    }

    let getTariffValue = function ($item_number, $qty) {
        try {
            $.ajax({
                'url': "{!! route('ajax-general.get.DetailItemNo') !!}",
                'type': 'GET',
                'data': {
                    'item_number': $item_number,
                    'qty': $qty
                },
                'async': true,
                'dataType': 'json',
            }).done(function (response, statusText, xhr) {
                if (!response.error) {
                    let price = $('#PRICE_ORI').inputmask("unmaskedvalue");
                    console.log(price);
                    let percentage = response.data.percentage;
                    console.log(percentage);
                    $("input#tariff_percentage").val(response.data.percentage);
                    if (percentage > 0) {
                        $("div.showTariffInfo").show().find('.value').html(response.data.text)
                    } else {
                        $("div.showTariffInfo").hide().find('.value').html('')
                    }
                    if (percentage > 0 && price > 0) {
                        let discountPrice = price - (percentage * price) / 100;
                        $('#PRICE').val(discountPrice);
                    } else {
                        $('#PRICE').val($("#PRICE_ORI").val());
                    }
                }
            }).fail(function (data) {
                console.log(data.message);
            });
            return false;
        } catch (e) {
            console.log(e);
            return true;
        }

    }

    let validTariff = function () {
        let price = $('#PRICE').inputmask("unmaskedvalue");
        if (price > 0) {
            $("#item_number_id").prop('disabled', false);
        } else {
            $("#item_number_id").prop('disabled', true);
        }
    }

    let $saleOrderItems = $('table#saleOrderItems');

    saleOrderItemsDataTable = $saleOrderItems.dataTable({
        responsive: true,
        columnDefs: [{
            targets: 'no_sort',
            orderable: false
        }],
        dom:
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: []
    });

    $saleOrderItems.on('click', '.data-controls a.data-delete', function (evt) {
        evt.preventDefault();
        var thisRow = $(this).parents('tr[role=row]');
        var id = thisRow.attr('index');
        if (window.confirm('Are you sure delete sale order item ID=' + id)) {
            $.ajax({
                'url': $(this).attr('href'),
                'type': 'post',
                'async': true,
                'data': '_method=DELETE',
                'success': function (response) {
                    if (!response.error) {
                        thisRow.addClass('deleted');
                        thisRow.remove();
                        toastr["success"](response.message);
                    } else {
                        toastr["error"](response.message);
                    }
                }
            });
        }
        return false;
    });

    $saleOrderItems.on('click', '.data-controls a.data-edit', function (evt) {
        evt.preventDefault();
        $.ajax({
            'url': $(this).attr('href'),
            'type': 'get',
            'async': true,
            'success': function (response) {
                if (!response.error) {
                    $("#modalEditFormSaleOrderItem").find('.loadDataSaleOrder').html(response.data.view);
                    $("#modalEditFormSaleOrderItem").modal('show');
                    $("input#PRICE_ORI").inputmask();
                    $("input#PRICE").inputmask();
                    $("input#NET_VALUE").inputmask();
                    $("input#EX_RATE").inputmask();

                    if ($("#modalEditFormSaleOrderItem").find(".select2-modal").length > 0) {
                        $("#modalEditFormSaleOrderItem").find(".select2-modal").select2({
                            width: '100%',
                            dropdownParent: $("#modalEditFormSaleOrderItem"),
                        });
                    }
                } else {

                }
            }
        });
        return false;
    });

    $(document).on('click', '.actions a.data-create', function (evt) {
        evt.preventDefault();
        $.ajax({
            'url': $(this).attr('href'),
            'type': 'get',
            'async': true,
            'success': function (response) {
                if (!response.error) {
                    $("#modalFormSaleOrder").find('.loadDataSaleOrderCreate').html(response.data.view);
                    $("#modalFormSaleOrder").modal('show');
                    if ($("#modalFormSaleOrder").find(".select2-modal").length > 0) {
                        $("#modalFormSaleOrder").find(".select2-modal").select2({
                            width: '100%',
                            dropdownParent: $("#modalFormSaleOrder"),
                        });
                    }
                }
            }
        });
        return false;
    })

    $('#modalEditFormSaleOrderItem').on('hidden.bs.modal', function () {
        $('#modalEditFormSaleOrderItem').find('.loadDataSaleOrder').html('');
    })
    //=== Deleting for one menu_group ===//
    $("form#fSaleOrder").on('click', '.actions a.data-delete', function (evt) {
        evt.preventDefault();
        var id = $(this).data('id');
        if (window.confirm('Are you sure delete sale order ID=' + id)) {
            $.ajax({
                'url': $(this).attr('href'),
                'type': 'post',
                'async': true,
                'data': '_method=DELETE',
                'success': function (response) {
                    if (!response.error) {
                        toastr["success"](response.message);
                    } else {
                        toastr["error"](response.message);
                    }
                }
            });
        }
        return false;
    });

    $(document).on('click', '#fSaleOrderItem button[type=submit]', function (evt) {
        evt.preventDefault();
        evt.stopPropagation();
        let buttonText = $(this).text();
        if (!WCSEO.isValidateSaleOrderItem($("form#fSaleOrderItem"))) {
            return false;
        }
        $(this).prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');

        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).closest('form').prop('action'),
            data: new FormData($(this).closest('form')[0]),
            contentType: false,
            processData: false,
            success: res => {
                $(this).closest('form').find('.show-text-success').html('').hide();
                $(this).closest('form').find('.show-text-danger').html('').hide();

                if (!res.error) {
                    $(this).closest('form').find('input[type=text]:not([readonly])').val('');
                    $(this).closest('form').find('input[type=email]').val('');
                    $(this).closest('form').find('input[type=url]').val('');
                    $(this).closest('form').find('input[type=tel]').val('');
                    $(this).closest('form').find('select').val('');
                    $(this).closest('form').find('textarea').val('');
                    $(this).closest('form')[0].reset();
                    $(this).closest('form').find('.show-text-success').html(res.message).show();
                    toastr.options.positionClass = 'toast-bottom-center';
                    toastr['success'](res.message);
                    setTimeout(function () {
                        $(this).closest('form').find('.show-text-success').html('').hide();
                        window.location = res.data.redirect
                    }, 2000);
                } else {
                    $(this).closest('form').find('.show-text-danger').html(res.message).show();
                    setTimeout(function () {
                        $(this).closest('form').find('.show-text-danger').html('').hide();
                    }, 5000);
                }
                $(this).prop('disabled', false).html(buttonText);
            },
            error: res => {
                $(this).prop('disabled', false).html(buttonText);
                handleError(res, $(this).closest('form'));
            }
        });

        return false;
    });

    $(document).on('click', '#fSaleOrderItemUpdate button[type=submit]', function (evt) {
        evt.preventDefault();
        evt.stopPropagation();
        let buttonText = $(this).text();
        if (!WCSEO.isValidateSaleOrderItem($("form#fSaleOrderItemUpdate"))) {
            return false;
        }
        $(this).prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');

        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).closest('form').prop('action'),
            data: new FormData($(this).closest('form')[0]),
            contentType: false,
            processData: false,
            success: res => {
                $(this).closest('form').find('.show-text-success').html('').hide();
                $(this).closest('form').find('.show-text-danger').html('').hide();
                if (!res.error) {
                    $(this).closest('form').find('input[type=text]:not([readonly])').val('');
                    $(this).closest('form').find('input[type=email]').val('');
                    $(this).closest('form').find('input[type=url]').val('');
                    $(this).closest('form').find('input[type=tel]').val('');
                    $(this).closest('form').find('select').val('');
                    $(this).closest('form').find('textarea').val('');
                    $(this).closest('form')[0].reset();
                    $(this).closest('form').find('.show-text-success').html(res.message).show();
                    setTimeout(function () {
                        $('#modalEditFormSaleOrderItem').modal('hide');
                        $(this).closest('form').find('.show-text-success').html('').hide();
                    }, 2000);
                    toastr.options.positionClass = 'toast-bottom-center';
                    toastr['success'](res.message);
                } else {
                    $(this).closest('form').find('.show-text-danger').html(res.message).show();
                    setTimeout(function () {
                        $(this).closest('form').find('.show-text-danger').html('').hide();
                    }, 5000);
                }
                $(this).prop('disabled', false).html(buttonText);
            },
            error: res => {
                $(this).prop('disabled', false).html(buttonText);
                console.log(res);
                handleError(res, $(this).closest('form'));
            }
        });

        return false;
    });


    WCSEO.isValidateSaleOrderItem = function (form) {
        try {
            let j = true;
            let a = form.find("#item_number_id"),
                b = form.find("#item_number_id").val().trim();
            if (b.length === 0) {
                j = false;
                WCSEO.showMessage(a, 'Please enter Item Number of Purchasing Document.');
                WCSEO.setFocus(a);
            }
            let internalGeneral = form.find("#InternalGeneralLedgerAccount"),
                internalGeneralValue = internalGeneral.val().trim();
            if (internalGeneralValue.length === 0) {
                j = false;
                WCSEO.showMessage(internalGeneral, 'Internal general ledger account');
                WCSEO.setFocus(internalGeneral);
            }

            let e = form.find("#PRICE"),
                f = e.val().trim();
            if (f.length === 0) {
                j = false;
                $(".error_price").html('Please enter Price.').show();
                setTimeout(function () {
                    $(".error_price").hide();
                }, 3500);
                WCSEO.setFocus(e);
            } else {
                $(".error_price").html('').hide();
            }

            let g = form.find('#NET_VALUE'),
                h = g.val().trim();
            if (h.length === 0) {
                j = false;
                WCSEO.showMessage(g, 'Please enter Net value.');
                WCSEO.setFocus(g);
            }

            let i = form.find('#UOM'),
                k = i.val().trim();

            if (k.length === 0) {
                j = false;
                WCSEO.showMessage(i, 'Please enter CJ GLS UOM.');
                WCSEO.setFocus(i);
            }

            let l = form.find("#QTY"),
                m = l.val().trim();

            if (m.length === 0) {
                j = false;
                WCSEO.showMessage(l, 'Please enter Sale order quantity.');
                WCSEO.setFocus(l);
            }
            let TAX_CODE = form.find("#TAX_CODE"),
                TAX_CODEV = TAX_CODE.val().trim();
            if (TAX_CODEV.length === 0) {
                j = false;
                WCSEO.showMessage(TAX_CODE, 'Select Tax Code.');
                WCSEO.setFocus(TAX_CODE);
            }

            let n = form.find("#BusinessType"),
                o = n.val().trim();
            if (o.length === 0) {
                j = false;
                WCSEO.showMessage(n, 'Select Business Type.');
                WCSEO.setFocus(n);
            }
            let TradeType = form.find("#TradeType"),
                TradeTypeV = TradeType.val().trim();
            if (TradeTypeV.length === 0) {
                j = false;
                WCSEO.showMessage(TradeType, 'Select Trade Type.');
                WCSEO.setFocus(TradeType);
            }

            let CargoType = form.find("#CargoType"),
                CargoTypeV = CargoType.val().trim();
            if (CargoTypeV.length === 0) {
                j = false;
                WCSEO.showMessage(CargoType, 'Select Cargo Type.');
                WCSEO.setFocus(CargoType);
            }

            let Warehouse = form.find("#Warehouse"),
                WarehouseV = Warehouse.val().trim();
            if (WarehouseV.length === 0) {
                j = false;
                WCSEO.showMessage(Warehouse, 'Select Warehouse.');
                WCSEO.setFocus(Warehouse);
            }
            let Region = form.find("#Region"),
                RegionV = Region.val().trim();
            if (RegionV.length === 0) {
                j = false;
                WCSEO.showMessage(Region, 'Select Region.');
                WCSEO.setFocus(Region);
            }

            let Incoterms = form.find("#Incoterms"),
                IncotermsV = Incoterms.val().trim();
            if (IncotermsV.length === 0) {
                j = false;
                WCSEO.showMessage(Incoterms, 'Select Incoterms.');
                WCSEO.setFocus(Incoterms);
            }
            return j;
        } catch (e) {
            console.log(e);
            return true;
        }
    }


})(jQuery);

$(function () {
    let fCompanyCode = $("form#fCompanyCode");
    fCompanyCode.on('change', 'select#sltCompanyCode', function (evt) {
        evt.preventDefault();
        evt.stopPropagation();
        let companyCode = $(this).val(),
            companyCodeUrl = $(this).data('route_url');
        $.ajax({
            'url': companyCodeUrl,
            'type': 'GET',
            'async': true,
            'data': {
                'companyCode': companyCode
            },
            'success': function (response) {
                if (!response.error) {
                    fCompanyCode.find('input[name=plant_code]').val(response.data.plant);
                    fCompanyCode.find('input[name=purchasing_org]').val(response.data.purchasing_org);
                } else {
                    fCompanyCode.find('input[name=plant_code]').val('');
                    fCompanyCode.find('input[name=purchasing_org]').val('');
                }
            }
        });
        return false;
    })
});
