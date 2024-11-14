<?php

namespace App\Http\Controllers;

use App\Models\Service;  // Update the import to use the English version
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $services = Service::get();  // Change Layanan to Service
        return view('welcome', compact('services'));
    }
}
