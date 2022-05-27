
@extends('layouts.backend.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Main Content -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="content">
        <div class="row">
        </div>
    </div>
</div>
@endsection

@push('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ url('assets/js/plugins/amcharts/plugins/export/export.css') }}" type="text/css" media="all">
    <style>
        
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins/amcharts/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins/amcharts/pie.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins/amcharts/serial.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins/amcharts/themes/light.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins/amcharts/plugins/export/export.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/plugins/amcharts/plugins/responsive/responsive.min.js') }}"></script>
@endpush

@push('broadcast')
    <script>
        var broadcastChannel = 'tax_bphtb';
    </script>
@endpush

@push('scripts')
<script type="text/javascript">
    
</script>
@endpush