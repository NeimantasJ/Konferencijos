@extends('layouts.main')

@section('title')
    Vykstančios Konferencijos
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
                            <h4 class="card-title center m-2">Vykstančios konferencijos</h4>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->type > 2)
                            <div class="col-sm-3">
                                <a class="btn btn-primary float-right m-2" href="{{ url('/editConference/0') }}">Pridėti konferenciją</a>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Konferencijos patalpa</th>
                                    <th>Pavadinimas</th>
                                    <th>Pradžios laikas</th>
                                    <th>Pabaigos laikas</th>
                                    <th>Užimtos | Visos</th>
                                    <th>Veiksmai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($conferences) > 0)
                                    @foreach($conferences as $conference)
                                        <tr>
                                            <td class="py-1">{{ $conference->id }}</td>
                                            <td class="py-1">{{ $conference->audience }}</td>
                                            <td>{{ $conference->name }}</td>
                                            <td>{{ \App\Http\Controllers\Functions::numberToMonth($conference->start_time) }}</td>
                                            <td>{{ \App\Http\Controllers\Functions::numberToMonth($conference->end_time) }}</td>
                                            <td>{{ $conference->registered }} | {{ $conference->capacity }}</td>
                                            <td>
                                                <a class="btn btn-warning" alt="Programa" href="{{ url('/printProgram/' . $conference->id) }}"><i class="fa fa-print"></i></a>
                                                @if(\Illuminate\Support\Facades\Auth::user()->type > 1)
                                                    <a class="btn btn-info" alt="Registruotis kaip pranešėjas" href="{{ url('/registerSpeech/' . $conference->id) }}"><i class="fa fa-plus"></i></a>
                                                @endif
                                                @if($conference->created_by == \Illuminate\Support\Facades\Auth::id() || \Illuminate\Support\Facades\Auth::user()->type > 2)
                                                    <a class="btn btn-primary" alt="Redaguoti pap. informaciją" href="{{ url('/editConferenceProgram/' . $conference->id) }}"><i class="fa fa-list"></i></a>
                                                    <a class="btn btn-success" alt="Redaguoti konferenciją" href="{{ url('/editConference/' . $conference->id) }}"><i class="fa fa-pencil"></i></a>
                                                    <a class="btn btn-danger deleteConference" data-id="{{ $conference->id }}" alt="Ištrinti konferenciją"><i style="color: white;" class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Šiuo metu dar nėra jokių konferencijų</td>
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

@section('script')
    <script>
        $( document ).ready(function() {
            $(".deleteConference").on('click', function () {
                var id = $(this).data("id");

                if(confirm("Ar tikrai norite ištrinti šią konferenciją?")) {
                    window.location.replace( "{{ url('/deleteConference') }}/" + id);
                }
            })
        });
    </script>
@endsection
