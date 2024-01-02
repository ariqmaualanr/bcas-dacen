<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        // Ganti API_KEY dengan API key Anda dari OpenWeatherMap
        $apiKey = 'API_KEY';

        // Lokasi cuaca yang ingin Anda tampilkan (contoh: Jakarta)
        $city = 'Jakarta';

        // Permintaan ke OpenWeatherMap API
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey");

        // Decode data JSON yang diterima
        $data = $response->json();

        // Parsing data cuaca yang Anda butuhkan dari $data

        return view('home', compact('weatherData'));
    }
}
