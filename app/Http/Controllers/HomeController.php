<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cookie;
use GuzzleHttp\Client;
use App\Consts;
use Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class HomeController extends Controller
{
    public function __construct()
    {
        
    }

    public function home(Request $request)
    {
        $this->authentication();
        $cache = (array) json_decode(Cache::get('data_home'), true);
        $data = $cache['token']['user'];
        return view('index', ['data' => $data]);
    }

    public function getListServer()
    {
        $token = Session::get('USER_TOKEN');
        try {
            $client = new Client([
                'headers' => [ 
                        'Content-Type' => 'application/json',
                        'X-Auth-Token' => $token
                    ]
            ]);
            $request = $client->get(Consts::URL_SERVERS);
            $response = $request->getBody()->getContents();
            Log::info($response);
            $servers = json_decode($response, true);
            $cache = (array) json_decode(Cache::get('data_home'), true);
            $data = $cache['token']['user'];
            Log::info($servers);
        } catch(Exception $e) {
            Log::info($e);
            return back()->with(json_encode($e));
        }
        return view('layouts.servers', ['data' => $data, 'servers' => $servers]);
    }

    public function authentication()
    {
        if( !Session::has("USER_TOKEN") ) {
            redirect()->route('login')->send();
        }
    }
    public function login()
    {
        if( Session::has("USER_TOKEN") ) {
            redirect()->route('home')->send();
        }
        return view('layouts.login');
    }

    public function accessLogin(Request $request)
    {
        try {
            $dataArr = $this->getArr($request);
            $client = new Client([
                'headers' => [ 'Content-Type' => 'application/json' ]
            ]);
            $req = $client->post(Consts::URL_LOGIN, [ 'body' => json_encode($dataArr) ]);
            $response = $req->getBody()->getContents();
            $header = $req->getHeaders();
            Cache::put('data_home', $response, Consts::DAYS);
            Session::put('USER_TOKEN', $header['X-Subject-Token'][0], 360);
        } catch (Exception $e) {
            return back()->with($e);
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        Session::forget('USER_TOKEN');
        Cache::forget('data_home');
        return redirect()->route('login');
    }
    public function getArr($request)
    {
        $arr = [
                  'auth' => 
                    ['identity' => 
                        ['methods' => 
                            [ 0 => 'password',
                        ],
                    'password' => 
                        ['user' => 
                            [ 'name' => $request['name'],
                              'domain' => ['name' => 'Default'],
                              'password' => $request['pass'],
                            ],
                        ],
                    ],
                    'scope' => 
                        [ 'project' => 
                            [ 'name' => 'admin',
                              'domain' => [ 'name' => 'Default'],
                            ],
                        ],
                    ],
                ];
        return $arr;
    }
}
