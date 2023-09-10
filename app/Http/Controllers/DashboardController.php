<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WindFarm;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        /** @var \Illuminate\Database\Eloquent\Collection $windFarms */
        $windFarms = WindFarm::with('turbines.components')->get();

        return response()->json($windFarms);
    }
}
