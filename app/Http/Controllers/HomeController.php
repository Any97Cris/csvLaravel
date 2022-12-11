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
        $path = storage_path('app'.DIRECTORY_SEPARATOR.'csv'.DIRECTORY_SEPARATOR.'usuarios_'.Carbon::now().'.csv');
        //dd($path);
        $csv = Writer::createFromPath($path,'w'); 
        $csv->insertOne(Schema::getColumnListing('users'));
        foreach($user as $us){
            $csv->insertOne($us->toArray());
        }
        
        $csv->output('usuarios_'.Carbon::now().'.csv');
    }


    // public function upload(){
    //     return view('welcome');
    // }

    // public function uploadPost(Request $request){
    //     //dd($request->csv); 
    //     $file = $request->csv->storeAs('csv', 'csv.csv');
    //     return $file;
    // }

    // public function readCsv(){
    //     $file = Reader::createFromPath('../storage/app/csv/csv.csv');
    //     $header = $file->fetchOne(1);
    //     dd($file->setOffset(1)->setLimit(10)->fetchAll());
    // }

    // public function showCsv(){
    //     $file = Reader::createFromPath('../storage/app/csv/csv.csv');

    //     $file = $file->toHTML('table table-striped');

    //     return view('dadosCsv', ['file' => $file]);
    // }

}
