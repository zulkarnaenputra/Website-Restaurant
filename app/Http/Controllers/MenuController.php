<?php

namespace App\Http\Controllers;


use App\Models\MenuPackage;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $items = MenuPackage::with(['galleries'])->get();

        return view('pages.menu', [
            'items' => $items
        ]);
    }
}
