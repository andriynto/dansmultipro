
@extends('layouts.backend.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Main Content -->
<div class="content-wrapper">

   <!-- Breadcrumb -->
   <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline ">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Beranda</a>
                    <span class="breadcrumb-item active">List Jobs<span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                </div>
            </div>
            
        </div>
    </div>
    <!-- Breadcrumb -->

    <!-- Content -->
    <div class="content">
        <div class="card">
            <div class="card-header bg-primary-700 header-elements-inline">
                <h6 class="card-title">Jobs Lists</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>

            <div style="padding:10px 20px 0px 20px;">@include('flash::message')</div>

            <table class="table table-striped table-hover text-nowrap table-jobs" id="table-jobs">
                <thead>
                    <tr style="background-color:#F5F6FA;color:#000">
                        <th class="text-left text-wrap">Open Position</th>
                        <th class="text-left text-wrap"></th>
                    </tr>
                </thead>
                <tbody id="table-jobs_wrapper"></tbody>
            </table>
        </div>
    </div>
    @include('partials.backend.admin.footer')
</div>
@endsection

@push('stylesheet')
<style>
    td.wrap {
        white-space:normal
    }

    table#table-.dataTable tbody tr:hover {
        background-color: #F5F6FA;
    }
    
    table#table-jobs.dataTable tbody tr:hover > .sorting_1 {
        background-color: #F5F6FA;
    }
</style>
@endpush

@push('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ url('assets/js/plugins/amcharts/plugins/export/export.css') }}" type="text/css" media="all">
    <style>
        
    </style>
@endpush

@push('js')
<script src="{{ url('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
@endpush

@push('broadcast')
    <script>
        var broadcastChannel = 'tax_bphtb';
    </script>
@endpush

@push('scripts')
<script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {
        DatatableAPI.init({});
    });

    var DatatableAPI = function(data) {
        var _componentDatatable = function(data) {
            
            $.fn.dataTable.ext.errMode = 'throw';
            if ($.fn.DataTable.isDataTable( '#table-jobs' ) ) {
                $('#table-jobs').dataTable().fnDestroy();
            }

            // Initialize
            var table = $('#table-jobs').DataTable({
                autoWidth: false,
                serverSide: true,
                processing:true,
                pagingType: "full_numbers",
                order: [[ 0, 'asc' ]],
                dom: '<"datatable-header datatable-header-accent"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Pencarian :</span> _INPUT_',
                    searchPlaceholder: 'Ketik Kode Min 4 karakter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'Pertama', 'last': 'Terakhir', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                },
                lengthMenu: [18, 32],
                displayLength: 10,
                "ajax" : {
                    type	: 'GET',
                    url     :  baseUrl + '/jobs/lists',
                    beforeSend: function() {
                        spinner = Rats.UI.LoadAnimation.start();
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : data,
                    dataSrc	: function ( response ) {
                        if(response.data.length == 0) {
                            Rats.UI.LoadAnimation.stop(spinner);

                            new Noty({
                                text: 'Jobs list not found',
                                type: 'warning'
                            }).show();
                            return [];
                        }else {
                            Rats.UI.LoadAnimation.stop(spinner);

                            new Noty({
                                text: 'Jobs lists found',
                                type: 'success'
                            }).show();
                            return response.data
                        }
                    }
                },
                "columns": [
                    {
                        data: "title", className: "text-left", "width": "80%",  "orderable" : false,
                        render: function (data, type, row, meta) {
                            return '<h6 class="media-title font-weight-semibold">\
                                <a href=""> '+data+' </a> <br>\
                                <ul class="list-inline list-inline-dotted text-muted mb-2">\
                                    <li class="list-inline-item"><a href="#" class="text-muted">'+row.company+'</a></li>\
                                    <li class="list-inline-item text-success">'+row.type+'</li>\
                                </ul>\
                            </h6>';
                        }
                    },
                    {
                        data: "location", className: "text-right", "width": "20%",  "orderable" : false,
                        render: function (data, type, row, meta) {
                            var aDay = 24 * 60 * 60 * 1000;
                            
                            return '<span class="text-muted">'+data+'</span> <br>\
                            <span class="text-muted">'+timeSince(new Date(Date.now() - aDay * 2))+'</span>';
                        }
                    }
                ]
            });

            $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function(e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if(this.value.length >= 4 || e.keyCode == 13) {
                    // Call the API search function
                    table.search(this.value).draw();
                }
                // Ensure we clear the search if they backspace far enough
                if(this.value == "") {
                    table.search("").draw();
                }
                return;
            });
        };


        return {
            init: function(data) {
                _componentDatatable(data);
            }
        }
    }();

    function timeSince(time) {
        switch (typeof time) {
        case 'number':
            break;
        case 'string':
            time = +new Date(time);
            break;
        case 'object':
            if (time.constructor === Date) time = time.getTime();
            break;
        default:
            time = +new Date();
        }
        var time_formats = [
        [60, 'seconds', 1], // 60
        [120, '1 minute ago', '1 minute from now'], // 60*2
        [3600, 'minutes', 60], // 60*60, 60
        [7200, '1 hour ago', '1 hour from now'], // 60*60*2
        [86400, 'hours', 3600], // 60*60*24, 60*60
        [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
        [604800, 'days', 86400], // 60*60*24*7, 60*60*24
        [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
        [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
        [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
        [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
        [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
        [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
        [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
        [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ];
        var seconds = (+new Date() - time) / 1000,
        token = 'ago',
        list_choice = 1;

        if (seconds == 0) {
        return 'Just now'
        }
        if (seconds < 0) {
        seconds = Math.abs(seconds);
        token = 'from now';
        list_choice = 2;
        }
        var i = 0,
        format;
        while (format = time_formats[i++])
        if (seconds < format[0]) {
            if (typeof format[2] == 'string')
            return format[list_choice];
            else
            return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
        }
        return time;
    }

</script>
@endpush