<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('view_dashboard'), Response::HTTP_FORBIDDEN);

        return view('admin.dashboard');
    }
}
