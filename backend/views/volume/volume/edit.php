<?php $this->registerJsFile('/h+/js/plugins/layer/laydate/laydate.js'); ?>
<div class="ibox-content">
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">编号</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" 
                       placeholder="<?= $model->no ?>" readonly>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动券类型</label>
            <div class="col-sm-2">
                <select name="type">
                    <?php foreach (\vendor\project\helpers\Constant::volumeType() as $k => $v): ?>
                        <option value="<?= $k ?>"<?= $model->type == $k ? "selected" : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">金额</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="money" value="<?= $model->money ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动券时间范围</label>
            <div class="col-sm-10">
                <input placeholder="开始时间" class="form-control layer-date" name="begin_at" readonly id="begin_at"
                       value="<?= date('Y-m-d H:i:s', $model->begin_at) ?>">
                <input placeholder="截止时间" class="form-control layer-date " name="end_at" readonly id="end_at"
                       value="<?= date('Y-m-d H:i:s', $model->end_at) ?>">
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
            <label class="col-sm-2 control-label">备注</label>
            <div class="col-sm-2">
                <textarea name="remark"><?= $model->remark ?></textarea>
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