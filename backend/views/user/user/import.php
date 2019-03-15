<div class="ibox-content">
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <input type="hidden" name="dataJson" value="">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Excel文件</label>
            <div class="col-sm-2">
                <input type="file" class="form-control uploadExcel">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary importButton" type="submit" style="display: none">开始导入</button>
                <button class="btn btn-white back">返回</button>
            </div>
        </div>
    </form>
</div>
<script>
    $('.uploadExcel').change(function () {
        $('.importButton').hide();
        if (checkData()) {
            var formData = new FormData();
            formData.append('file', $(this)[0].files[0]);
            formData.append('_csrf', $('[name="_csrf"]').val());
            $.ajax({
                url: '/user/user/resolve',
                type: "post",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.type) {
                        $('[name="dataJson"]').val(JSON.stringify(res.data));
                        layer.msg('数据解析成功!');
                        $('.importButton').show();
                    } else {
                        layer.msg(res.msg);
                    }
                }
            });
        }
    });

    function checkData() {
        var fileDir = $(".uploadExcel").val();
        var suffix = fileDir.substr(fileDir.lastIndexOf("."));
        if ("" === fileDir) {
            layer.msg("选择需要导入的Excel文件！");
            return false;
        }
        if (".xls" !== suffix && ".xlsx" !== suffix) {
            layer.msg("选择Excel格式的文件导入！");
            $(".uploadExcel").val("");
            return false;
        }
        return true;
    }
</script>