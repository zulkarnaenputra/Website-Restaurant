<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $Request, $slug)
    {
        $item = Facility::with(['galleries'])
                    ->where('slug', $slug)
                    ->firstOrFail();
        return view('pages.detail',[
            'item' => $item
        ]);
    }
}
