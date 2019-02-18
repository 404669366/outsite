function myEdit(config) {
    $(config.element).before('<link type="text/css" href="/h+/plugins/summernote/summernote.css" rel="stylesheet"/>');
    $(config.element).before('<script src="/h+/plugins/summernote/summernote.js"></script>');
    $(config.element).before('<script src="/h+/plugins/summernote/lang/summernote-zh-CN.js"></script>');
    var nowSrc = '';
    var callbacks = {};
    if (config.uploadImgUrl) {
        callbacks = {
            onImageUpload: function (files) {
                var formData = new FormData();
                formData.append('file', files[0]);
                $.ajax({
                    url: config.uploadImgUrl,
                    type: "post",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res.type) {
                            $(config.element).summernote('insertImage', res.data, 'img');
                        } else {
                            console.log(res.msg);
                        }
                    }
                });
            }
        }
    }
    $(config.element).summernote({
        lang: "zh-CN",
        height: config.height ? config.height : 200,
        focus: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear','fontsize','height']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: callbacks
    });
    if (config.default) {
        $(config.element).summernote('code', config.default);
    }
    if (config.removeImgUrl) {
        $('.note-editable').on('mouseover', 'img', function () {
            nowSrc = $(this).prop('src');
        });

        $('.note-image-popover').on('click', '.note-remove', function () {
            $.getJSON(config.removeImgUrl, {src: nowSrc});
        });
    }
}