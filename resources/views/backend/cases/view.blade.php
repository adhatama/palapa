<!-- Modal -->
<div class="modal fade modal-case-info" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                                class="fa fa-times"></i></span></button>
                <h2 class="modal-title mb-0">{{ $case['name'] }}</h2>
            </div>
            <div class="modal-body">

                <div class="panel panel-default">
                    <div class="panel-heading"><i class="icon ion-ios-information"></i> Info</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal section-info mb-lg">
                            <dt>No SPDP :</dt>
                            <dd>{{ $case['spdp_number'] }}</dd>
                            <dt>Perkara :</dt>
                            <dd>{{ $case['name'] }}</dd>
                            <dt>Tempat Kejadian  :</dt>
                            <dd>{{ $case['crime_place'] }}</dd>
                            <dt>Waktu Kejadian :</dt>
                            <dd>{{ $case['crime_time_for_human'] }}</dd>
                            <dt>Pasal :</dt>
                            <dd>{{ nl2br($case['pasal']) }}</dd>
                            <dt>Penyidik :</dt>
                            <dd>{{ $case['penyidik_name'] }}</dd>

                            <dt>Jaksa :</dt>
                            <dd>{{ $case['prosecutor_name'] }}</dd>
                            <dt>Staff Administrasi :</dt>
                            <dd>{{ $case['staff_name'] }}</dd>
                            <dt>Usia Perkara :</dt>
                            <dd>
                                @if($case['age'] === false)
                                    <span class="label label-default">{{ $case['status'] }}</span>
                                @else
                                    @if($case['age'] == 0)
                                        <span class="label label-success">Didaftarkan Hari Ini</span>
                                    @else
                                        {{ $case['age'] }} hari
                                    @endif
                                @endif
                            </dd>
                            <dt>Status :</dt>
                            <dd><span class="label label-default">{{ $case['status_name'] }}</span></dd>
                        </dl>
                    </div>
                </div>

                <div class="panel panel-default panel-tersangka">
                    <div class="panel-heading"><i class="icon ion-ios-body"></i> Tersangka</div>
                    <table class="table">
                        <tbody class="items">
                        @forelse($suspects as $suspect)
                            <tr>
                                <td>{{ $suspect['sex_icon'] }} {{ $suspect['name'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Data tersangka belum tersedia</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel panel-default panel-tersangka">
                    <div class="panel-heading"><i class="icon ion-eye"></i> Saksi</div>
                    <table class="table">
                        <tbody class="items">
                        @forelse($witness as $person)
                            <tr>
                                <td>{{ $person['sex_icon'] }} {{ $person['name'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Data saksi belum tersedia</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><i class="icon ion-ios-shuffle-strong"></i> Riwayat</div>
                    <table class="table">
                        <tbody>
                        @forelse($activities as $item)
                            <tr>
                                <td width="180px"><small class="text-muted">{{ $item['date'] }}</small></td>
                                <td>
                                    <strong>{{ $item['name'] }}</strong>
                                    @if($item['number'])
                                        <div class="text-muted">Nomor: {{ $item['number'] }}</div>
                                    @endif
                                    <p>{{ $item['note'] }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Riwayat kasus belum tersedia</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>