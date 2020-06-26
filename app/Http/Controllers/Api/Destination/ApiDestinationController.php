<?php

namespace App\Http\Controllers\Api\Destination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Destination;
use App\Gallery;
use App\Pulsa;
use App\Slider;
use App\Http\Resources\Destination\DestinationResource;
use App\Http\Resources\MuseumResource;
use Illuminate\Http\Response;
use DB;
use Carbon\Carbon;

class ApiDestinationController extends Controller
{
    public function index()
    {
        $Destination = Destination::get();

        return response()->json([  'data'=>$Destination ]);
    }
    
    public function pulsa()
    {
        $pulsa = Pulsa::orderBy('id', 'asc')->get();

        return response()->json([  'data'=>$pulsa ]);
    }

    

    public function museum()
    {
        $file_path = 'http://streamer.digitalindovisitama.com/uploads/';
        $jsonObj= array();
        $Destinations = Destination::where('category_id','=', 1)->orderBy('urutan', 'asc')->get();

            foreach($Destinations as $data)
        {
			
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
 			$row['detail'] = $data['detail'];
 			$row['phone'] = $data['phone'];
 			$row['price'] = $data['price'];
 			$row['image'] = $file_path.'destinations/'.$data['image'];
 			$row['gallery_image1'] = $file_path.'destinations/'.$data['gallery_image1'];
 			$row['gallery_image2'] = $file_path.'destinations/'.$data['gallery_image2'];
 			$row['gallery_image3'] = $file_path.'destinations/'.$data['gallery_image3'];
 			$row['gallery_image4'] = $file_path.'destinations/'.$data['gallery_image4'];
 			$row['gallery_image5'] = $file_path.'destinations/'.$data['gallery_image5'];
 			$row['address'] = stripslashes($data['address']);
 			$row['province'] = $data['province'];
 			$row['latitude'] = $data['latitude'];
            $row['longitude'] = $data['longitude'];
               
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }
    
     public function praying()
    {
        $file_path = 'http://streamer.digitalindovisitama.com/uploads/';
        $jsonObj= array();
        $Destinations = Destination::where('category_id','=', 2)->orderBy('urutan', 'asc')->get();

            foreach($Destinations as $data)
        {
			
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
 			$row['detail'] = $data['detail'];
 			$row['phone'] = $data['phone'];
 			$row['price'] = $data['price'];
 			$row['image'] = $file_path.'destinations/'.$data['image'];
 			$row['gallery_image1'] = $file_path.'destinations/'.$data['gallery_image1'];
 			$row['gallery_image2'] = $file_path.'destinations/'.$data['gallery_image2'];
 			$row['gallery_image3'] = $file_path.'destinations/'.$data['gallery_image3'];
 			$row['gallery_image4'] = $file_path.'destinations/'.$data['gallery_image4'];
 			$row['gallery_image5'] = $file_path.'destinations/'.$data['gallery_image5'];
 			$row['address'] = stripslashes($data['address']);
 			$row['province'] = $data['province'];
 			$row['latitude'] = $data['latitude'];
            $row['longitude'] = $data['longitude'];
               
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }


    

    

    public function restaurant()
    {
        $file_path = 'http://streamer.digitalindovisitama.com/uploads/';
        $jsonObj= array();
        $Destinations = Destination::where('category_id','=', 3)->orderBy('urutan', 'asc')->get();

            foreach($Destinations as $data)
        {
			
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
 			$row['detail'] = $data['detail'];
 			$row['phone'] = $data['phone'];
 			$row['price'] = $data['price'];
 			$row['image'] = $file_path.'destinations/'.$data['image'];
 			$row['gallery_image1'] = $file_path.'destinations/'.$data['gallery_image1'];
 			$row['gallery_image2'] = $file_path.'destinations/'.$data['gallery_image2'];
 			$row['gallery_image3'] = $file_path.'destinations/'.$data['gallery_image3'];
 			$row['gallery_image4'] = $file_path.'destinations/'.$data['gallery_image4'];
 			$row['gallery_image5'] = $file_path.'destinations/'.$data['gallery_image5'];
 			$row['address'] = stripslashes($data['address']);
 			$row['province'] = $data['province'];
 			$row['latitude'] = $data['latitude'];
            $row['longitude'] = $data['longitude'];
			$row['urutan'] = $data['urutan'];
               
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }
	
	public function wisata()
    {
        $file_path = 'http://streamer.digitalindovisitama.com/uploads/';
        $jsonObj= array();
        $Destinations = Destination::where('category_id','=', 4)->get();

            foreach($Destinations as $data)
        {
			
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
 			$row['detail'] = $data['detail'];
 			$row['phone'] = $data['phone'];
 			$row['price'] = $data['price'];
 			$row['image'] = $file_path.'destinations/'.$data['image'];
 			$row['gallery_image1'] = $file_path.'destinations/'.$data['gallery_image1'];
 			$row['gallery_image2'] = $file_path.'destinations/'.$data['gallery_image2'];
 			$row['gallery_image3'] = $file_path.'destinations/'.$data['gallery_image3'];
 			$row['gallery_image4'] = $file_path.'destinations/'.$data['gallery_image4'];
 			$row['gallery_image5'] = $file_path.'destinations/'.$data['gallery_image5'];
 			$row['address'] = stripslashes($data['address']);
 			$row['province'] = $data['province'];
 			$row['latitude'] = $data['latitude'];
            $row['longitude'] = $data['longitude'];
               
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }
	
	public function top3()
    {
        $file_path = 'http://streamer.digitalindovisitama.com/uploads/';
        $jsonObj= array();
        $Destinations = Destination::where('category_id','=', 5)->get();

            foreach($Destinations as $data)
        {
			
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
 			$row['detail'] = $data['detail'];
 			$row['phone'] = $data['phone'];
 			$row['price'] = $data['price'];
 			$row['image'] = $file_path.'destinations/'.$data['image'];
 			$row['gallery_image1'] = $file_path.'destinations/'.$data['gallery_image1'];
 			$row['gallery_image2'] = $file_path.'destinations/'.$data['gallery_image2'];
 			$row['gallery_image3'] = $file_path.'destinations/'.$data['gallery_image3'];
 			$row['gallery_image4'] = $file_path.'destinations/'.$data['gallery_image4'];
 			$row['gallery_image5'] = $file_path.'destinations/'.$data['gallery_image5'];
 			$row['address'] = stripslashes($data['address']);
 			$row['province'] = $data['province'];
 			$row['latitude'] = $data['latitude'];
            $row['longitude'] = $data['longitude'];
               
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }

   

    public function store(Request $request)
    {
        $Destination = Destination::create($request->all());
        return response(new DestinationResource($Destination), Response::HTTP_CREATED);
    }

    public function show ($id)
    {
        $Destination = Destination::Find($id);
        return response()->json(['data' => $Destination]);
    }
    
    public function update (Request $request,$id)
    {
        $Destination = Destination::Find($id);
        $Destination->update($request->all());
        return response(new DestinationResource($Destination), Response::HTTP_CREATED);
    }

    public function destroy (Destination $Destination)
    {   
        $Destination->delete();
        return response('Deleted', Response::HTTP_OK);
    }
    
     public function distance_museum(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $earthRadius = '6371.0'; //dalam km

        $sekitar = DB::table('destinations')
        ->select(('*'),DB::raw('ROUND(
            '.$earthRadius.' * ACOS(  
                SIN( '.$latitude.'*PI()/180 ) * SIN( latitude*PI()/180 )
                + COS( '.$latitude.'*PI()/180 ) * COS( latitude*PI()/180 )  *  COS( (longitude*PI()/180) - ('.$longitude.'*PI()/180) )   ) 
        , 1)
        AS distance'))
        ->where('category_id','=', 1)
    ->orderBy('distance', 'asc')
        ->get();
        return response($sekitar, Response::HTTP_CREATED);
    }
    
    public function distance_praying(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $earthRadius = '6371.0'; //dalam km

        $sekitar = DB::table('destinations')
        ->select(('*'),DB::raw('ROUND(
            '.$earthRadius.' * ACOS(  
                SIN( '.$latitude.'*PI()/180 ) * SIN( latitude*PI()/180 )
                + COS( '.$latitude.'*PI()/180 ) * COS( latitude*PI()/180 )  *  COS( (longitude*PI()/180) - ('.$longitude.'*PI()/180) )   ) 
        , 1)
        AS distance'))
        ->where('category_id','=', 2)
    ->orderBy('distance', 'asc')
        ->get();
        return response($sekitar, Response::HTTP_CREATED);
    }
    
    public function distance_restaurant(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $earthRadius = '6371.0'; //dalam km

        $sekitar = DB::table('destinations')
        ->select(('*'),DB::raw('ROUND(
            '.$earthRadius.' * ACOS(  
                SIN( '.$latitude.'*PI()/180 ) * SIN( latitude*PI()/180 )
                + COS( '.$latitude.'*PI()/180 ) * COS( latitude*PI()/180 )  *  COS( (longitude*PI()/180) - ('.$longitude.'*PI()/180) )   ) 
        , 1)
        AS distance'))
        ->where('category_id','=', 3)
    ->orderBy('distance', 'asc')
        ->get();
        return response($sekitar, Response::HTTP_CREATED);
    }


    public function slider()
    {
        $file_path = 'http://streamer.digitalindovisitama.com/uploads/';
        $jsonObj= array();
        $sliders = Slider::where('to','>=', Carbon::now('asia/jakarta')->format('Y-m-d'))->get();

        // $sliders = DB::table('sliders')
        // ->select(('*'),DB::raw('(to - from) AS age'))
        // ->where('age','>', 1)
        // ->get();

            foreach($sliders as $data)
        {
			
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
 			$row['url_destination'] = $data['url_destination'];
 			// $row['from'] = $data['from'];
 			$row['to'] = $data['to'];
 			$row['slider_photo'] = $file_path.'sliders/'.$data['slider_photo'];
 			$row['description'] = stripslashes($data['description']);
               
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }

}
