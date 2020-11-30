@extends('layouts.main')

@section('title')
    Galimos auditorijos
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
                            <h4 class="card-title center m-2">Galimos auditorijos</h4>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->type > 3)
                            <div class="col-sm-3">
                                <a class="btn btn-primary float-right m-2" href="{{ url('/editAudience/0') }}">Pridėti auditoriją</a>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Pavadinimas</th>
                                    <th>Vietų skaičius</th>
                                    <th>Turi projektorių</th>
                                    <th>Turi kolonėles</th>
                                    <th>Turi lentą</th>
                                    <th>Veiksmai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($audiences) > 0)
                                    @foreach($audiences as $audience)
                                        <tr>
                                            <td class="py-1">{{ $audience->id }}</td>
                                            <td>{{ $audience->place_name }}</td>
                                            <td>{{ $audience->max_capacity }}</td>
                                            <td>@if($audience->has_projector) Taip @else Ne @endif</td>
                                            <td>@if($audience->has_speakers) Taip @else Ne @endif</td>
                                            <td>@if($audience->has_board) Taip @else Ne @endif</td>
                                            <td>
                                                @if(\Illuminate\Support\Facades\Auth::user()->type > 3)
                                                    <a class="btn btn-success" alt="Redaguoti auditoriją" href="{{ url('/editAudience/' . $audience->id) }}"><i class="fa fa-pencil"></i></a>
                                                    <a class="btn btn-danger deleteAudience" data-id="{{ $audience->id }}" alt="Ištrinti auditoriją"><i style="color: white;" class="fa fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Šiuo metu dar nėra jokių auditorijų</td>
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
            $(".deleteAudience").on('click', function () {
                var id = $(this).data("id");

                if(confirm("Ar tikrai norite ištrinti šią auditoriją?")) {
                    window.location.replace( "{{ url('/deleteAudience') }}/" + id);
                }
            })
        });
    </script>
@endsection
