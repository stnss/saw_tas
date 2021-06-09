@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kriteria</h4>
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
                        <a href="{{ route('kriterias.index') }}">Kriteria</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add new Kriteria</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add new Kriteria</h4>

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
                        <form action="{{ route('kriterias.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="namaKriteria">Nama Kriteria</label>
                                            <input type="text" name="name" class="form-control form-control"
                                                id="namaKriteria" placeholder="Nama Kriteria" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="namaKriteria">Bobot Kriteria</label>
                                            <input type="text" name="bobot" class="form-control form-control"
                                                id="namaKriteria" placeholder="Nama Kriteria" value="{{ old('bobot') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="typeKriteria">Type Kriteria</label>
                                            <select name="type" class="form-control form-control" id="typeKriteria">
                                                <option value="Cost">Cost</option>
                                                <option value="Benefit">Benefit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
