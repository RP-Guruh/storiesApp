<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index() {
        $data = Category::all();

        return view('categories', [
            'data' => $data
        ]);
    }

    public function show($id) {
        $data = Category::all();

        return view('show', [
            'data' => $data
        ]);
    }
}
