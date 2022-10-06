<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Twilio\Rest\Client;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-message', function () {
    $sid    = getenv("TWILIO_AUTH_SID");
    $token  = getenv("TWILIO_AUTH_TOKEN");
    $wa_from= getenv("TWILIO_WHATSAPP_FROM");
    $twilio = new Client($sid, $token);
    $recipient = "+918153999379";
    $userName = "Gohil Jaykumar";
    $timeStamp = date('Y-m-d h:i:s');
    
    $body = "Hello $userName, Twilio API working. Time stamp: $timeStamp";

    $url = "https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg"; /*Image Attachment*/
    // $url = "https://joy.videvo.net/videvo_files/video/free/video0454/large_watermarked/_import_6064a2d0ec2a62.28720221_preview.mp4"; /*Video Attachment*/
    // $url = "https://www.africau.edu/images/default/sample.pdf"; /*PDF Attachment*/

    return $twilio->messages->create("whatsapp:$recipient",[
        "from" => "whatsapp:$wa_from", 
        "body" => $body,
        "MediaUrl" => $url
    ]);
});
