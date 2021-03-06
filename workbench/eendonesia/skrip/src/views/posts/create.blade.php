@extends('layouts.admin.admin')

@section('style-head')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/redactor/redactor.css') }}" />
@stop

@section('content-admin')
    <div class="container-fluid">
        <h2 class="page-title">Tambah Halaman Informasi</h2>
        {{ BootForm::open()->action(route('skrip.posts.store')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="position" value="{{ Input::get('position') }}"/>
            {{ BootForm::text('Title', 'title') }}
            {{ BootForm::textarea('Content', 'content', ['id' => 'content']) }}
            {{ BootForm::select('Status', 'status')->options($post->getPossibleStatus()) }}
            {{ BootForm::submit('Simpan', 'btn-primary') }}
        {{ BootForm::close() }}
    </div>
@stop

@section('script-end')
    @parent
    <script src="{{ asset('vendor/redactor/redactor.min.js') }}"></script>
    <script src="{{ asset('vendor/redactor/plugins/table.js') }}"></script>
    <script src="{{ asset('vendor/redactor/plugins/fullscreen.js') }}"></script>
    <script>

        $(function()
        {
            $('#content').redactor({
                minHeight: 400,
                buttonSource: true,
                plugins: ['table', 'fullscreen'],
                imageUpload: '/skrip/uploadImage?_token={{ csrf_token() }}',
            });
        });
    </script>
@stop
