@extends('layouts.admin.empty')

@section('trails')
    <div class="trail"><a href="{{ route('backend.cases.show', [$case_id]) }}"><i class="ion-ios-arrow-back"></i> Kembali</a></div>
@stop

@section('content-admin')
{{ BootForm::open()->action(route('backend.suspect.store')) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Tambah Tersangka</h4>
            <input type='hidden' name='case_id' value='{{$case_id}}'/>
        </div>
        <div class="panel-body">

            <div class="form-group well">
                <label class="radio-inline">
                    <input type="radio" name="type" id="radioIndividu" value="individu" {{ (Input::old('suspect-type', 'individu') == 'individu')?'checked=checked':''}}> Individu
                </label>
                <label class="radio-inline">
                    <input type="radio" name="type" id="radioBadan" value="badan" {{ (Input::old('suspect-type') == 'badan')?'checked=checked':''}}> Badan/Perusahaan
                </label>
            </div>

            <div class="">{{ BootForm::text('Nama', 'name') }}</div>
            <div class="suspect-type badan">{{ BootForm::text('Nama Pimpinan', 'nama_pimpinan') }}</div>

            <div class="row suspect-type individu">
                <div class="col-md-3">
                    {{ BootForm::select('Tempat Lahir', 'pob_id')->options($cities) }}
                </div>
                <div class="col-md-3">
                    {{ BootForm::text('Tanggal Lahir', 'dob')->addClass('datepicker')->data('provide', 'datepicker')->data('date-start-view', 2)->id('dob') }}
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Umur</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="age" value="{{ Input::old('age') }}" id="age">
                            <span class="input-group-addon">tahun</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    {{ BootForm::select('Jenis Kelamin', 'sex')->options($jenisKelamins) }}
                </div>
            </div>

            {{ BootForm::textarea('Alamat', 'address')->rows(3) }}
            {{ BootForm::select('Kota', 'city_id')->options($cities) }}

            <div class="row suspect-type individu">
                <div class="col-md-3">
                    {{ BootForm::text('Kewarganegaraan', 'nationality') }}
                </div>
                <div class="col-md-3">
                    {{ BootForm::text('Pendidikan', 'education') }}
                </div>
                <div class="col-md-3">
                    {{ BootForm::text('Pekerjaan', 'job') }}
                </div>
                <div class="col-md-3">
                    {{ BootForm::select('Agama', 'religion')->options($religions) }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">{{ BootForm::select('Status', 'status')->options($status) }}</div>
                <div class="col-md-3">{{ BootForm::select('Status Tahanan', 'tahanan')->options($jenisTahanan) }}</div>
                <div class="col-md-3">{{ BootForm::text('Tanggal Penahanan', 'tgl_penahanan')->addClass('datepicker')->data('provide', 'datepicker')->data('date-start-view', 2) }}</div>
                <div class="col-md-3">{{ BootForm::text('Nomor Penahanan', 'nomor_penahanan') }}</div>
            </div>
        </div>
        <div class="panel-footer">
            <a class="btn btn-default" href="{{ route('backend.cases.show', [$case_id]) }}">Batal</a>
            {{ BootForm::submit('Simpan', 'btn-primary') }}
        </div>
    </div>


{{ BootForm::close() }}

@stop

@section('script-end')
    @parent
    <script>
    $(function(){
        $('input[name=type]').on('change', function(e){

            if($(this).is(':checked'))
            {
                var selected = $(this).val();

                $('.suspect-type').hide();
                $('.suspect-type.' + selected).show();
            }

        }).trigger("change");

        $('#dob').on('change', function(){
            var age = moment().diff(moment($(this).val(), 'DD-MM-YYYY'), 'years');
            $('#age').val(age);
        });
    });
    </script>
@stop