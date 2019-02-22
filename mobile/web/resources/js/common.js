document.write("<script src='/resources/js/jquery-3.3.1.min.js' type='text/javascript' charset='utf-8'></script>");
document.write("<script src='/resources/js/layer/layer.min.js' type='text/javascript' charset='utf-8'></script>");
document.write("<link href='/resources/css/common.css' rel='stylesheet'>");
document.write("<link href='/resources/css/font-awesome/font-awesome.css' rel='stylesheet'>");
setRem();

/**
 * 响应式设置
 * @param ratio
 */
function setRem(ratio) {
    var width = document.documentElement.getBoundingClientRect().width;
    var rem = width * (ratio || 0.1);
    document.documentElement.style.fontSize = rem + "px";
}

/**
 * 获取get参数
 * @param name
 * @param def
 * @returns {*}
 */
function getParams(name, def) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var re = window.location.search.substr(1).match(reg);
    if (re != null) {
        return decodeURI(re[2]);
    }
    if (def) {
        return def;
    }
    return null;
}

/**
 * 模拟post请求
 * @param url
 * @param params
 * @param target
 */
function postCall(url, params, target) {
    var tempform = document.createElement("form");
    tempform.action = url;
    tempform.method = "post";
    tempform.style.display = "none";
    if (target) {
        tempform.target = target;
    }

    for (var x in params) {
        var opt = document.createElement("input");
        opt.name = x;
        opt.value = params[x];
        tempform.appendChild(opt);
    }

    var opt = document.createElement("input");
    opt.type = "submit";
    tempform.appendChild(opt);
    document.body.appendChild(tempform);
    tempform.submit();
    document.body.removeChild(tempform);
}

/**
 * 时间戳转换日期时间(11位)
 * @param timestamp
 * @returns {string}
 */
function format(timestamp) {
    var date = new Date(timestamp * 1000);
    var Y = date.getFullYear();
    var M = date.getMonth() + 1;
    var D = date.getDate();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();

    function add(num, length) {
        return (Array(length).join(0) + num).slice(-length);
    }

    return Y + '-' + add(M, 2) + '-' + D + ' ' + add(h, 2) + ':' + add(m, 2) + ':' + add(s, 2);
}

/**
 * 跳转
 * @param e
 */
function clickGo(e) {
    window.location.href = $(e).attr('go');
}

