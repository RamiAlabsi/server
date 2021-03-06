<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
@extends('layouts.admin_layout')


@section('css')
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet"
    type="text/css" />
<script src="{{URL::TO('/')}}/public/admin_assets/js/modernizr.min.js"></script>

@endsection
@section('content')
<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <a data-toggle="modal" data-target="#addbraand">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light"
                            aria-expanded="false">
                            @lang('lang.new')
                            <span class="m-l-5">
                                <i class="fa fa-plus"></i>
                            </span>
                        </button>
                    </a>
                </div>
                <h4 class="page-title">@lang('lang.countries')</h4>
                <p class="text-muted page-title-alt"></p>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b></b></h4>
                    <p class="text-muted font-13 m-b-30">

                    </p>

                    <table id="datatable-fixed-col" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.logo')</th>
                                <th>@lang('lang.url')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $i=>$brand)
                            <tr>
                                <td>{{ $brand->name }}</td>
                                <td><img src="{{url('/')}}/{{$brand->logo}}" title="{{$brand->name}}" width="200px" height="200px"/></td>
                                <td>{{$brand->url}}</td>
                                <td>
                                <a data-toggle="modal" data-target="#editbraand{{$i}}"class="edit btn btn-info">
                                <i class="fa fa-edit text-white"></i>
                                </a>
                                <a class="delete btn btn-danger" data-delete-id="{{$brand->id}}">
                                <i class="fa fa-trash text-white"></i>
                                </a>
                                    
                                </td>
                            </tr>
                            <!-- Modal -->
<div class="modal fade" id="editbraand{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('brands.update',$brand->id)}}" enctype="multipart/form-data" method="post">
      @csrf
      <input type="hidden" name="_method" value="put"/>
      <div class="row">
           <div class="form-group">
              <lable class="col-md-2">@lang('lang.name')</lable>
              <div class="col-md-10">
              <input name="name" type="text" class="form-control" value="{{$brand->name}}"/>
              </div>
           </div>
           <div class="form-group">
              <lable class="col-md-2">@lang('lang.logo')</lable>
              <div class="col-md-10">
              <input name="logo" type="file"class="form-control"/>
              </div>
           </div>
           <div class="form-group">
              <lable class="col-md-2">@lang('lang.url')</lable>
              <div class="col-md-10">
              <input name="url" type="text" class="form-control" value="{{$brand->url}}"/>
              </div>
           </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
        </form>
      </div>
    </div>
  </div>
</div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
@endsection
 <!-- Modal -->
 <div class="modal fade" id="addbraand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('brands.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
           <div class="">
              <lable class="col-md-2">@lang('lang.name')</lable>
              <div class="col-md-10">
              <input name="name" type="text" class="form-control"/>
              </div>
           </div>
        
           <div class="form-group">
              <lable class="col-md-2">@lang('lang.logo')</lable>
              <div class="col-md-10">
              <input name="logo" type="file"class="form-control"/>
              </div>
           </div>
           <div class="form-group">
              <lable class="col-md-2">@lang('lang.url')</lable>
              <div class="col-md-10">
              <input name="url" type="text" class="form-control"/>
              </div>
           </div>
           </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

@section('script')
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/jszip.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/pdfmake.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/vfs_fonts.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/buttons.print.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

<script src="{{URL::TO('/')}}/public/admin_assets/pages/datatables.init.js"></script>
<script type="text/javascript">
    $('.delete').on('click',function(){
        
        var id = $(this).attr('data-delete-id');
        Swal.fire({
          title: "@lang('lang.alert_confirm_message')",
          text: "@lang('lang.alert_irreversible_message')",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: "@lang('lang.alert_delete')",
          cancelButtonText: "@lang('lang.alert_cancel')"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url:"{{ url(app()->getLocale() . '/admin/brands') . '/' }}" + id,
                type:'DELETE',
                data:{ _token:"{{ csrf_token() }}" },
                success:function(data){
                    console.log("success");
                    console.log(data);
                    
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "@lang('lang.alert_success')",
                    showConfirmButton: false,
                    timer: 1500,
                    })
                    location.reload();
                },
                error:function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }
    });
});
</script>
@if(app()->getLocale() == 'ar')
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#datatable-fixed-col').DataTable({
            "language": {
                "sProcessing":    "??????????...",
                "sLengthMenu":    "?????? _MENU_ ??????",
                "sZeroRecords":   "???? ?????? ???????????? ?????? ??????????",
                "sEmptyTable":    "???? ???????? ???????????? ?????????? ???? ?????? ????????????",
                "sInfo":          "?????? ?????????????? ???? _START_ ?????? _END_ ???? ???????????? _TOTAL_ ???? ??????????????",
                "sInfoEmpty":     "?????? ?????????????? ???? 0 ?????? 0 ???? ???????????? 0 ??????????????",
                "sInfoFiltered":  "(?????????? ???????????? _MAX_ ???? ??????????????)",
                "sInfoPostFix":   "",
                "sSearch":        "??????:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "??????????...",
                "oPaginate": {
                    "sFirst":    "??????????",
                    "sLast":    "????????????",
                    "sNext":    "????????????",
                    "sPrevious": "????????????"
                },
                "oAria": {
                    "sSortAscending":  ": ???? ???????????? ?????? ???????????? ???????????? ????????????",
                    "sSortDescending": ": ?????????????? ???????? ???????????? ???????????? ????????????"
                }
            }
        });
    });
    TableManageButtons.init();
</script>
@else
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#datatable-fixed-col').DataTable({
        });
    });
    TableManageButtons.init();
</script>
@endif

@endsection