<?php $isRoot = \vendor\project\database\Member::isRoot(Yii::$app->user->id); ?>
<?php $str = \vendor\project\helpers\Forbidden::nextStatus(); ?>
<div style="position: fixed;display: table;left: 0;top: 0;width: 100%;height: 100%">
    <span style="display:table-cell;vertical-align: middle;text-align: center;font-size: 20px;color: pink">
        \ (QAQ) /
        <?php if ($isRoot): ?>
            <br><a href="/basis/basis/forbidden"><?= $str ?>项目</a>
        <?php endif; ?>
    </span>
</div>
