<?php $this->registerJsFile('/h+/js/myTree.js'); ?>
<div class="ibox-content">
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="username" value="<?=$model->username?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tel</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="tel" value="<?=$model->tel?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">密码</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="password" value="">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">职位</label>
            <div class="col-sm-6">
                <ul class="myTree"></ul>
                <script>
                    var config = {
                        element: '.myTree',
                        name: 'job_id',
                        checkbox: false,
                        data: '<?=$jobs?>',
                        default:'<?=json_encode([$model->job_id])?>'
                    };
                    myTree(config);
                </script>
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