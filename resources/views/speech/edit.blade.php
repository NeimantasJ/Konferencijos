@extends('layouts.main')

@section('title')
    Registracija į konferenciją kaip pranešėjas
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
                            <h4 class="card-title text-uppercase">Registruotis kaip pranešėjas</h4>
                            <p class="card-description">Registracija į konferenciją kaip pranešėjas</p>
                            <form class="forms-sample" action="{{ route('speech.store') }}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                                <input style="display: none" name="id" value="{{ $id }}" >
                                <div class="form-group">
                                    <label for="time">Pasirinkite laisvą laiką</label>
                                    <select class="form-control" id="time" name="time">
                                        @if(!$times)
                                            <option value="0" {{ old('audience_id') == 0 ? 'selected' : '' }}>Nebėra laisvų laikų</option>
                                        @endif
                                        @foreach($times as $time)
                                            <option value="{{ $time->start_time }}|{{ $time->end_time }}" {{ old('time') == $time->start_time.'|'.$time->end_time ? 'selected' : '' }}>Nuo {{ date_format(new DateTime($time->start_time), "H:i:s") }}, iki {{ date_format(new DateTime($time->end_time), "H:i:s") }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Pasirinkite sekciją</label>
                                    <select class="form-control" id="category" name="category">
                                        @if(count($categories) == 0)
                                            <option value="0" {{ old('category') == 0 ? 'selected' : '' }}>Sekcijų nėra</option>
                                        @endif
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Pranešimo tema</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old() ? old('title') : '' }}">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2" id="register" @if(!$times || count($categories) == 0) dissabled @endif>Registruotis</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
