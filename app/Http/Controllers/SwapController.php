<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwapController extends Controller
{
    
    public function swap() {

        // set API Endpoint and access key (and any options of your choice)
        $endpoint = 'live';
        $access_key = 'ced90a5eb5f39dd9fb37d76b10d6fbd9';

        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);

        $from = 'USD';
        $to = 'UAH';

        $value = $from . $to;
       
        // dd($exchangeRates['quotes'][$value]);

        return $exchangeRates['quotes'][$value];

    }

}
