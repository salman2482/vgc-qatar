<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/test2', function (Request $request) {

    $status=200;
    $name="No Data";

    if($request->id)

    {
        $name=$request->id;
    }
        $data='<form action="/action_page.php"><label for="fname">First name:</label><br><input type="text" id="fname" name="fname" value="'.$name.'"><br><label for="lname">Last name:</label><br><input type="text" id="lname" name="lname" value="Doe"><br><br><input type="submit" value="Submit"></form> ';
        
        return $data;
        return response(compact(['status','data']));
    
        });


        Route::match(['post','get'],'/getid', function (Request $request) {

            $status=200;
            $data=rand(10,100);
        
            
                return response(compact(['status','data']));
            
                });


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/jsonform', function (Request $request) {

$data="{'fields': [ { 'key': 'name', 'type': 'Input', 'label': 'Name', 'placeholder': 'Enter Your Name',  'required': true, }, {'key': 'username','type': 'Input', 'label': 'Username','placeholder': 'Enter Your Username', 'required': true, 'hiddenLabel':true, }, {'key': 'email', 'type': 'Email', 'label': 'email', 'required': true}, { 'key': 'password1', 'type': 'Password', 'label': 'Password', 'required': true },] } ";


  

  $status=200;
  return $data;

});