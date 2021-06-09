@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">SAW</h4>
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
                        <a href="#">SAW</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">List Kriteria</h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('saw.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kriteria / <br /> Alternatif</th>
                                                @foreach ($kriterias as $kriteria)
                                                    <th>{{ $kriteria->name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($alternatifs as $alternatif)
                                                <tr>
                                                    <td>{{ $alternatif->name }}</td>
                                                    @foreach ($kriterias as $kriteria)
                                                        <td>
                                                            <div class="form-group">
                                                                <input class="form-control"
                                                                    name="saw[{{ $alternatif->id }}][{{ $kriteria->id }}]"
                                                                    style="width:100px">
                                                            </div>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style="width: 200px">
                                    <i class="fas fa-spinner"></i>
                                    Hitung
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection