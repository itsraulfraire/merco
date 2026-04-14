<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#BFE4CD] to-[#DDB37D] py-10">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-[#FB4848]">Categorías</h1>
                    <p class="text-sm text-gray-600">Administra las categorías del catálogo.</p>
                </div>

                <a href="{{ route('admin.categorias.create') }}"
                   class="px-5 py-2.5 rounded-xl text-white font-semibold shadow-md
                          bg-[#FA8331] hover:bg-[#FB4848] transition">
                    + Nueva categoría
                </a>
            </div>

            @if(session('ok'))
                <div class="p-4 mb-6 rounded-xl border border-green-200 bg-green-50 text-green-800">
                    {{ session('ok') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-gray-200">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 text-left">
                            <th class="p-4 font-semibold text-gray-700">Nombre</th>
                            <th class="p-4 font-semibold text-gray-700">Activo</th>
                            <th class="p-4 font-semibold text-gray-700">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($categorias as $c)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-gray-900">
                                    {{ $c->nombre }}
                                </td>

                                <td class="p-4">
                                    @if($c->activo)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm
                                                     bg-[#BFE4CD] text-gray-900 font-semibold">
                                            Sí
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm
                                                     bg-gray-200 text-gray-700 font-semibold">
                                            No
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('admin.categorias.edit', $c) }}"
                                           class="font-semibold text-[#FA8331] hover:text-[#FD0A60]">
                                            Editar
                                        </a>

                                        <form method="POST"
                                              action="{{ route('admin.categorias.destroy', $c) }}"
                                              onsubmit="return confirm('¿Eliminar categoría?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="font-semibold text-[#FB4848] hover:text-[#FD0A60]">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if($categorias->count() === 0)
                            <tr>
                                <td colspan="3" class="p-6 text-center text-gray-600">
                                    No hay categorías registradas.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
</x-app-layout>