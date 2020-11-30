@extends('layouts.main')

@section('title')
    Visi vartotojai
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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="card-title center m-2">Visi vartotojai</h4>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Vardas</th>
                                <th>El. Paštas</th>
                                <th>Tipas</th>
                                <th>Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <td class="py-1">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if($user->type == 1) Dalyvis @elseif($user->type == 2) Pranešėjas @elseif($user->type == 3) Organizatorius @elseif($user->type == 4) Administratorius @endif</td>
                                        <td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->type > 3)
                                                <a class="btn btn-success" alt="Perkelti į dalyvio kategoriją" href="{{ url('/editUser/' . $user->id) .'/1' }}"><i class="fa fa-user"></i></a>
                                                <a class="btn btn-success" alt="Perkelti į pranešėjo kategoriją" href="{{ url('/editUser/' . $user->id) .'/2' }}"><i class="fa fa-microphone"></i></a>
                                                <a class="btn btn-success" alt="Perkelti į organizatoriaus kategoriją" href="{{ url('/editUser/' . $user->id) .'/3' }}"><i class="fa fa-group"></i></a>
                                                <a class="btn btn-success" alt="Perkelti į administratoriaus kategoriją" href="{{ url('/editUser/' . $user->id) .'/4' }}"><i class="fa fa-cog"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Šiuo metu dar nėra jokių vartotojų</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
