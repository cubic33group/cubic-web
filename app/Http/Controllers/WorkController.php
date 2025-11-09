<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    public function index()
    {
        // $clientes = Cliente::withCount('obras')
        //     ->orderBy('nombre', 'asc')
        //     ->paginate(10);

        return view('works.index', compact('works'));
    }
      public function create()
    {
        return view('works.create');
    }
    public function edit(Work $works)
    {
        return view('works.edit', compact('works'));
    }

}
