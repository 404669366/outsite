function sms(config) {
    $(config.click).click(function () {
        if (check($(config.telModel).val())) {
            $.getJSON('/sms/sms/send.html', {tel: $(config.telModel).val()}, function (re) {
                if (re.type) {
                    layer.msg('<span style="font-size:0.42rem;height:100%;line-height:100%">验证码发送成功,请注意查收</span>');
                    var text = $(config.click).text();
                    var time = config.timeout || 60;
                    $(config.click).text(time + 's').attr('send', true);
                    var id = setInterval(function () {
                        time--;
                        if (time < 0) {
                            $(config.click).text(text).removeAttr('send');
                            clearInterval(id);
                            return;
                        }
                        $(config.click).text(time + 's');
                    }, 1000);
                } else {
                    layer.msg('<span style="font-size:0.42rem;height:100%;line-height:100%">' + re.msg + '</span>');
                }
            })
        }
    });

    function check(tel) {
        if (!tel) {
            layer.msg('<span style="font-size:0.42rem;height:100%;line-height:100%">请填写手机号</span>');
            return false;
        }
        if (!(/^1(3|4|5|7|8)\d{9}$/.test(tel))) {
            layer.msg('<span style="font-size:0.42rem;height:100%;line-height:100%">手机号有误</span>');
            return false;
        }
        if ($(config.click).attr('send')) {
            layer.msg('<span style="font-size:0.42rem;height:100%;line-height:100%">验证码已发送,请稍后再试</span>');
            return false;
        }
        return true;
    }
}
