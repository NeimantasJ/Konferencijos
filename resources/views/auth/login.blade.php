@extends('layouts.main')

@section('title')
    Prisijungimas ir registracija
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
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Prisijungti</h4>
                    <p class="card-description">Prisijungti jau prie esamos paskyros</p>
                    <form class="forms-sample" action="{{ route('login') }}" method="POST">
                        @csrf <!-- {{ csrf_field() }} -->
                        <div class="form-group">
                            <label for="login_email">El. pašto adresas</label>
                            <input type="email" class="form-control" id="login_email" name="email" placeholder="El. pašto adresas" value="{{ old() ? old('email') : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="login_password">Slaptažodis</label>
                            <input type="password" class="form-control" id="login_password" name="password" placeholder="Slaptažodis">
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" name="login_remember" class="form-check-input">Prisiminti mane <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" id="login_button"> Prisijungti </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Registracija</h4>
                    <p class="card-description">Registruotis kaip dalyvis arba pranešėjas</p>
                    <form class="forms-sample" action="{{ route('register') }}" method="POST">
                        @csrf <!-- {{ csrf_field() }} -->
                        <div class="form-group">
                            <label for="register_name">Vardas pavardė</label>
                            <input type="text" class="form-control" id="register_name" name="name" placeholder="Vardas pavardė">
                        </div>
                        <div class="form-group">
                            <label for="register_email">El. pašto adresas</label>
                            <input type="email" class="form-control" id="register_email" name="email" placeholder="El. pašto adresas">
                        </div>
                        <div class="form-group">
                            <label for="password">Slaptažodis</label>
                            <input type="password" class="form-control" id="register_password" name="password" placeholder="Slaptažodis">
                        </div>
                        <div class="form-group">
                            <label for="repeat_password">Pakartoti slaptažodį</label>
                            <input type="password" class="form-control" id="register_repeat_password" name="password_confirmation" placeholder="Pakartoti slaptažodį">
                        </div>
                        <div class="form-group">
                            <label>Vartotojo tipas</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type" value="1" id="register_participant" checked>Dalyvis<i class="input-helper"></i></label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type" value="2" id="register_speaker">Pranešėjas<i class="input-helper"></i></label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="type" value="3" id="register_speaker">Organizatorius<i class="input-helper"></i></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" id="register_button">Registruotis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
