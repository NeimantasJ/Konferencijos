<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Functions extends Controller
{
    public static function numberToMonth($date) {
        $split = explode('-', $date);
        $month = $split[1];
        $time = explode(':', $split[2]);
        switch ($month) {
            case "1" :
                $monthString = "Sausio";
                break;
            case "2" :
                $monthString = "Vasario";
                break;
            case "3" :
                $monthString = "Kovo";
                break;
            case "4" :
                $monthString = "Balandžio";
                break;
            case "5" :
                $monthString = "Gegužės";
                break;
            case "6" :
                $monthString = "Birželio";
                break;
            case "7" :
                $monthString = "Liepos";
                break;
            case "8" :
                $monthString = "Rugpjūčio";
                break;
            case "9" :
                $monthString = "Rugsėjo";
                break;
            case "10" :
                $monthString = "Spalio";
                break;
            case "11" :
                $monthString = "Lapkričio";
                break;
            case "12" :
                $monthString = "Gruodžio";
                break;
            default :
                break;
        };
        return $split[0] . " " . $monthString . " " . $time[0] . ':' . $time[1];
    }
}
