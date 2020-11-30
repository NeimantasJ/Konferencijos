@extends('layouts.main')

@section('title')
    Redaguoti papildomą konferencijos informaciją
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
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="card-title center m-2">Konferencijos sekcijos</h4>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Pavadinimas</th>
                                <th>Pirmininkas</th>
                                <th>Pradžios laikas</th>
                                <th>Pabaigos laikas</th>
                                <th>Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="py-1">{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->leader->name }}</td>
                                        <td>{{ date_format( new Datetime($category->start_time), "H:i:s") }}</td>
                                        <td>{{ date_format( new Datetime($category->end_time), "H:i:s") }}</td>
                                        <td>
                                            <a class="btn btn-success editCategory" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-leader_id="{{ $category->leader->id }}" data-start_time="{{ $category->start_time }}" data-end_time="{{ $category->end_time }}" alt="Redaguoti konferenciją" style="color: white"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger deleteCategory" data-id="{{ $category->id }}" alt="Ištrinti konferenciją"><i style="color: white;" class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Šiuo metu dar nėra jokių sekcijų</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="card-title text-uppercase">Redaguoti sekciją</h4>
                            <p class="card-description">Redaguoti kategorijų, sekcijų informaciją</p>
                            <form class="forms-sample" action="{{ route('categories.edit') }}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                                <input style="display: none" id="conference_id" name="conference_id" value="{{ $id }}" >
                                <input style="display: none" id="category_id" name="category_id" value="{{ old('category_id') ? old('category_id') : '0' }}" >
                                <div class="form-group">
                                    <label for="leader_id">Pirmininkas</label>
                                    <select class="form-control" id="category_leader_id" name="leader_id">
                                        @if(!$users)
                                            <option value="0" {{ old('leader_id') == 0 ? 'selected' : '' }}>Šiuo metu nėra jokių užsiregistravusių pranešėjų</option>
                                        @endif
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('leader_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Sekcijos pavadinimas</label>
                                    <input type="text" class="form-control" id="category_name" name="name" value="{{ old() ? old('name') : '' }}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="start_time">Sekcijos pradžios laikas</label>
                                        <input type="text" class="form-control" id="category_start_time" name="start_time" value="{{ old() ? old('start_time') : '' }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="end_time">Sekcijos pabaigos laikas</label>
                                        <input type="text" class="form-control" id="category_end_time" name="end_time" value="{{ old() ? old('end_time') : '' }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Pridėti / Keisti</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="card-title center m-2">Pranešėjai</h4>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Pranešėjas</th>
                                <th>Sekcija</th>
                                <th>Tema</th>
                                <th>Pradžios laikas</th>
                                <th>Pabaigos laikas</th>
                                <th>Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($speeches) > 0)
                                @foreach($speeches as $speech)
                                    <tr>
                                        <td class="py-1">{{ $speech->id }}</td>
                                        <td>{{ $speech->speaker->name }}</td>
                                        <td>{{ $speech->category->name }}</td>
                                        <td>{{ $speech->title }}</td>
                                        <td>{{ date_format( new Datetime($speech->start_time), "H:i:s") }}</td>
                                        <td>{{ date_format( new Datetime($speech->end_time), "H:i:s") }}</td>
                                        <td>
                                            <a class="btn btn-success editSpeech" data-id="{{ $speech->id }}" data-category_id="{{ $speech->category_id }}" data-title="{{ $speech->title }}" data-start_time="{{ $speech->start_time }}" data-end_time="{{ $speech->end_time }}" alt="Redaguoti pranešimą" style="color: white"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger deleteSpeech" data-id="{{ $speech->id }}" alt="Ištrinti pranešimą"><i style="color: white;" class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Šiuo metu dar nėra jokių pranešimų</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="card-title text-uppercase">Redaguoti pranešimą</h4>
                            <p class="card-description">Redaguoti pranešimo pavadinimą ir laiką</p>
                            <form class="forms-sample" action="{{ route('speech.edit') }}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                                <input style="display: none" id="conference_id" name="conference_id" value="{{ $id }}" >
                                <input style="display: none" id="speech_id" name="speech_id" value="{{ old('speech_id') ? old('speech_id') : '' }}" >
                                <div class="form-group">
                                    <label for="category_id">Sekcijos pavadinimas</label>
                                    <select class="form-control" id="speech_category_id" name="category_id">
                                        @if(!$categories)
                                            <option value="0" {{ old('category_id') == 0 ? 'selected' : '' }}>Šiuo metu nėra jokių užsiregistravusių pranešėjų</option>
                                        @endif
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Pranešimo pavadinimas</label>
                                    <input type="text" class="form-control" id="speech_title" name="title" value="{{ old() ? old('title') : '' }}">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="start_time">Pranešimo pradžios laikas</label>
                                        <input type="text" class="form-control" id="speech_start_time" name="start_time" value="{{ old() ? old('start_time') : '' }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="end_time">Pranešimo pabaigos laikas</label>
                                        <input type="text" class="form-control" id="speech_end_time" name="end_time" value="{{ old() ? old('end_time') : '' }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2" id="edit_speech">Redaguoti</button>
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

            $('#category_start_time').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('#category_end_time').bootstrapMaterialDatePicker
            ({
                format: 'YYYY-MM-DD HH:mm:00',
                cancelText: 'Atšaukti',
                okText: 'Gerai',
                time: true,
                lang: "lt"
            });

            $('.editCategory').on('click', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var leader_id = $(this).data('leader_id');
                var start_time = $(this).data('start_time');
                var end_time = $(this).data('end_time');

                $('#category_id').val(id);
                $('#category_name').val(name);
                $('#category_leader_id').val(leader_id);
                $('#category_start_time').val(start_time);
                $('#category_end_time').val(end_time);
            });

            $('.deleteCategory').on('click', function () {
                var id = $(this).data("id");

                if(confirm("Ar tikrai norite ištrinti?")) {
                    window.location.replace("{{ action('CategoriesController@delete', ['']) }}" + "/" + id);
                }
            });

            if($('#speech_title').val() == "") {
                $('#edit_speech').prop('disabled', true);
            }

            $('.editSpeech').on('click', function () {
                var id = $(this).data('id');
                var category_id = $(this).data('category_id');
                var title = $(this).data('title');
                var start_time = $(this).data('start_time');
                var end_time = $(this).data('end_time');

                $('#speech_id').val(id);
                $('#speech_category_id').val(category_id);
                $('#speech_title').val(title);
                $('#speech_start_time').val(start_time);
                $('#speech_end_time').val(end_time);
                $('#edit_speech').prop('disabled', false);
            });

            $('.deleteSpeech').on('click', function () {
                var id = $(this).data("id");

                if(confirm("Ar tikrai norite ištrinti?")) {
                    window.location.replace("{{ action('SpeechController@delete', ['']) }}" + "/" + id);
                }
            });
        });
    </script>
@endsection
