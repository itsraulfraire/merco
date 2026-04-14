<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Services\AuditorService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria_id' => ['nullable', 'integer'],
            'codigo' => ['required', 'string', 'max:60', 'unique:productos,codigo'],
            'nombre' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'activo' => ['nullable'],
        ]);

        $data['activo'] = $request->has('activo') ? 1 : 0;
        $data['creado_por'] = auth()->id();
        $data['actualizado_por'] = auth()->id();

        $producto = Producto::create($data);

        // ✅ Auditoría: tabla + archivo
        AuditorService::registrar(
            nivel: 'MOVIMIENTO',
            accion: 'ALTA_PRODUCTO',
            estado: 'EXITO',
            descripcion: "Se registró producto: {$producto->nombre} (código {$producto->codigo})",
            usuarioId: auth()->id(),
            entidad: 'Producto',
            entidadId: (int) $producto->id
        );

        return redirect()->back()->with('ok', 'Producto registrado correctamente.');
    }
}