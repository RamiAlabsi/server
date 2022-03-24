<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
@extends('layouts.vendor_layout')


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
                    <a href="{{ url('/vendor/products/create') }}">
                        <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light"
                            aria-expanded="false">
                            @lang('lang.new')
                            <span class="m-l-5">
                                <i class="fa fa-plus"></i>
                            </span>
                        </button>
                    </a>
                </div>
                <h4 class="page-title">@lang('lang.products')</h4>
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
                                <th>@lang('lang.image')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.price')</th>
                                <th>@lang('lang.discount_rate')</th>
                                <th>@lang('lang.status')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td style="width: 10%; height:100px"> <img
                                        src="{{ url($product->images[0]->image_url) }}" style="width: 100%; height:100%"
                                        alt="product_image"> </td>
                                <td>{{ $product->translation->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <select class="discount_rate_select">
                                        @for ($i = 0; $i <= 100; $i++)
                                        <option value="{{ $i }}" data-product_id="{{ $product->id }}"
                                        {{ $i == $product->discount_rate?"selected":"" }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <span
                                        class="status label label-table label-{{ $product->trashed()?"danger":"success" }}"
                                        data-status="{{ $product->trashed()?"suspended":"active" }}"
                                        data-product_id="{{ $product->id }}">
                                        @lang('lang.' . ($product->trashed()?"suspended":"active"))</span>
                                </td>
                                <td>
                                    <a href="{{ url('products/' . $product->id . '/1') }}" class="info btn btn-info">
                                        <i class="fa fa-info-circle text-white"></i>
                                    </a>
                                    <a href="{{ url('vendor/products/' . $product->id . '/edit') }}"
                                        class="warning btn btn-warning btn-edit">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-delete-id="{{ $product->id }}"
                                        class="delete btn btn-danger">
                                        <i class="fa fa-trash text-white"></i>
                                    </a>
                                    <a href="{{url('vendor/products/'.$product->id.'/comments/show')}}" class="btn btn-info">@lang('lang.comments')</a>
                                      <a href="{{url('vendor/products/'.$product->id.'/rates/show')}}" class="btn btn-info">@lang('lang.rates')</a>
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
                url:"{{ url(app()->getLocale() . '/vendor/products') . '/' }}" + id,
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
                "sEmptyTable":    "ليس لديك أي منتجات",
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
    ///////////////////////// managing the susbended and active products:
    function toggleProductSuspention(status_span){
        var is_suspended = ($(status_span).data("status") == "suspended");
        var product_id = $(status_span).data("product_id");
        $.ajax({
            url: "{{ url(app()->getLocale() . '/vendor/products') }}/" + product_id + "/" + (is_suspended?"activate":'suspend'),
            success: function(data){
                console.log("success");
                console.log(data);

                $(status_span).data("status", (is_suspended?'active':'suspended'));
                $(status_span).text(is_suspended?'@lang("lang.active")':'@lang("lang.suspended")');
                $(status_span).toggleClass("label-success");
                $(status_span).toggleClass("label-danger");
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        })
    }
    $('.status').on('click', function(){
        var is_suspended = ($(this).data("status") == "suspended");
        if(is_suspended == false){
            Swal.fire({
                title: '@lang("lang.alert_confirm_message")',
                text: "@lang('lang.alert_warning_suspending_product')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '@lang("lang.alert_cancel")',
                confirmButtonText: '@lang("lang.alert_delete")'
                }).then((result) => {
                if (result.isConfirmed) {
                    toggleProductSuspention($(this));
                }
            });
        }
        else{
            toggleProductSuspention($(this));
        }
    })
    $('.btn-edit').on('click', function(){
        var is_susbended = false;
        $(this).parent().siblings().each(function(){
            $(this).find('.status').each(function(){
                if($(this).data('status') == "active"){
                    Swal.fire({
                        title: '@lang("lang.alert_error")',
                        text: "@lang('lang.alert_should_suspend_product')",
                        icon: 'error',
                    });
                    is_susbended = false;
                    return;
                }
                else{
                    is_susbended = true;
                }
            });
        });
        return is_susbended;
    })
</script>
<script>
    //changing the discount rate
    $('.discount_rate_select').on('change', function(){
        var product_id = $(this).children(":selected").data("product_id");
        $.ajax({
            url:"{{ url(app()->getLocale() . '/vendor/products') }}/" + product_id + "/change_discount_rate",
            type:'POST',
            data:{
                _token:"{{ csrf_token() }}",
                discount_rate: $(this).val()
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
    })
</script>
@endsection