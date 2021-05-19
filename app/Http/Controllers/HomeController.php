<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Carbon\Carbon;

class HomeController extends Controller{
    /**
     * Global variable for api key.
     * 
     * @var string
     */
    protected static $API_KEY = "ed2648c19a956f69fa4573437eb4ef7e";

    /**
     * Show the application index view.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $cities = City::all();

        return view('index', compact('cities'));
    }

    /**
     * Fetches the weather on the basis of city.
     * 
     * @param Illuminate\Http\Request - $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fetchWeather(Request $request){
        $request->validate(['city' => 'required|string|max:255']);

        $api_url = "http://api.openweathermap.org/data/2.5/weather?q=$request->city&lang=en&units=metric&APPID=". self::$API_KEY;
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        curl_close($curl);

        $weather = json_decode($response);

        if($weather->cod == 200){
            $weather = [
                'date' => Carbon::now()->day,
                'month' => Carbon::now()->englishMonth,
                'title' => $weather->weather[0]->main,
                'icon' => $weather->weather[0]->icon,
                'temp' => $weather->main->temp,
                'feels' => $weather->main->feels_like,
                'humidity' => $weather->main->humidity,
                'pressure' => $weather->main->pressure,
                'wind' => $weather->wind->speed,
                'city' => $weather->name,
                'country' => $weather->sys->country
            ];
    
            return response()->json($weather, 200);
        } else{
            return response()->json(['msg' => 'We are sorry, the weather for your required city could not be found!'], 404);
        }
    }
}