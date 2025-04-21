<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function fetchCities(){

        try{

            $json = Storage::get('city.list.json');

            return json_decode($json,true);

        }catch(\Exception $e){
            return redirect()->to('/')->with('error', $e->getMessage());
        }
    }

    public function searchCities(Request $request){

        try{

            $q= strtolower($request->input('q', ''));
           $cities = $this->fetchCities();

           $results = collect($cities)
               ->filter(function($city) use ($q) {
                   return str_contains(strtolower($city['name']), $q);
               })->take(20)
               ->map(fn($city) => [
                   'text' => $city['name'],
                   'id' => [$city['name'].'-'.$city['country']],
               ])
               ->values();

            return response()->json(['results' => $results]);


        }catch(\Exception $e){
            return redirect()->to('/')->with('error', $e->getMessage());
        }
    }

}
