<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function store()
    {
        auth()->user()->saves()->toggle(request('id'));

        return redirect()->route('jobs.index');
    }
}
