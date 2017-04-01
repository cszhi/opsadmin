@extends('_layout.master')
@section('content')
<div class="modal fade in" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          <span class="sr-only">{!!trans('labels.close')!!}</span>
        </button>
        <h4 class="modal-title" id="filterModalLabel">{!!trans('labels.filter')!!}</h4>
      </div>
      <form method="POST" id="search-form">
        <div class="modal-body">
          <div class="form">

            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.username')!!}</strong></span>
                <input type="text" class="form-control" placeholder="{!!trans('labels.log.username')!!}" name="name" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.method')!!}</strong></span>
                <select class="form-control method" style="width: 100%;" name="method">
                  <option value="">{!!trans('labels.log.choice')!!}</option>
                  <option value="GET">GET</option>
                  <option value="POST">POST</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.path')!!}</strong></span>
                <input type="text" class="form-control" placeholder="Path" name="path" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.ip')!!}</strong></span>
                <input type="text" class="form-control" placeholder="IP" name="ip" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.input')!!}</strong></span>
                <input type="text" class="form-control" placeholder="{!!trans('labels.log.input')!!}" name="input" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.starttime')!!}</strong></span>
                <input type="text" class="form-control" placeholder="{!!trans('labels.log.starttime')!!}" name="starttime" id="starttime"> 
              </div>
            </div>

            <div class="form-group">
              <div class="input-group input-group-sm">
                <span class="input-group-addon"><strong>{!!trans('labels.log.endtime')!!}</strong></span>
                <input type="text" class="form-control" placeholder="{!!trans('labels.log.endtime')!!}" name="endtime" id="endtime">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary submit">{!!trans('crud.submit')!!}</button>
          <button type="reset" class="btn btn-warning pull-left">{!!trans('crud.reset')!!}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
  {{--
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">查询</h3>
      </div>
      <div class="box-body">
        <form method="POST" id="search-form" class="form-inline" role="form">
          <div class="form-group" style="margin-right: 5px">
            <label for="user">用户:</label>
            <input type="text" class="form-control" name="name">
          </div>

          <div class="form-group" style="margin-right: 5px">
            <label for="ip">Ip:</label>
            <input type="text" class="form-control" name="ip">
          </div>

          <div class="form-group" style="margin-right: 5px">
            <label for="input">输入:</label>
            <input type="text" class="form-control" name="input">
          </div>

          <div class="form-group" style="margin-right: 5px">
            <label for="starttime">开始:</label>
            <input type="text" class="form-control" name="starttime" id="starttime"> 
          </div>

          <div class="form-group" style="margin-right: 5px">
            <label for="endtime">结束:</label>
            <input type="text" class="form-control" name="endtime" id="endtime">
          </div>
          <button type="submit" class="btn btn-primary" >查询</button>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  --}}
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-th"></i><h3 class="box-title">{!!$sub_title or " "!!}</h3>
        <div class="box-tools pull-right">
          <a type="button" class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter"></i> {!!trans('labels.filter')!!}</a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-hover" id="logs-table">
        <thead>
          <tr>
            <th>{!!trans('labels.log.id')!!}</th>
            <th>{!!trans('labels.log.username')!!}</th>
            <th>{!!trans('labels.log.method')!!}</th>
            <th>{!!trans('labels.log.path')!!}</th>
            <th>{!!trans('labels.log.ip')!!}</th>
            <th style="width:40%">{!!trans('labels.log.input')!!}</th>
            <th>{!!trans('labels.log.created_at')!!}</th>
          </tr>
        </thead>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection

@section('css')
<style type="text/css">
  .autobreak {
    word-break:break-all; word-wrap:break-all;
  }
</style>
<link href="{!! asset('s/plugins/datatables/dataTables.bootstrap.css') !!}" rel="stylesheet">
<link href="{!! asset('s/plugins/datetimepicker/bootstrap-datetimepicker.min.css') !!}" rel="stylesheet">
@endsection

@section('js')
<script type="text/javascript" src="{!! asset('s/plugins/datetimepicker/bootstrap-datetimepicker.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('s/plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js') !!}"></script>
<script type="text/javascript" src="{!! asset('s/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('s/plugins/datatables/dataTables.bootstrap.min.js') !!}"></script>
<script>
  $(function(){
    var logTable = $('#logs-table').DataTable({
      //https://datatables.net/examples/basic_init/dom.html
      dom: "<'row'<'col-sm-6'l><'col-sm-6'p>r>"+
          "<'row'<'col-sm-12't>>"+
          "<'row'<'col-sm-6'i><'col-sm-6'p>>",
      processing: true,
      serverSide: true,
      ajax: {
        url: '{!! route('admin.log.ajaxIndex') !!}',
        data: function (d) {
          d.user = $('input[name=name]').val();
          d.method = $('select[name=method]').val();
          d.path = $('input[name=path]').val();
          d.ip = $('input[name=ip]').val();
          d.input = $('input[name=input]').val();
          d.starttime = $('input[name=starttime]').val();
          d.endtime = $('input[name=endtime]').val();
        }
      },
      order : [],
      orderCellsTop: true,
      columns: [
        {data: 'id', orderable: false},
        {
          data: 'user.name', 
          orderable: false,
          render:function(data){
            if (data == null) {
              return 'null';
            }else{
              return data;
            }
          }
        },
        {
          data: 'method', 
          orderable: false,
          render:function(data) {
            if (data == "POST") {
              return '<span class="badge bg-yellow">'+data+'</span>';
            }else {
              return '<span class="badge bg-green">'+data+'</span>';
            }
            
          }
        },
        {
          data: 'path', 
          orderable: false,
          render:function(data) {
            return '<span class="label label-info">'+data+'</span>';
          }
        },
        {
          data: 'ip', 
          orderable: false,
          render:function(data) {
            return '<span class="label label-primary">'+data+'</span>';
          }
        },
        {
          data: 'input', 
          className: "autobreak", 
          orderable: false,
          render:function(data) {
            return '<code>'+data+'</code>';
          }
        },
        {data: 'created_at'}
      ],
      language: {url: "{!! asset('s/plugins/datatables/i18n/Chinese.json') !!}"}
    });

    $('#search-form').on('submit', function(e) {
        $("#filterModal").modal('toggle');
        logTable.draw();
        e.preventDefault();
    });

    {{--
    $('#filterModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')

      $.ajax({
        type: "get",
        url : '/alert/log/'+id,
        success : function(a){
          $("#a_hostname").text(a.hostname),
          $("#a_ip").text(a.ip),
          $("#a_type").text(a.type),
          $("#a_user").text(a.user),
          $("#a_name").text(a.name),
          $("#a_content").text(a.content),
          $("#a_created_at").text(a.created_at)
        }
      });
    });
    --}}
	  $('#starttime').datetimepicker({
	    language:  'zh-CN',
	    weekStart: 1,
	    autoclose: 1,
	    todayHighlight: 1,
	    startView: 2,
	    forceParse: 0,
	    //showMeridian: 1,
	    format: 'yyyy-mm-dd',
	    minView: 2,
	    minuteStep: 30
	  });

	  $('#endtime').datetimepicker({
	    language:  'zh-CN',
	    weekStart: 1,
	    autoclose: 1,
	    todayHighlight: 1,
	    startView: 2,
	    forceParse: 0,
	    //showMeridian: 1,
	    format: 'yyyy-mm-dd',
	    minView: 2,
	    minuteStep: 30
	  });
	});

</script>

@endsection