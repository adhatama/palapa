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
                    <div class="panel-heading"><i class="icon ion-ios-information"></i> Info Kasus</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal section-info mb-lg">
                            <dt>No SPDP :</dt>
                            <dd>{{ $case['spdp_number'] }}</dd>
                            <dt>Kasus :</dt>
                            <dd>{{ $case['name'] }}</dd>
                            <dt>Pasal :</dt>
                            <dd>{{ nl2br($case['pasal']) }}</dd>
                            <dt>Penyidik :</dt>
                            <dd>{{ $case['penyidik_name'] }}</dd>

                            <dt>Jaksa :</dt>
                            <dd>{{ $case['prosecutor_name'] }}</dd>
                            <dt>Staff Administrasi :</dt>
                            <dd>{{ $case['staff_name'] }}</dd>
                            <dt>Usia Kasus :</dt>
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

                <div class="panel panel-default">
                    <div class="panel-heading"><i class="icon ion-ios-body"></i> Tersangka</div>
                    <table class="table">
                        <tbody>
                        @forelse($suspects as $suspect)
                            <tr>
                                <td>{{ $suspect['name'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Data tersangka belum tersedia</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><i class="icon ion-ios-shuffle-strong"></i> Riwayat</div>
                    <table class="table">
                        <tbody>
                        @forelse($activities as $history)
                            <tr>
                                <td>{{ $history['name'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>Riwayat kasus belum tersedia</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>