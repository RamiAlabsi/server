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
                    <a href="{{ url('vendor/stores') }}">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light"
                            aria-expanded="false">
                            @lang('lang.manage_your_stores')
                            <span class="m-l-5">
                            </span>
                        </button>
                    </a>
                </div>
                <h4 class="page-title">@lang('lang.stores')</h4>
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
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.phone')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stores as $store)
                            <tr>
                                <td>{{ $store->translation->name }}</td>
                                <td>{{ $store->email }}</td>
                                <td>{{ $store->phone }}</td>
                                <td>
                                    <a href="{{ url('admin/stores/' . $store->id) }}"
                                        class="info btn btn-info">
                                        <i class="fa fa-info-circle text-white"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-delete-id="{{ $store->id }}"
                                        class="delete btn btn-danger">
                                        <i class="fa fa-trash text-white"></i>
                                    </a>
                                </td>
                            </tr>
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
                url:"{{ url(app()->getLocale() . '/admin/stores') . '/' }}" + id,
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
                "sProcessing":    "تحميل...",
                "sLengthMenu":    "عرض _MENU_ سجل",
                "sZeroRecords":   "لم يتم العثور على نتائج",
                "sEmptyTable":    "لا توجد بيانات متاحة في هذا الجدول",
                "sInfo":          "عرض السجلات من _START_ إلى _END_ من إجمالي _TOTAL_ من السجلات",
                "sInfoEmpty":     "عرض السجلات من 0 إلى 0 من إجمالي 0 تسجيلات",
                "sInfoFiltered":  "(تصفية إجمالي _MAX_ من السجلات)",
                "sInfoPostFix":   "",
                "sSearch":        "بحث:",
                "sUrl":           "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "تحميل...",
                "oPaginate": {
                    "sFirst":    "الأول",
                    "sLast":    "الأخير",
                    "sNext":    "التالى",
                    "sPrevious": "السابق"
                },
                "oAria": {
                    "sSortAscending":  ": قم بتمكين فرز العمود بترتيب تصاعدي",
                    "sSortDescending": ": التفعيل لفرز العمود بترتيب تنازلي"
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