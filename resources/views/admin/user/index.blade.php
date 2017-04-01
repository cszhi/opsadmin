@extends('_layout.master')
@section('css')
<link href="{!! asset('s/plugins/datatables/dataTables.bootstrap.css') !!}" rel="stylesheet">
@endsection

@section('content')
@include('shared.errors')
@include('shared.status')
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
        <h4 class="modal-title" id="DeleteModalLabel">删除</h4>
      </div>
      <div class="modal-footer">
        <form method="post" action="" class="pull-right">
          {!!csrf_field()!!}
          <div class="form-group">
            <div>
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="submit" class="btn btn-danger">删除</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.deleteUserModal -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-th"></i><h3 class="box-title">{!!$sub_title or " "!!}</h3>
        <div class="box-tools pull-right">
          <a type="button" class="btn btn-sm btn-primary" href="{!!Route('admin.user.create')!!}"><i class="fa fa-plus"></i> 添加</a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-hover" id="users-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>用户名称</th>
              <th>邮箱</th>
              <th>角色</th>
              <th>注册时间</th>
              <th>更新时间</th>
              <th>操作</th>
            </tr>
          </thead>
          <!-- /.thead -->
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="{!! asset('s/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('s/plugins/datatables/dataTables.bootstrap.min.js') !!}"></script>
<script type="text/javascript">
$(function() {
  $('#users-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": '{!! route('admin.user.ajaxIndex') !!}',
    "order" : [],
    "orderCellsTop": true,
    "columns": [
      {"data": 'id',"name": 'id',"orderable" : false},
      {"data": 'name',"name": 'name'},
      {"data": 'email',"name": 'email'},
      {
        "data": 'role', 
        "name": 'role.name',
        render:function(data){
          if (data == null) {
            return 'null';
          }else{
            return '<span class="label label-primary">'+data+'</span>';
          }
        }
      },
      {"data": 'created_at',"name": 'created_at'},
      {"data": 'updated_at',"name": 'updated_at'},
      {"data": 'action',"orderable" : false, "searchable": false},
    ],
    "language": {
      "url": "{!! asset('s/plugins/datatables/i18n/Chinese.json') !!}"
    }
  });

  $('#DeleteModal').on('show.bs.modal', function (event) {
    var a = $(event.relatedTarget) // Button that triggered the modal 当前点击的对象
    var action = a.data('action') //从点击的对象获取属性值
    var name = a.data('name') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-header h4').text('删除用户'+name+'?')
    modal.find('.modal-footer form').attr('action', action)
  });
});
</script>

@endsection