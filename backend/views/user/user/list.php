<div class="ibox-content">
    <div class="dataTables_wrapper form-inline">
        <div class="row tableSearchBox">
            <div class="col-sm-9">
                <span class="tableSpan">
                    用户名: <input class="searchField" type="text" value="" name="name">
                </span>
                <span class="tableSpan">
                    手机号: <input class="searchField" type="text" value="" name="tel">
                </span>
                <span class="tableSpan">
                    学生姓名: <input class="searchField" type="text" value="" name="child_name">
                </span>
                <span class="tableSpan">
                    学生班级: <input class="searchField" type="text" value="" name="class">
                </span>
                <span class="tableSpan">
                    账号状态: <select class="searchField" name="status">
                                <option value="">----</option>
                        <?php foreach ($status as $k => $v): ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                        <?php endforeach; ?>
                            </select>
                </span>
                <span class="tableSpan">
                    <button class="tableSearch">搜索</button>
                    <button class="tableReload">重置</button>
                </span>
            </div>
            <div class="col-sm-2" style="color: red;margin-top: 1rem">
                *用户禁用后其账户的卡券会同时被禁用
            </div>
            <div class="col-sm-1">
                <a class="btn btn-sm btn-info" href="/user/user/add">添加</a>
                <a class="btn btn-sm btn-info" href="/user/user/import">导入</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable" id="table">
            <thead>
            <tr role="row">
                <th>学生班级</th>
                <th>用户名</th>
                <th>手机号</th>
                <th>学生姓名</th>
                <th>学生性别</th>
                <th>学生年龄</th>
                <th>账号状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    myTable.load({
        table: '#table',
        url: '/user/user/data',
        length: 10,
        columns: [
            {
                "data": "class", "render": function (data, type, row) {
                return data || '----';
            }
            },
            {
                "data": "name", "render": function (data, type, row) {
                return data || '----';
            }
            },
            {
                "data": "tel", "render": function (data, type, row) {
                return data || '----';
            }
            },
            {
                "data": "child_name", "render": function (data, type, row) {
                return data || '----';
            }
            },
            {
                "data": "child_sex", "render": function (data, type, row) {
                return data || '----';
            }
            },
            {
                "data": "child_age", "render": function (data, type, row) {
                return data || '----';
            }
            },
            {"data": "status"},
            {
                "data": "id", "orderable": false, "render": function (data, type, row) {
                var str = '<a class="btn btn-sm btn-warning" href="/user/user/modify?id=' + data + '">修改</a>';
                if (row.status === '已启用') {
                    str += '&emsp;<a class="btn btn-sm btn-danger" href="/user/user/forbidden?st=0&id=' + data + '">禁用</a>';
                } else {
                    str += '&emsp;<a class="btn btn-sm btn-info" href="/user/user/forbidden?st=1&id=' + data + '">启用</a>';
                }
                return str;
            }
            }
        ],
        default_order: [0, 'asc']
    });
    myTable.search();
</script>