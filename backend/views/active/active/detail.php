<?php $this->registerJsFile('/qrCode/qrCode.js', ['depends' => 'app\assets\ModelAsset']); ?>
<div class="ibox-content">
    <div class="form-horizontal">
        <div class="col-sm-6">
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">活动编号</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="<?= $model->no ?>" readonly>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">开始时间</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="<?= date('Y-m-d H:i:s', $model->begin_at) ?>"
                           readonly>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">结束时间</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="<?= date('Y-m-d H:i:s', $model->end_at) ?>"
                           readonly>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">人数限制</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="<?= $model->limit ?>" readonly>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">活动描述</label>
                <div class="col-sm-6">
                    <textarea class="form-control" readonly><?= $model->remark ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">二维码</label>
                <div class="col-sm-6">
                    <div class="qrCode"></div>
                </div>
                <script>
                    $('.qrCode').makeCode({
                        width: 320,
                        height: 320,
                        text: '<?=\vendor\project\database\Active::getJoinUrl($model->no)?>'
                    });
                </script>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="hr-line-dashed"></div>
            <div class="form-group" style="max-height: 10rem;overflow-y: hidden;text-align: center">
                <label class="col-sm-12 col-xs-12">已参与人数: <?= count($users) ?></label>
                <div class="col-sm-3 col-xs-3">用户姓名</div>
                <div class="col-sm-3 col-xs-3">联系电话</div>
                <div class="col-sm-3 col-xs-3">孩子姓名 / 所在班级</div>
                <div class="col-sm-3 col-xs-3">报名时间</div>
                <?php if ($users): ?>
                    <?php foreach ($users as $v): ?>
                        <div class="col-sm-3 col-xs-3"><?= $v['name'] ?></div>
                        <div class="col-sm-3 col-xs-3"><?= $v['tel'] ?></div>
                        <div class="col-sm-3 col-xs-3"><?= $v['child_name'] ?> / <?= $v['class'] ?></div>
                        <div class="col-sm-3 col-xs-3"><?= date('Y-m-d H:i:s', $v['created_at']) ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-sm-3 col-xs-3">----</div>
                    <div class="col-sm-3 col-xs-3">----</div>
                    <div class="col-sm-3 col-xs-3">---- / ----</div>
                    <div class="col-sm-3 col-xs-3">----</div>
                <?php endif; ?>

            </div>
        </div>
        <div class="col-sm-12">
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-8">
                    <a class="btn btn-white" href="/active/active/list">返回</a>
                </div>
            </div>
        </div>
        <div style="clear: both"></div>
    </div>
</div>