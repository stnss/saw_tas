@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Hasil</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('main') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('saw.index') }}">SAW</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Hasil</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Ranking Alternatif</div>
                                <div class="card-tools">
                                    <form action="{{ route('saw.pdf') }}" method="post" style="display: inline-block">
                                        @csrf
                                        <input type="hidden" name="tahun" value="{{ $tahun }}" />
                                        @foreach ($data['ranking'] as $item)
                                            <input type="hidden" name="data[{{ $loop->index }}][name]" value="{{ $item['nama'] }}" />
                                            <input type="hidden" name="data[{{ $loop->index }}][sum]" value="{{ $item['sum'] }}" />
                                        @endforeach
                                        <button type="submit" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                            <span class="btn-label">
                                                <i class="far fa-file-pdf"></i>
                                            </span>
                                            Pdf
                                        </button>
                                    </form>
                                    {{-- <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                        <span class="btn-label">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        Print
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ranking</th>
                                            <th>Nama Kriteria</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['ranking'] as $ranking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ranking['nama'] }}</td>
                                                <td>{{ $ranking['sum'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Ranking</th>
                                            <th>Nama Kriteria</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Nilai Perbandingan</h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kriteria / <br /> Alternatif</th>
                                            @foreach ($data['data'] as $d)
                                                @foreach ($d as $idKri => $val)
                                                    <th>{{ \App\Models\Kriteria::where('id', $idKri)->first()->name }}</th>
                                                @endforeach
                                                @break
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['data'] as $idAlt => $d)
                                            <tr>
                                                <td>{{ \App\Models\Alternatif::where('id', $idAlt)->first()->name }}</td>
                                                @foreach ($d as $valKriteria)
                                                    <td>
                                                        {{ $valKriteria }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Matriks Normalisasi</h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kriteria / <br /> Alternatif</th>
                                            @foreach ($data['normalisasi'] as $d)
                                                @foreach ($d as $idKri => $val)
                                                    <th>{{ \App\Models\Kriteria::where('id', $idKri)->first()->name }}</th>
                                                @endforeach
                                                @break
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['normalisasi'] as $idAlt => $d)
                                            <tr>
                                                <td>{{ \App\Models\Alternatif::where('id', $idAlt)->first()->name }}</td>
                                                @foreach ($d as $valKriteria)
                                                    <td>
                                                        {{ $valKriteria }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
