function upload(config) {
    if (!config.uploadImgUrl) {
        alert('请配置上传路由');
        return false;
    }
    if (!config.removeImgUrl) {
        alert('请配置删除路由');
        return false;
    }
    var height = config.height || 26;
    height = height + 'rem';
    $(config.element).before('<link type="text/css" href="/upload/upload.css" rel="stylesheet"/>');
    $(config.element).addClass('myUpload');
    $(config.element).append('<textarea class="myUploadResult" name="' + (config.name || 'image') + '"></textarea>');
    $(config.element).append('<input type="file" class="myUploadFile"/>');
    if (config.default) {
        config.default.split(',').forEach(function (t, number) {
            addImg(t);
        });
    } else {
        $(config.element).append('<div class="myUploadAddFirst" style="height: ' + height + '"></div>');
    }
    $(config.element).on('click', '.myUploadAddFirst,.myUploadAdd', function () {
        if (config.max) {
            if ($(config.element).find('.myUploadImg').length < config.max) {
                $(config.element).find('.myUploadFile').click();
            } else {
                alert('最多上传' + config.max + '张图片');
                return false;
            }
        } else {
            $(config.element).find('.myUploadFile').click();
        }
    });
    $(config.element).on('change', '.myUploadFile', function () {
        var formData = new FormData();
        formData.append('file', $(this)[0].files[0]);
        $.ajax({
            url: config.uploadImgUrl,
            type: "post",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.type) {
                    addImg(res.data);
                } else {
                    console.log(res.msg);
                }
            }
        });
    });
    $(config.element).on('click', '.myUploadImgDel', function () {
        delImg(this);
    });
    $(config.element).on('mouseover', '.myUploadImg', function () {
        $(this).find('.myUploadImgDelBox').fadeIn();
    });
    $(config.element).on('mouseleave', '.myUploadImg', function () {
        $(this).find('.myUploadImgDelBox').fadeOut();
    });

    function addImg(src) {
        $(config.element).find('.myUploadResult').val(function (index, oldValue) {
            if (oldValue) {
                return oldValue + ',' + src;
            }
            return src;
        });
        $(config.element).append('<div class="myUploadImg"  style="height: ' + height + '"><div class="myUploadImgDelBox"><div class="myUploadImgDel" imgUrl="' + src + '"></div></div><img src="' + src + '"></div>');
        have();
    }

    function delImg(now) {
        var src = $(now).attr('imgUrl');
        $.getJSON(config.removeImgUrl, {src: src}, function (res) {
            if (res.type) {
                $(now).parents('.myUploadImg').remove();
                $(config.element).find('.myUploadResult').val(function (index, oldValue) {
                    return replace(oldValue, ',', src);
                });
                have();
            } else {
                console.log(res.msg);
            }
        });
    }

    function have() {
        if ($(config.element).find('.myUploadImg').length === 0) {
            $(config.element).find('.myUploadAdd').remove();
            $(config.element).append('<div class="myUploadAddFirst" style="height: ' + height + '"></div>');
        } else {
            $(config.element).find('.myUploadAddFirst').remove();
            $(config.element).find('.myUploadAdd').remove();
            $(config.element).append('<div class="myUploadAdd" style="height: ' + height + '"></div>');
        }
    }

    function replace(str, limit, del) {
        var arr = [];
        str.split(limit).forEach(function (t, number) {
            if (t && t !== del) {
                arr.push(t);
            }
        });
        return arr.join(',');
    }
}

function uploadFile(config) {

    addResult(config.default);

    $(config.element).after('<input type="file" class="myFileInput" style="display: none">');
    $(config.element).next('.myFileInput').after('<input type="hidden" name="' + (config.name || 'file') + '">');

    $(config.element).click(function () {
        $(this).next('.myFileInput').click();
    });

    $(config.element).next('.myFileInput').change(function () {
        if ($(this)[0].files.length) {
            var file = $(this)[0].files[0];
            if ($(config.element).attr('url')) {
                $.getJSON(config.removeUrl || '/basis/file/delete', {src: $(config.element).attr('url')}, function (res) {
                    if (res.type) {
                        var formData = new FormData();
                        formData.append('file', file);
                        if (config.prefix) {
                            formData.append('prefix', config.prefix);
                        }
                        $.ajax({
                            url: config.url || '/basis/file/upload-file',
                            type: "post",
                            data: formData,
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            success: function (res) {
                                if (res.type) {
                                    addResult(res.data);
                                } else {
                                    console.log(res.msg);
                                }
                            }
                        });
                    } else {
                        console.log(res.msg);
                    }
                });
            } else {
                var formData = new FormData();
                formData.append('file', file);
                if (config.prefix) {
                    formData.append('prefix', config.prefix);
                }
                $.ajax({
                    url: config.url || '/basis/file/upload-file',
                    type: "post",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res.type) {
                            addResult(res.data);
                        } else {
                            console.log(res.msg);
                        }
                    }
                });
            }
        }
    });

    function addResult(result) {
        $(config.element).prop('readonly', true).prop('placeholder', '点击上传文件');
        if (result) {
            var name = result.split('/');
            name = name[name.length - 1];
            $(config.element).prop('readonly', true).prop('placeholder', name + ' (点击修改)').attr('url', result);
            $('[name="' + config.name + '"]').val(result);
        }
    }
}