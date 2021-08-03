<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{

    /**
     * Show result of logic
     * params $Request
     * @return json
     */
    public function getFestival(Request $Request)
    {
        try //starting try block
        {
            $filterArray = $finalArray = []; // initilise required array variables
            $client = new \GuzzleHttp\Client();
            $apiBaseUri = Config('app.festival_base_uri'); //API base Uri
            $response = $client->request('GET', $apiBaseUri . '/codingtest/api/v1/festivals');
            if ($response->getStatusCode() == 200) //if response has 200 status
            
            {
                $responseData = json_decode($response->getBody()
                    ->getContents() , true); //json convert to array
                if (!empty($responseData) && count($responseData) > 0)
                {
                    foreach ($responseData as $data)
                    {
                        if (isset($data['bands']))
                        {
                            foreach ($data['bands'] as $brand)
                            {
                                if (isset($brand['recordLabel']))
                                {
                                    $level1 = (isset($brand['recordLabel'])) ? $brand['recordLabel'] : null; //store Level1 data
                                    $level2 = (isset($brand['name'])) ? $brand['name'] : null; //store Level2 data
                                    $level3 = (isset($data['name'])) ? $data['name'] : null;
                                    $filterArray[$level1][] = array(
                                        $level2 => array(
                                            $level3
                                        )
                                    ); //store Level3 data
                                    
                                }
                            }
                        }
                    }
                }
            }
            else
            { //if response has error
                return view('/content/festival', ['error' => 'Error: API response not succeed!']);
            }
            $i = 0;
            foreach ($filterArray as $ky => $result)
            {
                $finalArray[$i]['record_label'] = $ky;
                foreach ($result as $r)
                {
                    $lableName = key($r);
                    $finalArray[$i]['brand'][] = $lableName;
                    $finalArray[$i]['values'][$lableName] = $r[$lableName][0];
                }
                $i++; //increment key
                
            }
            $collection = collect($finalArray); //convert array to laravel collection
            return view('/content/festival', ['data' => $collection->sortBy('record_label') , 'error' => null]); //data passing to view
            
        }
        catch(\Exception $e)
        {
            return view('/content/festival', ['error' => $e->getMessage() ]);
        }
    }
}

