<div class="ibox-content">
    <div class="dataTables_wrapper form-inline">
        <div class="row tableSearchBox">
            <div class="col-sm-10">
                <span class="tableSpan">
                    NO: <input class="searchField" type="text" value="" name="no">
                </span>
                <span class="tableSpan">
                    <button class="tableSearch">搜索</button>
                    <button class="tableReload">重置</button>
                </span>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-sm btn-info" href="/active/active/add">添加</a>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover dataTable" id="table">
            <thead>
            <tr role="row">
                <th>NO</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>人数限制</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    myTable.load({
        table: '#table',
        url: '/active/active/data',
        length: 10,
        columns: [
            {"data": "no"},
            {
                "data": "begin_at", "render": function (data, type, row) {
                return format(data);
            }
            },
            {
                "data": "end_at", "render": function (data, type, row) {
                return format(data);
            }
            },
            {"data": "limit"},
            {
                "data": "id", "orderable": false, "render": function (data, type, row) {
                var str = '<a class="btn btn-sm btn-warning" href="/active/active/detail?id=' + data + '">详情</a>';
                if (row.can) {
                    str += '&emsp;<a class="btn btn-sm btn-danger" href="/active/active/del?id=' + data + '">删除</a>';
                }
                return str;
            }
            }
        ],
        default_order: [0, 'desc']
    });
    myTable.search();
</script>