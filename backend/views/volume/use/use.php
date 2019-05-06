<?php $this->registerJsFile('/h+/js/plugins/suggest/bootstrap-suggest.min.js', ['depends' => 'app\assets\ModelAsset']); ?>
<div class="ibox-content">
    <h2>用户票券管理</h2>
    <p>通过手机号查询用户管理票券</p>
    <div class="input-group">
        <input type="text" class="form-control" id="testNoBtn" value="<?= $tel ?>">
        <div class="input-group-btn">
            <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
        </div>
        <script>
            $("#testNoBtn").bsSuggest({
                url: "/volume/use/get-users",
                showBtn: false,
                idField: "tel",
                keyField: "tel",
                effectiveFields:"tel",
            }).on("onSetSelectValue", function (e, keyword) {
                $.getJSON('/volume/use/get-user-volume', {id: keyword.id}, function (re) {
                    var one = '';
                    $.each(re.data, function (k, v) {
                        one += '<tr>';
                        one += '<td>' + ((v.money !== 0 && v.money !== '' && v.money !== '0') ? v.money + '元' : '' ) + v.type + '</td>';
                        one += '<td>' + format(v.begin_at) + ' - ' + format(v.end_at) + '</td>';
                        one += '<td>' + v.status + '</td>';
                        if (v.status === '未使用' && v.type === '活动优惠券') {
                            one += '<td class="client-status"><a class="label label-primary" href="/volume/use/del?id=' + v.id + '">扣除</a></td>';
                        } else {
                            one += '<td class="client-status">----</td>';
                        }
                        one += '</tr>';
                    });
                    $('.dataBox').html(one || ('<tr>\n' +
                        '                    <td>----</td>\n' +
                        '                    <td>----</td>\n' +
                        '                    <td>----</td>\n' +
                        '                    <td class="client-status">----</td>\n' +
                        '                </tr>'));
                });
            });
        </script>
    </div>
    <div class="clients-list">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tbody class="dataBox">
                <?php foreach ($volume as $v): ?>
                    <tr>
                        <td><?= ($v['money'] ? $v['money'] . '元' : '') . $v['type'] ?></td>
                        <td><?= date('Y-m-d H:i:s', $v['begin_at']) . ' - ' . date('Y-m-d H:i:s', $v['end_at']) ?></td>
                        <td><?= $v['status'] ?></td>
                        <td class="client-status">
                            <?php if ($v['status'] == '未使用' && $v['type'] == '活动优惠券'): ?>
                                <a class="label label-primary" href="/volume/use/del?id=<?= $v['id'] ?>">扣除</a>
                            <?php else: ?>
                                ----
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>