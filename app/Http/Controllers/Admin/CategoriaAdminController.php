<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Services\AuditorService;
use Illuminate\Http\Request;

class CategoriaAdminController extends Controller
{
    public function index()
    {
        $categorias = Categoria::latest()->paginate(15);
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'activo' => ['nullable'],
        ]);

        $data['activo'] = $request->has('activo') ? 1 : 0;

        $categoria = Categoria::create($data);

        AuditorService::registrar(
            nivel: 'MOVIMIENTO',
            accion: 'ALTA_CATEGORIA',
            estado: 'EXITO',
            descripcion: "Admin creó categoría: {$categoria->nombre}",
            usuarioId: auth()->id(),
            entidad: 'Categoria',
            entidadId: (int)$categoria->id
        );

        return redirect()->route('admin.categorias.index')->with('ok', 'Categoría creada.');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120'],
            'activo' => ['nullable'],
        ]);

        $data['activo'] = $request->has('activo') ? 1 : 0;

        $categoria->update($data);

        AuditorService::registrar(
            nivel: 'MOVIMIENTO',
            accion: 'EDITAR_CATEGORIA',
            estado: 'EXITO',
            descripcion: "Admin actualizó categoría: {$categoria->nombre}",
            usuarioId: auth()->id(),
            entidad: 'Categoria',
            entidadId: (int)$categoria->id
        );

        return redirect()->route('admin.categorias.index')->with('ok', 'Categoría actualizada.');
    }

    public function destroy(Categoria $categoria)
    {
        $nombre = $categoria->nombre;
        $id = (int)$categoria->id;

        $categoria->delete();

        AuditorService::registrar(
            nivel: 'MOVIMIENTO',
            accion: 'ELIMINAR_CATEGORIA',
            estado: 'EXITO',
            descripcion: "Admin eliminó categoría: {$nombre}",
            usuarioId: auth()->id(),
            entidad: 'Categoria',
            entidadId: $id
        );

        return redirect()->route('admin.categorias.index')->with('ok', 'Categoría eliminada.');
    }
}