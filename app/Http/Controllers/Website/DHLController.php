<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use App\Models\DHL;
use App\Models\Attribute;
use Illuminate\Http\Request;

class DHLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $endpoint = "https://api-eu.dhl.com/track/shipments";
        $client = new \GuzzleHttp\Client();
        $id =7777777770;
        $value = "ABC";
        
        $headers = array('application/json', 'DHL-API-Key' => 'g5dgyk23tdKv68SigzCIa9a6bRPt7TdU');
        // $client->setDefaultOption('headers', array('Accept' => ));
        $response = $client->request('GET', $endpoint, ['query' => [
            'trackingNumber' => $id,
            'headers' => $headers,
        ]]);
        
        // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        
        return $content;
        // or when your server returns json
        // $content = json_decode($response->getBody(), true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api-eu.dhl.com/track/shipments");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['content-type'=>'application/json','DHL-API-Key'=>'lDGMG08nxLicn0qs1A5xyoIdw6ZjCl2f']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['trackingNumber'=> '7777777770','service'=>'express','content-language'=>'en','offset=0','limit=5']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res= json_decode($responseData);
        return response()->json($res);
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
