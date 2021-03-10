<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\Models\City;

class HumidityController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function return_humidity(Request $request)
    {   
        if ($request->has('city')){
    
            $city = City::findOrFail($request->city);
    
            try {
    
                $url = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
                $app_id =  config('services.weather-yahoo.app_id');
                $consumer_key =  config('services.weather-yahoo.client_id');
                $consumer_secret = config('services.weather-yahoo.client_secret');
                
                $query = array(
                    'location' => $city->name,
                    'format' => 'json',
                );
    
                $stack = HandlerStack::create();
    
                $middleware = new Oauth1([
                    'consumer_key'    => $consumer_key,
                    'consumer_secret' => $consumer_secret,
                    'oauth_signature_method' => Oauth1::SIGNATURE_METHOD_PLAINTEXT,
                    'token'           => null,
                    'token_secret'    => null
                ]);
    
                $stack->push($middleware);
    
                $client = new Client([
                    'handler' => $stack
                ]);
    
                $request = $client->get($url, ['auth' => 'oauth',  'query' => $query]);
                
                $response = json_decode($request->getBody(),true);
    
                return view('index',["data" => $response, 'cities' => City::with('country')->orderBy('name')->get()]); 
    
            } catch (\Throwable $th) {
        
                throw  new \ServiceUnavailableHttpException();   
    
            }

        }else{

            return view('index',['cities' => City::with('country')->orderBy('name')->get()]); 

        }
    }
}
