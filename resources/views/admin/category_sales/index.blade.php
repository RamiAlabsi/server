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
                    <a href="{{ url('/admin/category_sales/create') }}">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light"
                            aria-expanded="false">
                            @lang('lang.new')
                            <span class="m-l-5">
                                <i class="fa fa-plus"></i>
                            </span>
                        </button>
                    </a>
                </div>
                <h4 class="page-title">@lang('lang.category_sales')</h4>
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
                                <th>#</th>
                                <th>@lang('lang.category')</th>
                                <th>@lang('lang.discount_rate')</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category_sales as $category_sale)
                            <tr>
                                <td>{{ $category_sale->id }}</td>
                                <td>
                                    <select class="category_select" data-category_sale_id="{{ $category_sale->id }}"
                                        disabled>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $category_sale->category->id?"selected":"" }}>
                                            {{ $category->translation->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="discount_rate_select"
                                        data-category_sale_id="{{ $category_sale->id }}" disabled>
                                        @for ($i = 0; $i < 100; $i++)
                                        <option value="{{ $i }}"
                                        {{ $i == $category_sale->discount_rate?"selected":"" }}>
                                        {{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-delete-id="{{ $category_sale->id }}"
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
                    url:"{{ url(app()->getLocale() . '/admin/category_sales') . '/' }}" + id,
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
            // "columnDefs": [ {
            //     "targets": 'no-sort',
            //     "orderable": 'false',
            //     "order": []
            // } ],
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
<script>
    $(document).ready(function(){
        $(".category_select").prop("disabled", false);
        $(".discount_rate_select").prop("disabled", false);

        function updateCategorySale(category_sale_id, category_id = null, discount_rate = null){
            $.ajax({
                url:"{{ url(app()->getLocale() . '/admin/category_sales') . '/' }}" + category_sale_id,
                type:'PUT',
                data:{
                    _token:"{{ csrf_token() }}",
                    category_id: category_id,
                    discount_rate: discount_rate
                },
                success:function(data){
                    console.log("success");
                    console.log(data);
                    
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "@lang('lang.alert_success')",
                    showConfirmButton: false,
                    timer: 500,
                    });
                },
                error:function(data){
                    console.log("error");
                    console.log(data);
                    Swal.fire({
                    position: 'center',
                    icon: "error",
                    title: "@lang('lang.alert_error')",
                    showConfirmButton: false,
                    timer: 2000,
                    })
                    location.reload();
                }
            });
        }
        
        $('.category_select').on('change', function(){
            var category_sale_id = $(this).data('category_sale_id');
            var category_id = $(this).val();
            console.log('category_sale_id: ' + category_sale_id + ', category_id_val: ' + category_id);
            updateCategorySale(category_sale_id, category_id, null);
        });
        $('.discount_rate_select').on('change', function(){
            var category_sale_id = $(this).data('category_sale_id');
            var discount_rate = $(this).val();
            console.log('category_sale_id: ' + category_sale_id + ', discount_rate_val: ' + discount_rate);
            updateCategorySale(category_sale_id, null, discount_rate);
        });
    });
</script>
@endsection