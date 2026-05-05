<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    //Generate QR code
    public function index()
    {
        return QrCode::size(300)->generate('https://www.jackson-kishan.com');
    }

    
}
