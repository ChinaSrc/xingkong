// 相關全域變數
var allPayments = ['alipay', 'alipay_bank', 'bank', 'bdpay', 'jdpay', 'qqpay',
                  'unionpay_nocard', 'unionpay_scanpay', 'wechat', 'wechat_bank'];
var modifyMoneyPayments = ['alipay', 'bdpay', 'jdpay', 'qqpay', 'unionpay_scanpay', 'wechat', 'wechat_bank'];

var moneyCols = '';
$(allPayments).each(function () {
    moneyCols += '#' + String(this) + '-money,';
});
var moneyColsLen = moneyCols.length;
moneyCols = moneyCols.substr(0, (moneyColsLen - 1));

var processPath = 'autorouting_api.shtml';

$(function () {
    // 指定 owl Carousel 套件的左右箭頭圖形格式
    var arrowLeftText = '<div class="arrow"><div class="arrow_left"></div><div>';
    var arrowRightText = '<div class="arrow"><div class="arrow_right"></div></div>';
    $("#owl-slider").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        singleItem: true,
        lazyLoad: true,
        navigationText: [arrowLeftText, arrowRightText]
    });

    // 預設先隱藏全部支付
    $('div.set.bank .new-cards > span').addClass('hidden');

    // 在網頁上顯示各支付流程選項的步驟
    $.get(processPath,
        {flag: 'getpay'},
        function (r) {
            var isEnableExist = false;
            $(allPayments).each(function () {
                if (r[this]['enable'] == 'Y') {
                    isEnableExist = true;
                    
                    var className = '.set.' + this;
                    var maxId = '#' + this + '-max';
                    var minId = '#' + this + '-min';

                    $(className).removeClass('hidden');
                    $(className).removeClass('owl-hidden');

                    if (this == 'bank') {
                        // 银行充值的呈現流程
                        for (var bank in r['bank']['banklist']) {
                            var tmp = r['bank']['banklist'][bank];
                            $('.new-cards > span').find('input[value="' + tmp['ourkey'] + '"]').parents('span').removeClass('hidden');
                        }
                        $('input[name="bk"]').on("change", function () {
                            $("#send-bank").attr('disabled', false);
                            $.get(processPath, {
                                flag: 'get-bank-info',
                                bank: $("input[name='bk']:checked").val()
                            }, function (r) {
                                $(maxId).html(r['load_max']);
                                $(minId).html(r['load_min']);
                            }, 'json');
                            $('#bank-money').val("");
                            $('#bank-msg').html("");
                            $('#bank-money').prop("disabled", false);
                        });
                    } else {
                        // 支付寶、支付寶轉帳、百度支付、京東支付、QQ 支付、銀聯快捷、銀聯掃碼、微信支付、微信轉帳的呈現流程
                        $(maxId).html(r[this]['load_max']);
                        $(minId).html(r[this]['load_min']);
                        if (this == 'alipay_bank') {
                            var colName = 'obscured_alipay_bank_username';
                            if (r[this][colName] != '' && r[this][colName] != null) {
                                $("#alipay_bank-pay-name").val(r[this][colName]);
                            }
                            $("#send-alipay_bank-username").hide();
                        }
                    }
                }
            });

            // 若無任何可用線路顯示此訊息
            if (isEnableExist == false) {
                $('.set.nope').removeClass('hidden');
                $('.set.nope').removeClass('owl-hidden');
                $('.set.nope #title').html("找不到可充值线路，如有任何问题请联络客服人员");
            } else {
                $('.set.nope').addClass('hidden');
            }

            $.each($(".owl-hidden"), function (i) {
                var idx = $('.set').index(this);
                $(".owl-carousel").data('owlCarousel').removeItem(idx);
            })
            $(".set:not('.hidden') > span").eq(0).trigger('click');
        },
        'json');

    // 在各支付輸入金額時格式化數值
    $(moneyCols).keyup(function () {
        $(this).val(formatFloat($(this).val()));
    });

    // 需要把充值金額轉換成實際支付金額的支付項目，所產生實際支付金額的步驟
    $(modifyMoneyPayments).each(function () {
        var inputMoney = '#' + this + '-money';
        var spanMoney = '#' + this + '-money-ture';
        $(inputMoney).on('keyup', function (r) {
            var oldMoney = new Number(this.value);
            if (isNaN(oldMoney)) {
                oldMoney = 0;
            }

            var newMoney = 0;
            if (oldMoney == 0) {
                newMoney = 0;
            } else if (oldMoney < 21) {
                newMoney = (oldMoney) + ((Math.floor(Math.random() * (50 - 1)) + 1) / 100);
            } else if (oldMoney >= 21 && oldMoney <= 100) {
                newMoney = oldMoney + ((Math.floor(Math.random() * (100 - 1)) + 1) / 100);
            } else {
                newMoney = oldMoney - ((Math.floor(Math.random() * (100 - 1)) + 1) / 100);
            }
            newMoney = Math.floor(newMoney * 100) / 100;
            $(spanMoney).html(newMoney);
        });
    });

    // 所有支付的金額提交流程
    $(allPayments).each(function () {
        switch (String(this)) {
            case 'alipay_bank':
            case 'wechat_bank':
                var dataType = 'html';
                if (this == 'alipay_bank') {
                    var payName = $('#' + this + '-pay-name');
                }
            break;

            default:
                var dataType = "json";
            break;
        }

        var sendBtn = $('#send-' + this);
        var inputMoney = $('#' + this + '-money');
        var msg = $('#' + this + '-msg');
        var max = $('#' + this + '-max');
        var min = $('#' + this + '-min');
        var flagInfo = String(this);

        sendBtn.on('click', function (r) {
            if (inputMoney.val()) {
                // 依據不同支付，取得提交金額數值的方式
                switch (flagInfo) {
                    case 'alipay':
                    case 'bdpay':
                    case 'jdpay':
                    case 'qqpay':
                    case 'unionpay_scanpay':
                    case 'wechat':
                    case 'wechat_bank':
                        // 這些是使用實際支付金額的項目
                        var spanMoney = $('#' + flagInfo + '-money-ture');
                        moneyVal = spanMoney.html();
                    break;

                    default:
                        moneyVal = inputMoney.val();
                    break;
                }

                if (moneyVal < Number(min.html())) {
                    msg.html("金额低于最低限制")
                } else if (moneyVal > Number(max.html())) {
                    msg.html("金额高于最高限制")
                } else if (isNaN(moneyVal)) {
                    msg.html("金额输入错误")
                } else if (flagInfo == 'alipay_bank' && payName.val() == '') {
                    msg.html("请输入付款名称")
                } else {
                    sendBtn.attr('disabled', true);
                    // 依據不同支付，來產生(重新導向)充值頁面的方法
                    var objectName = {
                            flag: flagInfo,
                            money: moneyVal
                        };

                    if (flagInfo == 'alipay_bank') {
                        payName.val($.trim(payName.val()));
                        objectName['pay_name'] = payName.val();
                    } else if (flagInfo == 'bank') {
                        objectName['bank'] = $("input[name='bk']:checked").val();
                    }

                    if (dataType == 'html') {
                        $.get(processPath,
                            objectName,
                            function (r) {
                                document.write(r);
                            },
                            dataType);
                    } else if (dataType == 'json') {
                        $.get(processPath,
                            objectName,
                            function (r) {
                                if (r.st == 0) {
                                    var enurl = encodeURIComponent(r.url);
                                    window.location.replace('/autorouting_payredirect.shtml?url=' + enurl);
                                } else {
                                    msg.html(r.msg);
                                }
                            },
                            dataType);
                    }
                    sendBtn.attr('disabled', false);
                }
            } else {
                msg.html("请输入金额")
            }
        });
    });
});

// 在使用銀行充值時，在使用者點選銀行前不讓輸入框生效
function checkBank() {
    var v = $("#bank_div :radio").is(":checked");
    if (v === false) {
        $("#bank-msg").html("请先选择银行");
    }
}
