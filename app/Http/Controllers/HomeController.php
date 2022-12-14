<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\SchemaBuilder;
use Illuminate\Support\Facades\Schema;
use League\Csv\Reader;
use League\Csv\Writer;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->status)){
            $user = User::whereStatus($request->status)->get()->all();
        }else{
            $user = User::all();
        }
        //$path = storage_path('app'.DIRECTORY_SEPARATOR.'csv'.DIRECTORY_SEPARATOR.'usuarios_'.Carbon::now().'.csv');
        //dd($path);
        $csv = Writer::createFromPath($path,'w'); 
        $csv->insertOne(Schema::getColumnListing('users'));
        foreach($user as $us){
            $csv->insertOne($us->toArray());
        }
        
        $csv->output('usuarios_'.Carbon::now().'.csv');
    }


    public function upload(){
        return view('welcome');
    }

    public function uploadPost(Request $request){
        //dd($request->csv); 
        $file = $request->csv->storeAs('csv', 'csv1.csv');
        return $file;
    }

    public function readCsv(){
        $file = Reader::createFromPath('../storage/app/csv/csv.csv');
        $header = $file->fetchOne(1);
        dd($file->setOffset(1)->setLimit(10)->fetchAll());
    }

    public function showCsv(){
        $file = Reader::createFromPath('../storage/app/csv/csv.csv');

        $file = $file->toHTML('table table-striped');

        return view('dadosCsv', ['file' => $file]);
    }

    public function readXml(){
        $file = Reader::createFromPath('../storage/app/csv/csv.csv');
        $file = $file->setOffset(1)->setLimit(10)->toXML('csvs','csv', 'info');
        $xml = $file->saveXML();
        header('Content-Type: application/xml; charset="utf-8"');
        header('Content-Type:'.strlen($xml));
        die($xml);
    }

    public function readJson(){
        $file = Reader::createFromPath('../storage/app/csv/csv.csv');
        $file = $file->setOffset(1);
        $response = json_encode($file, JSON_PRETTY_PRINT|JSON_HEX_QUOT|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_TAG);
        header('Content-Type: application/json; charset="utf-8"');
        die($response);
    }

}
