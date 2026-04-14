<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Producto;
use App\Services\AuditorService;
use Illuminate\Http\Request;

class ProductoAdminController extends Controller
{
    public function index()
    {
        $productos = Producto::orderByDesc('id')->paginate(15);
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria_id' => ['nullable', 'integer', 'exists:categorias,id'],
            'codigo'       => ['required', 'string', 'max:60', 'unique:productos,codigo'],
            'nombre'       => ['required', 'string', 'max:200'],
            'descripcion'  => ['nullable', 'string'],
            'precio'       => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'activo'       => ['nullable'],
        ]);

        $data['activo'] = $request->has('activo') ? 1 : 0;

        Producto::create($data);

        return redirect()->route('admin.productos.index')
            ->with('ok', 'Producto creado.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'categoria_id' => ['nullable', 'integer', 'exists:categorias,id'],
            'codigo'       => ['required', 'string', 'max:60', 'unique:productos,codigo,' . $producto->id],
            'nombre'       => ['required', 'string', 'max:200'],
            'descripcion'  => ['nullable', 'string'],
            'precio'       => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'activo'       => ['nullable'],
        ]);

        $data['activo'] = $request->has('activo') ? 1 : 0;

        $producto->update($data);

        return redirect()->route('admin.productos.index')
            ->with('ok', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        $info = "Admin eliminó producto: {$producto->nombre} (código {$producto->codigo})";
        $id = (int) $producto->id;

        $producto->delete();

        // ✅ Auditoría SOLO al eliminar:
        AuditorService::registrar(
            nivel: 'MOVIMIENTO',
            accion: 'ELIMINAR_PRODUCTO',
            estado: 'EXITO',
            descripcion: $info,
            usuarioId: auth()->id(),
            entidad: 'Producto',
            entidadId: $id
        );

        return redirect()->route('admin.productos.index')
            ->with('ok', 'Producto eliminado.');
    }
}