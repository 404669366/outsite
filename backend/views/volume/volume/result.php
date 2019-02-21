<div class="ibox-content">
    <div class="form-horizontal">
        <div class="hr-line-dashed"></div>
        <div style="color: red">
            <?= '*共检测到' . $re['allNum'] . '个用户,成功发放' . $re['insertNum'] . '个用户' ?>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">未识别用户</label>
            <div class="col-sm-2">
                <textarea class="form-control"><?= $re['result'] ?></textarea>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-white back">返回</button>
            </div>
        </div>
    </div>
</div>