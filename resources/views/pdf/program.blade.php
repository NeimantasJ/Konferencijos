<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Programa</title>
    <style>
        .center {
            text-align: center;
        }
        td {
            font-size: 12px;
            padding: 5px;
            height: 30px;
        }
        table {
            page-break-inside:auto;
        }
        tr {
            page-break-inside:avoid;
            page-break-after: always;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
</head>
<body>
    <div class="center">
        <h2>{{ $conference->name }}</h2>
        <h3>Organizatorius : {{ $conference->organisator->name }}</h3>
    </div>
    <h5>Vieta : <i>{{ $conference->audience->place_name }}</i></h5>
    <h5>Vietų skaičius : <i>{{ $conference->capacity }}</i></h5>
    <h5>Užsiregistravusių : <i>{{ count($conference->registration) }}</i></h5>
    <div class="center">
        <h2>Programa</h2>
    </div>
    <div>
        <table autosize="1" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #bcbcbc; border-left: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; width: 100%;">
            <tr>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; max-width: 120px;">Pranešimo pavadinimas</td>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 110px">Sekcija</td>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 110px">Pranešėjas</td>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 130px">Pradžios laikas</td>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 130px">Pabaigos laikas</td>
            </tr>
            @php
                $cafetime = false;
                $breaktime = false;
            @endphp
            @foreach($speeches as $speech)
                @if($speech->end_time >= $conference->break_time_start && !$breaktime)
                    <tr>
                        <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;" colspan="3">Pagrindinė pertrauka</td>
                        <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->break_time_start }}</td>
                        <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->break_time_end }}</td>
                    </tr>
                    @php
                        $breaktime = true;
                    @endphp
                @endif
                @if($speech->end_time >= $conference->cafe_time_start && !$cafetime)
                    <tr>
                        <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;" colspan="3">Kavos pertraukėlė</td>
                        <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->cafe_time_start }}</td>
                        <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->cafe_time_end }}</td>
                    </tr>
                    @php
                        $cafetime = true;
                    @endphp
                @endif
                <tr>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $speech->title }}</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;"><b>{{ $speech->category->name }}</b></td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $speech->speaker->name }}</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $speech->start_time }}</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $speech->end_time }}</td>
                </tr>
            @endforeach
            @if(!$breaktime)
                <tr>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;" colspan="3">Pagrindinė pertrauka</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->break_time_start }}</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->break_time_end }}</td>
                </tr>
                @php
                    $breaktime = true;
                @endphp
            @endif
            @if(!$cafetime)
                <tr>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;" colspan="3">Kavos pertraukėlė</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->cafe_time_start }}</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $conference->cafe_time_end }}</td>
                </tr>
                @php
                    $cafetime = true;
                @endphp
            @endif
        </table>
    </div>
    <div class="center">
        <h2>Dalyviai</h2>
    </div>
    <div>
        <table autosize="1" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #bcbcbc; border-left: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; width: 100%;">
            <tr>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 40px;">#ID</td>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 150px">Vardas Pavardė</td>
                <td align="center" valign="middle" style="font-weight: bold; border-right: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; background-color: #dcdcdc; width: 150px">El. Paštas</td>
            </tr>
            @php
                $id = 1;
            @endphp
            @foreach($participants as $participant)
                <tr>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $id }}</td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;"><b>{{ $participant->user->name }}</b></td>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;">{{ $participant->user->email }}</td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach
            @if(count($participants) == 0)
                <tr>
                    <td align="left" valign="middle" style="border-right: 1px solid #bcbcbc; border-bottom: 1px solid #dcdcdc;" colspan="3">Dalyvių nėra</td>
                </tr>
            @endif
        </table>
    </div>
</body>
</html>
