<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WindFarm;


class DashboardController extends Controller
{
    public function index()
    {
        // dd('dashboard');
        //query to get all wind farms e return response
        $windFarms = WindFarm::with('turbines.components')->get();

        return response()->json($windFarms);
    }
}
