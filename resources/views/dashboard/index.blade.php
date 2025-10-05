@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">📊 Dashboard</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Penduduk</h5>
                    <h3>{{ $totalPenduduk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">KK</h5>
                    <h3>{{ $totalKk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Mutasi</h5>
                    <h3>{{ $totalMutasi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Surat</h5>
                    <h3>{{ $totalSurat }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
