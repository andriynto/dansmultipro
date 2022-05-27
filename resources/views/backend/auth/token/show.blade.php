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
            <span class="font-weight-semibold">Hallo! Bpk/Ibu {{ auth()->user()->name }}</span>, Silahkan generate access token terlebih dahulu untuk dapat
            beraktivitas didalam sistem
        </div>

        <div class="card">
            <form id="form-verify">
                <div class="card-body">
                    <fieldset>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Grant Type :</label>
                            <div class="col-lg-5">
                                <input name="text" type="grant_type" class="form-control text-center bg-info text-dark" id="grant_type" value="Access Token" placeholder="grant_type" autocomplete="off" required="" disabled>
                                <div id="validation_msg_grant_type" class="invalid-feedback validation-invalid-label"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Access Token :</label>
                            <div class="col-lg-7">
                                <div class="input-group">
                                    <input name="access_token" type="pin" class="form-control text-center" style="font-weight: bold;" id="access_token" value="" placeholder="Generate Access Token" autocomplete="off" required="" readonly>
                                    <span class="input-group-append">
                                        <button class="btn btn-danger" id="btn-access-token" type="button"><i class="icon-arrow-right7"></i></button>
                                    </span>
                                </div>
                                <div><span class="text-danger"><em>Klik icon untuk generate access token</em></span></div>
                                <div id="validation_msg_access_token" class="invalid-feedback validation-invalid-label"></div>
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
    $('#btn-access-token').click(function(e) {
        $.ajax({
            url: baseUrl + '/auth/access-token',
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
</script>
@endpush