<?php $this->registerJsFile('/h+/js/plugins/layer/laydate/laydate.js'); ?>
<div class="ibox-content">
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动编号</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="no"
                       value="<?= \vendor\project\helpers\Helper::createNo('A') ?>" readonly>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动标题</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="title" value="">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动描述</label>
            <div class="col-sm-2">
                <textarea class="form-control" name="remark"></textarea>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动范围</label>
            <div class="col-sm-10">
                <input placeholder="开始时间" class="form-control layer-date" name="begin_at" readonly id="begin_at">
                <input placeholder="结束时间" class="form-control layer-date " name="end_at" readonly id="end_at">
            </div>
            <script>
                var begin_at = {
                    elem: "#begin_at",
                    format: "YYYY-MM-DD hh:mm:ss",
                    min: laydate.now(),
                    max: "2099-12-31 23:59:59",
                    istime: true,
                    istoday: false,
                    choose: function (datas) {
                        end_at.min = datas;
                        end_at.start = datas
                    }
                };
                var end_at = {
                    elem: "#end_at",
                    format: "YYYY-MM-DD hh:mm:ss",
                    min: laydate.now(),
                    max: "2099-12-31 23:59:59",
                    istime: true,
                    istoday: false,
                    choose: function (datas) {
                        begin_at.max = datas
                    }
                };
                laydate(begin_at);
                laydate(end_at);
            </script>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">人数限制</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="limit" value="">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary" type="submit">保存内容</button>
                <button class="btn btn-white back">返回</button>
            </div>
        </div>
    </form>
</div>