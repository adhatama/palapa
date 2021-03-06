<table class="table table-slider-heading">
    <thead>
    <tr>
        <td width='3%'>&nbsp;</td>
        <td width='10%'>Tanggal</td>
        <td width='20%'>Nama Tersangka</td>
        <td width='20%'>Kasus/Pasal</td>
        <td width='30%'>Agenda</td>
        <td width='17%'>Jaksa Penuntut Umum</td>
    </tr>
    </thead>
</table>

<div id="slider">
    <div id="items-slider">
        <ul>
            @foreach($items as $key => $item)
                @if($item->cases)
                    <li>
                        <div class="item">
                            <table class="table table-slider-items">
                                <tr class='item'>
                                    <td width="3%" class="numbering">
                                        <h1 class="label label-default">{{ $key + 1 }}</h1>
                                    </td>
                                    <td width='10%'>
                                        <span class="date">{{$item['date_for_human']}}</span>
                                    </td>
                                    <td width='20%'>
                                        {{$item->cases->suspectNames()}}
                                    </td>
                                    <td width='20%'>
                                        {{$item->cases->kasus}}/{{$item->cases->pasal}}
                                    </td>
                                    <td width='30%'>
                                        {{ $item['agenda'] }}
                                    </td>
                                    <td width='17%'>
                                        {{$item->cases['jaksa_name']}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

@section('script-end')
    @parent
    <script src="{{ asset('vendor/jquery.vticker.js') }}"></script>

    <script>
        $(function () {
            $('#items-slider').vTicker({
                speed: 500,
                pause: {{ Config::get('slide.interval') }},
                animation: 'fade',
                mousePause: false,
                showItems: 8
            });
        });
    </script>
@stop
