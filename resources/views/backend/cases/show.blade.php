@extends('layouts.admin.admin-full')

@section('breadcrumb-subtitle-text')
    Manajemen Kasus
@stop

@section('content-admin')
<div id="page-case-sop">
    <div class="well pad-lg case-info">
        <h2 class="page-title text-center">{{ $case['name'] }}</h2>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                    <dl>
                        <dt>Nomor SPDP</dt>
                        <dd>{{ $case['spdp_number'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Pasal</dt>
                        <dd>{{ nl2br($case['pasal']) }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Penyidik</dt>
                        <dd>{{ $case['penyidik_name'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Jaksa</dt>
                        <dd>{{ $case['prosecutor_name'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Staff Administrasi</dt>
                        <dd>{{ $case['staff_name'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Jenis Kasus</dt>
                        <dd><span class="label label-default">{{ $case['type_name'] }}</span></dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Usia Kasus</dt>
                        <dd>
                            @if($case['age'] !== false)
                                {{ $case['age'] }} hari
                            @else
                                <span class="label label-default">{{ $case['status'] }}</span>
                            @endif
                        </dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Status</dt>
                        <dd><span class="label label-primary">{{ $case['status_name'] }}</span></dd>
                    </dl>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="text-right action">
            <a href="/backend/cases/edit/{{$case['id']}}" class="btn btn-default btn-xs">Ubah Data</a>
            {{ Form::delete(route('backend.cases.delete', $case['id']), 'Hapus Kasus', ['class' => 'form-delete'], ['class' => 'btn btn-danger btn-xs']) }}
        </div>

    </div>

    <div class="container-fluid section-entry">

        <div class="col-md-6">
            <div class="panel panel-default">
                @foreach($phases as $phase)
                    <div class="panel-heading">{{ $phase['name'] }}</div>
                    <ul class="list-group {{ (($phase->id > $case['phase']['id']) && $phase->id != $case['phase_id'])?'disabled':'' }}">
                        @foreach($phase['checklist'] as $item)

                            @if(in_array($item['id'], $checklistIds))
                                <li class="list-group-item list-group-item-success">

                                    @if($case->isLatestChecklist($item))
                                        {{ Form::open(['route' => ['backend.cases.unchecklist', $case->id, $item['id']], 'method' => 'post', 'class' => 'pull-right']) }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        {{ Form::submit('Batal', ['class' => 'btn btn-link']) }}
                                        {{ Form::close() }}
                                    @endif

                                    <i class="fa fa-check"></i>
                                    {{ $item['name'] }}

                                </li>
                            @else
                                <li class="list-group-item item-checklist" data-id="{{ $item['id'] }}" data-url="{{ route('backend.cases.checklist', [$case['id'], $item['id']]) }}">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="checklist[]" value="{{ $item['id'] }}"/>
                                            {{ $item['name'] }}

                                            @if($phase->id == $case['phase_id'])
                                                <?php $remaining = $sop->checklistRemainingDay($case, $item) ?>
                                                &nbsp;&nbsp;
                                                @if($remaining)
                                                    @if($remaining > 0)
                                                        <small class="label label-success">{{ $remaining }} hari lagi</small>
                                                    @else
                                                        <small class="label label-danger">lewat {{ abs($remaining) }} hari</small>
                                                    @endif
                                                @endif
                                            @endif
                                        </label>
                                    </div>
                                </li>
                            @endif

                        @endforeach
                    </ul>
                @endforeach
            </div>

        </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon ion-ios-body"></i> Tersangka
                <a href="/backend/suspect/create?case_id={{$case->id}}" class="btn btn-default btn-xs pull-right"><i class="ion-android-add"></i> Tambah</a>
            </div>
            @if(count($case->suspects))
            <?php $count = 1;?>
            <table style="margin: 10px">

                @foreach($case->suspects as $item)
                <tr>
                    <th style="padding-top: 10px">#{{$count++;}}</th>
                </tr>
                <tr>
                    <td width="150px">Nama </td>
                    <td>{{ $item['name'] }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>{{$item->sex}}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir </td>
                    <td>{{$item->suspectPob->nama}}</td>
                </tr>
                <tr>
                    <td>Umur/Tanggal Lahir </td>
                    <td>{{$item->age}}/{{ $item['dob'] }}</td>
                </tr>
                <tr>
                    <td>Agama </td>
                    <td>{{ $item->religion}}</td>
                </tr>
                <tr>
                    <td>Alamat </td>
                    <td>
                        {{ $item->address }}<br/>
                        {{ $item->addressCity?$item->addressCity->nama:'' }}<br/>
                    </td>
                </tr>
                <tr>
                    <td>Kewarganegaraan </td>
                    <td>{{ $item['nationality'] }}</td>
                </tr>
                <tr>
                    <td>Pendidikan </td>
                    <td>{{ $item['education'] }}</td>
                </tr>
                <tr>
                    <td>Pekerjaan </td>
                    <td>{{ $item['job'] }}</td>
                </tr>
                <tr>
                    <td>Status Tahanan</td>
                    <td>{{ $item->tahanan}}</td>
                </tr>
                <tr>
                    <td>Ditahan Sejak</td>
                    <td>{{ $item->tgl_penahanan }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{ route('backend.suspect.edit', [$item['id']]) }}">Edit</a>
                        {{ Form::delete(route('backend.suspect.destroy', [$item['id'], 'caseId' => $case['id']]), 'Hapus', [], ['class' => 'btn-link']) }}
                    </td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><i class="ion-document-text icon"></i> Dokumen</div>
            <table class="table">
                @foreach($templates as $item)
                <tr>
                    <td>
                        {{ $item['short_title'] }} {{ $item['title'] }}
                    </td>
                    <td width="100px">
                        @if(in_array($item['id'], $documentsIds))
                            <div class="btn-group">
                                <a class="btn btn-xs btn-link" href="{{ route('backend.document.edit', [array_search( $item['id'], $documentsIds)]) }}">Edit</a>
                                {{ Form::delete(route('backend.document.destroy', [array_search( $item['id'], $documentsIds)]), 'Hapus', [], ['class' => 'btn btn-xs btn-link']) }}
                            </div>
                        @else
                            <a class="btn btn-xs btn-default" href="{{ route('backend.document.create', ['template_id' => $item['id'], 'template' => strtolower($item['short_title']), 'case_id' => $case['id']]) }}">Buat Dokumen</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>

        </div>

        <table class="table table-striped">
            <caption><i class="icon ion-ios-shuffle-strong"></i> Riwayat Aktivitas</caption>
            @foreach($activities as $item)
            <tr>
                <td width="130px"><small class="text-muted">{{ $item['date'] }}</small></td>
                <td>
                    <strong>{{ $item['name'] }}</strong>
                    <p>{{ $item['note'] }}</p>
                </td>
            </tr>
            @endforeach
        </table>


            {{ Form::open(['route' => ['backend.cases.activity', $case['id']], 'method' => 'post', 'role'=>'form']) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group">
                {{ Form::textarea('content', '', ['class' => 'form-control', 'rows' => 3]) }}
            </div>
            <div class="text-right">
                {{ Form::submit('Tambah Catatan', ['class' => 'btn btn-primary']) }}
            </div>
            {{ Form::close() }}
    </div>
    </div>

</div>

<div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>

@stop


@section('style-head')
    @parent
    <style>
        .list-group-item.item-checklist {
            padding: 1px 10px;
        }
        .fa-check {color: #090}
        .list-group.disabled *{
            opacity: .5;
            cursor: not-allowed;
        }
    </style>
@stop

@section('script-end')
    @parent

    <script>
    $(function(){
        var $modal = $('#ajax-modal');
        $('.item-checklist').on('click', function(e){
            e.preventDefault();

            // create the backdrop and wait for next modal to be triggered
            $('body').modalmanager('loading');

            $modal.load($(this).data('url'), '', function(){
                $modal.modal();

                $('#activity-date').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true
                });
            });
        });
    });
    </script>
@stop
