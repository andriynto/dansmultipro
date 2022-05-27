@extends('layouts.backend.admin')

@section('title', 'Verifikasi Akun')

@section('content')
<div class="content-wrapper">
    <!-- Breadcrumb -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline ">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Beranda</a>
                    <a class="breadcrumb-item"><i class="icon-lock4 mr-2"></i> Keamanan</a>
                    <span class="breadcrumb-item active">Verifikasi Akun<span>
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

    <div class="content">
        <div class="alert alert-warning border-0 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Hallo! Bpk/Ibu {{ auth()->user()->name }}</span>, Ini adalah login pertama anda, untuk menjaga keamanan akun dan 
            privasi data perusahaan, anda harus melakukan verifikasi terlebih dahulu diawali dengan perubahan kata sandi.<br><br>
            Kami menyarankan untuk menjaga kerahasiaan akun pribadi anda. Terima kasih.
        </div>

        <div class="card">
            <form id="form-verify">
                <div class="card-body">
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Kata Sandi :</label>
                            <div class="col-lg-5">
                                <input name="password" type="password" class="form-control" id="password" value="" placeholder="Kata Sandi Baru" autocomplete="off" required="">
                                <div id="validation_msg_password" class="invalid-feedback validation-invalid-label"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Konfirmasi Kata Sandi :</label>
                            <div class="col-lg-5">
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" value="" placeholder="Konfirmasi Kata Sandi" autocomplete="off" required="">
                                <div id="validation_msg_password_confirmation" class="invalid-feedback validation-invalid-label"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">PIN :</label>
                            <div class="col-lg-7">
                                <div class="input-group">
                                    <input name="pin" type="pin" class="form-control text-center" style="font-weight: bold;" id="pin" value="" maxlength="6" onkeyup="this.value=this.value.replace(/[^0-9.,]/g,'')" placeholder="PIN" autocomplete="off" required="">
                                    <span class="input-group-append">
                                        {{-- <span class="countdown input-group-text bg-light text-dark">
                                            <b><div id="minutes"></div>:<div id="seconds"></div></b>
                                        </span> --}}
                                        
                                        <span class="countdown input-group-text bg-light text-dark">
                                            <b><span id="minutes"></span>:<span id="seconds"></span></b>
                                        </span>
                                        
                                    </span>
                                    <span class="input-group-append">
                                        <button class="btn btn-danger" id="btn-send-pin" type="button"><i class="icon-envelope"></i></button>
                                    </span>
                                </div>
                                <div><span class="text-danger"><em>Klik icon email untuk mendapatkan pin di email anda</em></span></div>
                                <div id="validation_msg_pin" class="invalid-feedback validation-invalid-label"></div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    var time = '{!! $expired_in !!}';
    $(document).ready(function($) {
        var tt = new Date(time);
        if(time != '') {
            const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(tt)
        const mo = new Intl.DateTimeFormat('en', { month: 'short' }).format(tt)
        const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(tt)
        }

        countdown(time);

        $('#btn-send-pin').click(function(e) {
            $.ajax({
                url: baseUrl + '/auth/verify/pin',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $("input[type=text]").removeClass('is-invalid');
                    $('.invalid-feedback').empty();
                    spinner = Rats.UI.LoadAnimation.start();
                },
                success: function (response) {
                    $('#btn-send-pin').prop("disabled", true);
                    $("input").attr("disabled", false);
                    Rats.UI.LoadAnimation.stop(spinner);
                    countdown(response.expired_at);
                },
                error  : function(response) {
                    if (response.readyState == 4) {
                        $("input, textarea, select").attr("disabled", false);

                        $('#btn-submit').html('Simpan').prop("disabled", false);
                        if(response.status === 422 || response.status === 423) {
                            var errors = response.responseJSON.errors;
                            
                            $.each(errors, function(key, error) {
                                if(key == 'employee_position_id' || key == 'employee_grade_id') {
                                    $('#' + key +'_select').addClass('has-error');
                                }else {
                                    var item = form.find('input[name='+ key +']');
                                    item = (item.length > 0) ? item : form.find('textarea[name='+ key +']');
                                    item = (item.length > 0) ? item : form.find("input[name='"+ key +"[]']");
                                    
                                    item.addClass("is-invalid");
                                }
                                
                                // $("input[type=text][name=" + key +"]").after('<div class="invalid-feedback validation-invalid-label">' + error +'</div>');
                                $('#validation_msg_'+key).html(error);
                            });

                            setTimeout(function() {
                                Rats.UI.LoadAnimation.stop(spinner);
                                swalInit.fire({
                                    icon : "error",
                                    title: "Terjadi kesalahan",
                                    text : "Periksa kembali data yang anda masukkan",
                                });
                            }, 500);


                            return false;
                        }

                        swalInit.fire({
                            icon : "error",
                            title: "Terjadi kesalahan",
                            text : "Terjadi kesalahan pada aplikasi atau jaringan",
                        }).then((result) => {
                            Rats.UI.LoadAnimation.stop(spinner);
                        });

                        $("input, textarea, select").attr("disabled", false);

                        return false;
                    }
                }
            });
        });

        $('#pin').on('keyup', function(e) {
            var value = $('#pin').val();
            if( value.length == 6) {
                $('#pin').prop('disabled', true);
                    $.ajax({
                    url: baseUrl + '/auth/verify',
                    type: 'POST',
                    data: {
                        'pin'   : $('#pin').val(),
                        'password' : $('#password').val(),
                        'password_confirmation' : $('#password_confirmation').val(),
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $("#pin").removeClass('is-invalid');
                        $('#pin .invalid-feedback').empty();

                        $("input[type=text]").removeClass('is-invalid');
                        $('.invalid-feedback').empty();
                        spinner = Rats.UI.LoadAnimation.start();
                    },
                    success: function (response) {
                        swalInit.fire({
                            icon : "success",
                            title: "Proses Aktivasi Berhasil",
                            text : response.message,
                        }).then((result) => {
                            window.location = baseUrl + '/dashboard';
                        });
                    },
                    error  : function(response) {
                        if (response.readyState == 4) {
                            $("input, textarea, select").attr("disabled", false);
                            $('#pin').val('');

                            if(response.status === 422 || response.status === 423) {
                                var errors = response.responseJSON.errors;
                                    
                                $.each(errors, function(key, error) {
                                    var item = $('#form-verify').find('input[name='+ key +']');
                                    item = (item.length > 0) ? item : $('#form-verify').find("input[name='"+ key +"[]']");

                                    if(key == 'password') {
                                        $('#password_confirmation').addClass('is-invalid');
                                        $('#validation_msg_password_confirmation').html('password konfirmasi terjadi kesalahan');
                                    }
                                    
                                    item.addClass("is-invalid");
                                    $('#validation_msg_'+key).html(error);
                                });

                                setTimeout(function() {
                                    Rats.UI.LoadAnimation.stop(spinner);
                                    swalInit.fire({
                                        icon : "error",
                                        title: "Terjadi kesalahan",
                                        text : "Periksa kembali data yang anda masukkan"
                                    });
                                }, 500);

                                return false;
                            }

                            else if(response.status === 522) {
                                $('#pin').addClass('is-invalid');
                                $('#validation_msg_pin').html(response.responseJSON.message);

                                setTimeout(function() {
                                    Rats.UI.LoadAnimation.stop(spinner);
                                    swalInit.fire({
                                        icon : "error",
                                        title: "Terjadi kesalahan",
                                        text : response.responseJSON.message
                                    });
                                }, 500);

                                return false;
                            }

                            swalInit.fire({
                                icon : "error",
                                title: "Terjadi kesalahan",
                                text : "Terjadi kesalahan pada aplikasi atau jaringan",
                            }).then((result) => {
                                Rats.UI.LoadAnimation.stop(spinner);
                            });

                            $("input, textarea, select").attr("disabled", false);

                            return false;
                        }
                    }
                });
            }
        });
    });

    function countdown(dateEnd) {
        var timer, years, days, hours, minutes, seconds;
        dateEnd = new Date(dateEnd);
        dateEnd = dateEnd.getTime();
        if (isNaN(dateEnd)) {return;}
        timer = setInterval(calculate, 1);
        function calculate() {
            var dateStart = new Date();
            var dateStart = new Date(dateStart.getFullYear(), dateStart.getMonth(), dateStart.getDate(), dateStart.getHours(), dateStart.getMinutes(), dateStart.getSeconds());
        
            var timeRemaining = parseInt((dateEnd - dateStart.getTime()) / 1000)

            if (timeRemaining >= 0) {
                $('#btn-send-pin').prop("disabled", true);

                years = parseInt(timeRemaining / 31536000);
                timeRemaining = (timeRemaining % 31536000);
                days = parseInt(timeRemaining / 86400);
                timeRemaining = (timeRemaining % 86400);
                hours = parseInt(timeRemaining / 3600);
                timeRemaining = (timeRemaining % 3600);
                minutes = parseInt(timeRemaining / 60);
                timeRemaining = (timeRemaining % 60);
                seconds = parseInt(timeRemaining);
                if (document.querySelectorAll('.countdown').length) {
                    document.getElementById('minutes').innerHTML = ("0" + minutes).slice(-2);
                    document.getElementById('seconds').innerHTML = ("0" + seconds).slice(-2);
                }
            } else {$('#btn-send-pin').prop("disabled", false); return;}
        }

        function display(minutes, seconds) {}
    }
</script>
@endpush