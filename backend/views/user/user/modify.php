<div class="ibox-content">
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="name" value="<?= $model->name ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">手机号</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="tel" value="<?= $model->tel ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">学生姓名</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="child_name" value="<?= $model->child_name ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">学生性别</label>
            <div class="col-sm-2">
                <input type="radio" name="child_sex" value="0" <?= $model->child_sex == 0 ? "checked" : '' ?>>男&emsp;&emsp;
                <input type="radio" name="child_sex" value="1" <?= $model->child_sex == 1 ? "checked" : '' ?>>女
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">学生年龄</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="child_age" value="<?= $model->child_age ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">学生班级</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="class" value="<?= $model->class ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">账号状态</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"
                       placeholder="<?= \vendor\project\helpers\Constant::userStatus()[$model->status] ?>" readonly>
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