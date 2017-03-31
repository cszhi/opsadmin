{{--
@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>Whoops! Something went wrong!</strong>
        <br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 警告!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
--}}
@if (count($errors) > 0)
    <link href="{!! asset('s/plugins/toastr/toastr.min.css') !!}" rel="stylesheet">
    <script type="text/javascript" src="{!! asset('s/plugins/toastr/toastr.min.js') !!}"></script>
    <script type="text/javascript">
        $(function () {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": "4500",
                "positionClass": "toast-top-center"
            }
            toastr.error(" @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach")
        });
    </script>
@endif