<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{

    public function index()
    {
        return Articulo::orderBy('nombre')->get();
    }

    public function store(Request $request)
    {
        $articulo = Articulo::create($request->except(['id']));
        return $articulo;
    }

    public function show(Articulo $articulo)
    {
        return $articulo;
    }

    public function update(Request $request, Articulo $articulo)
    {
        $articulo->update($request->all());
        return $articulo;
    }

    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
    }

}
