<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
@extends('layouts.admin_layout')


@section('css')
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{URL::TO('/')}}/public/admin_assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
<script src="{{URL::TO('/')}}/public/admin_assets/js/modernizr.min.js"></script>
@endsection
@section('content')
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">@lang('lang.users')</h4>
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
                                    <th>@lang('lang.role')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <select data-id="{{ $user->id }}" class="form-control select2 role">
                                                <option value="2" {{ $user->role == 2? 'selected' : '' }}>@lang('lang.users')</option>
                                                <option value="1" {{ $user->role == 1? 'selected' : '' }}>@lang('lang.vendor')</option>
                                                <option value="0" {{ $user->role == 0? 'selected' : '' }}>@lang('lang.admin')</option>
                                        </select>

                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-delete-id="{{ $user->id }}" class="delete btn btn-danger" {{auth()->user()->id == $user->id ? 'disabled' : ''}}><i class="fa fa-trash text-white"></i></a>
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
            url:"{{url(app()->getLocale() . '/admin/users/delete')}}",
            type:'post',
            data:{ id:id , _token:"{{ csrf_token() }}" },
            success:function(r){
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: "@lang('lang.alert_success')",
                  showConfirmButton: false,
                  timer: 1500,
                })
                location.reload();
                }
            });
            }
        });
    });

$('.role').change(function(){
        var role = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            url:'{{ route("users.update")}}',
            type:'post',
            data:{role : role , id : id , _token:"{{ csrf_token() }}" },
               success:function(r){
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: "@lang('lang.permission_changed')",
                  showConfirmButton: false,
                  timer: 500
                })
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
