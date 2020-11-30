@extends('layouts.main')

@section('title')
    Auditorijos sukūrimas arba jos informacijos redagavimas
@endsection

@section('content')
    @if(session('success'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success"> {{ session('success') }}</div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger"> {{ session('error') }}</div>
            </div>
        </div>
    @endif
    @if($errors->any())
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="card-title text-uppercase">Sukurkite ar redaguokite auditoriją</h4>
                            <p class="card-description">Auditorijos sukūrimas arba jos informacijos redagavimas</p>
                            <form class="forms-sample" action="{{ route('audience.edit') }}" method="POST">
                                @csrf <!-- {{ csrf_field() }} -->
                                <input style="display: none" name="id" value="{{ $id }}" >
                                <div class="form-group">
                                    <label for="place_name">Auditorijos pavadinimas</label>
                                    <input type="text" class="form-control" id="place_name" name="place_name" value="{{ old() ? old('place_name') : ($audience ? $audience->place_name : '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="max_capacity">Auditorijos vietų skaičius</label>
                                    <input type="number" class="form-control" id="max_capacity" name="max_capacity" value="{{ old() ? old('max_capacity') : ($audience ? $audience->max_capacity : '') }}">
                                </div>
                                <div class="form-group ml-4">
                                    <input type="checkbox" class="form-check-input" id="has_projector" name="has_projector" value="1" {{ old('has_projector') ? 'checked' : ($audience ? ($audience->has_projector == 1 ? 'checked' : '') : '') }}>
                                    <label class="form-check-label" for="has_projector">Turi projektorių</label>
                                </div>
                                <div class="form-group ml-4">
                                    <input type="checkbox" class="form-check-input" id="has_speakers" name="has_speakers" value="1" {{ old('has_speakers') ? 'checked' : ($audience ? ($audience->has_speakers == 1 ? 'checked' : '') : '') }}>
                                    <label class="form-check-label" for="has_speakers">Turi garsiakalbius</label>
                                </div>
                                <div class="form-group ml-4">
                                    <input type="checkbox" class="form-check-input" id="has_board" name="has_board" value="1" {{ old('has_board') ? 'checked' : ($audience ? ($audience->has_board == 1 ? 'checked' : '') : '') }}>
                                    <label class="form-check-label" for="has_board">Turi lentą</label>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2" id="register">@if($id) Redaguoti @else Pridėti @endif</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
