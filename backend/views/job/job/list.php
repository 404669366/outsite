<div class="ibox-content">
    <div class="dataTables_wrapper form-inline">
        <div class="row tableSearchBox">
            <div class="col-sm-10">
                <span class="tableSpan">
                    职位名称: <input class="searchField" type="text" value="" name="job">
                </span>
                <span class="tableSpan">
                    上级职位: <input class="searchField" type="text" value="" name="last" >
                </span>
                <span class="tableSpan">
                    <button class="tableSearch">搜索</button>
                    <button class="tableReload">重置</button>
                </span>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-sm btn-info" href="/job/job/add">添加</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable" id="table">
            <thead>
            <tr role="row">
                <th>ID</th>
                <th>职位</th>
                <th>上级</th>
                <th>拥有权限</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    myTable.load({
        table: '#table',
        url: '/job/job/data',
        length: 10,
        columns: [
            {"data": "id"},
            {"data": "job"},
            {"data": "lastJob","render":function (data, type, row) {
                return data ? data : '顶级职位';
            }},
            {"data": "powers"},
            {
                "data": "id", "orderable": false, "render": function (data, type, row) {
                var str = '<a class="btn btn-sm btn-warning" href="/job/job/edit?id=' + data + '">修改</a>&emsp;';
                str += '<a class="btn btn-sm btn-danger" href="/job/job/del?id=' + data + '">删除</a>';
                return str;
            }
            }
        ],
        default_order: [2, 'asc']
    });
    myTable.search();
</script>