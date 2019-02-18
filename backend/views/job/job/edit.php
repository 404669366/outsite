<?php $this->registerJsFile('/h+/js/myTree.js'); ?>
<div class="ibox-content">
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">职位名称</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="job" value="<?=$model->job?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">上级</label>
            <div class="col-sm-2">
                <select class="form-control m-b" name="last">
                    <option value="0">—顶级—</option>
                    <?php foreach ($tops as $v): ?>
                        <option value="<?= $v['id'] ?>" <?=$v['id']==$model->last?'selected':''?>><?= $v['job'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">权限</label>
            <div class="col-sm-6">
                <ul class="myTree"></ul>
                <script>
                    var config = {
                        element: '.myTree',
                        name: 'powers',
                        checkbox: true,
                        data: '<?=$powers?>',
                        default:'<?=json_encode(explode(',',$model->powers))?>'
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