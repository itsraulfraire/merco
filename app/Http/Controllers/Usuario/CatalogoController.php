<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $productos = Producto::query()
            ->where('activo', 1)
            ->when($q, function ($query) use ($q) {
                $query->where(function($sub) use ($q) {
                    $sub->where('nombre', 'like', "%{$q}%")
                        ->orWhere('codigo', 'like', "%{$q}%")
                        ->orWhere('descripcion', 'like', "%{$q}%");
                });
            })
            ->orderBy('nombre')
            ->get();

        return view('usuario.dashboard', compact('productos', 'q'));
    }

    public function show(Producto $producto)
    {
        abort_unless($producto->activo, 404);

        return view('usuario.productos.show', compact('producto'));
    }
}