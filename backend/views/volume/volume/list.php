<div class="ibox-content">
    <div class="dataTables_wrapper form-inline">
        <div class="row tableSearchBox">
            <div class="col-sm-8">
                <span class="tableSpan">
                    编号: <input class="searchField" type="text" value="" name="no">
                </span>
                <span class="tableSpan">
                    活动券类型: <select class="searchField" name="type">
                                <option value="">----</option>
                        <?php foreach (\vendor\project\helpers\Constant::volumeType() as $k => $v): ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                        <?php endforeach; ?>
                            </select>
                </span>
                <span class="tableSpan">
                    <button class="tableSearch">搜索</button>
                    <button class="tableReload">重置</button>
                </span>
            </div>
            <div class="col-sm-3" style="color: red;margin-top: 1rem">
                *未发放的活动券才可以修改/删除
            </div>
            <div class="col-sm-1">
                <a class="btn btn-sm btn-info" href="/volume/volume/add">添加</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable" id="table">
            <thead>
            <tr role="row">
                <th>编号</th>
                <th>开始时间</th>
                <th>截止时间</th>
                <th>金额</th>
                <th>活动券类型</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    myTable.load({
        table: '#table',
        url: '/volume/volume/data',
        length: 10,
        columns: [
            {"data": "no"},
            {
                "data": "begin_at", 'render': function (data, type, row) {
                return format(data);
            }
            },
            {
                "data": "end_at", 'render': function (data, type, row) {
                return format(data)
            }
            },
            {"data": "money"},
            {"data": "type"},
            {"data": "remark"},
            {
                "data": "id", "orderable": false, "render": function (data, type, row) {
                var str = '<a class="btn btn-sm btn-warning" href="/volume/volume/edit?id=' + data + '">修改</a>';
                str += '&emsp;<a class="btn btn-sm btn-danger" href="/volume/volume/del?id=' + data + '">删除</a>';
                return str;
            }
            }
        ],
        default_order: [0, 'desc']
    });
    myTable.search();
</script>