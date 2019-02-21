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
                <input type="text" class="form-control"
                       placeholder="<?= \vendor\project\helpers\Constant::volumeType()[$model->type] ?>" readonly>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">金额</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="<?= $model->money ?>" readonly>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动券开始时间</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="<?= date('Y-m-d H:i:s', $model->begin_at) ?>"
                       readonly>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动券截止时间</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="<?= date('Y-m-d H:i:s', $model->end_at) ?>"
                       readonly>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">备注</label>
            <div class="col-sm-2">
                <textarea class="form-control" readonly><?= $model->remark ?></textarea>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">单用户发放数量</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="num" value="1">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">发放用户列表</label>
            <div class="col-sm-2">
                <textarea class="form-control" name="users" rows="12"></textarea>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary" type="submit">发放</button>
                <button class="btn btn-white back">返回</button>
            </div>
        </div>
    </form>
</div>