@extends('layouts.main')

@section('title')
    Konferencijos sukūrimas arba jos informacijos redagavimas
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('/css/bootstrap-material-datetimepicker.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                            <h4 class="card-title text-uppercase">Sukurkite ar redaguokite konferenciją</h4>
                            <p class="card-description">Konferencijos sukūrimas arba jos informacijos redagavimas</p>
                            <form class="forms-sample" action="{{ route('conference.edit') }}" method="POST">
                                @csrf <!-- {{ csrf_field() }} -->
                                <input style="display: none" name="id" value="{{ $id }}" >
                                <div class="form-group">
                                    <label for="audience_id">Konferencijos patalpa</label>
                                    <select class="form-control" id="audience_id" name="audience_id">
                                        @if($audiences)
                                            <option value="0" {{ old('audience_id') == 0 ? 'selected' : '' }}>Šiuo metu nėra galimų jokių konferencijos patalpų</option>
                                        @endif
                                        @foreach($audiences as $audience)
                                            <option value="{{ $audience->id }}" {{ old('audience_id') == $audience->id ? 'selected' : ($conference ? ($conference->audience_id == $audience->id ? 'selected' : '') : '') }}>
                                                (#{{$audience->id}}) {{ $audience->place_name }} (Galimos vietos : {{ $audience->max_capacity }}) (Projektorius : {{ $audience->has_projector ? "YRA" : "NĖRA" }}, garso kolonėlės : {{ $audience->has_speakers ? "YRA" : "NĖRA" }}, lenta : {{ $audience->has_board ? "YRA" : "NĖRA" }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Konferencijos pavadinimas</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old() ? old('name') : ($conference ? $conference->name : '') }}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="start_time">Konferencijos pradžios laikas</label>
                                        <input type="text" class="form-control" id="start_time" name="start_time" value="{{ old() ? old('start_time') : ($conference ? $conference->start_time : '') }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="end_time">Konferencijos pabaigos laikas</label>
                                        <input type="text" class="form-control" id="end_time" name="end_time" value="{{ old() ? old('end_time') : ($conference ? $conference->end_time : '') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="capacity">Konferencijos vietų skaičius</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old() ? old('capacity') : ($conference ? $conference->capacity : '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="speech_capacity">Konferencijos pranešimų skaičius</label>
                                    <input type="number" class="form-control" id="speech_capacity" name="speech_capacity" value="{{ old() ? old('speech_capacity') : ($conference ? $conference->speech_capacity : '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="speech_time">Pranešimui skirtas laikas (min.)</label>
                                    <input type="number" class="form-control" id="speech_time" name="speech_time" value="{{ old() ? old('speech_time') : ($conference ? $conference->speech_time : '') }}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="break_time_start">Pagrindinės pertraukos pradžios laikas</label>
                                        <input type="text" class="form-control" id="break_time_start" name="break_time_start" value="{{ old() ? old('break_time_start') : ($conference ? $conference->break_time_start : '') }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="break_time_end">Pagrindinės pertraukos pabaigos laikas</label>
                                        <input type="text" class="form-control" id="break_time_end" name="break_time_end" value="{{ old() ? old('break_time_end') : ($conference ? $conference->break_time_end : '') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="cafe_time_start">Kavos pertraukėlės pradžios laikas</label>
                                        <input type="text" class="form-control" id="cafe_time_start" name="cafe_time_start" value="{{ old() ? old('cafe_time_start') : ($conference ? $conference->cafe_time_start : '') }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="cafe_time_end">Kavos pertraukėlės pabaigos laikas</label>
                                        <input type="text" class="form-control" id="cafe_time_end" name="cafe_time_end" value="{{ old() ? old('cafe_time_end') : ($conference ? $conference->cafe_time_end : '') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2" id="register">@if($id) Redaguoti @else Sukurti @endif</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ url('/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $('#start_time').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('#end_time').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('#break_time_start').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('#break_time_end').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('#cafe_time_start').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('#cafe_time_end').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });
        });
    </script>
@endsection
