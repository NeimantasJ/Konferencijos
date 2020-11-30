@extends('layouts.main')

@section('title')
    Registracija į konferenciją
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
                        <div class="col-sm-12">
                            <h4 class="card-title">Registruotis į konferenciją</h4>
                            <p class="card-description">Suveskite žemiau esamus duomenis ir užsiregistruokite į konferenciją</p>
                            <form class="forms-sample" action="{{ route('register.store') }}" method="POST">
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-group">
                                    <label for="place_name">Konferencijos pavadinimas</label>
                                    <select class="form-control" id="conference" name="conference">
                                        @if(count($conferences) == 0)
                                            <option value="0" {{ old('conference') == 0 ? 'selected' : '' }}>Šiuo metu nevyksta jokios konferencijos</option>
                                        @endif
                                        @foreach($conferences as $conference)
                                            <option value="{{ $conference->id }}" {{ old('conference') == $conference->id ? 'selected' : '' }}>(#{{$conference->id}}) {{ $conference->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2" id="register">Registruotis</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
