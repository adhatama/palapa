@extends('layouts.full.full')

@section('breadcrumb-title')
    Jaksa
@stop

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Daftar Jaksa di Kejaksaan Negeri Jember
        </div>
    <table class="table">
    <tbody>
    @foreach($officers as $key=>$jaksa)
    <tr>
        <td style="padding-left:50px;">
            <h3>{{ $jaksa->name }}</h3>
        </td>
        <td>
            <dl class="dl-horizontal">
                <dt>Pangkat / NIP</dt>
                <dd>{{ $jaksa->pangkat_name }} / {{ $jaksa->nip }}</dd>
                <dt>Jabatan</dt>
                <dd>{{ $jaksa->jabatan_name }}</dd>
            </dl>
        </td>
        <td>
            <a class="btn btn-sm btn-default btn-case-count" href="{{route('backend.cases.byJaksa', [$jaksa->id])}}"><span class="label label-info">{{ $jaksa['active_cases_count'] }}</span> Kasus Aktif</a>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>

<div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>
@stop

@section('script-end')
    @parent
    <script>
        $(function(){
            var $modal = $('#ajax-modal');
            $(document).on('click', '.btn-case-count', function(e){
                e.preventDefault();

                // create the backdrop and wait for next modal to be triggered
                $('body').modalmanager('loading');

                $modal.load($(this).attr('href'), '', function(){
                    $modal.modal();
                });
            });
        });
    </script>
@stop
