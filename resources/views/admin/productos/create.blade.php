<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#BFE4CD] to-[#DDB37D] py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-[#FB4848]">Nuevo producto</h1>

                <a href="{{ route('admin.productos.index') }}"
                   class="text-sm font-medium text-[#FA8331] hover:text-[#FD0A60]">
                    ← Volver
                </a>
            </div>

            @if ($errors->any())
                <div class="p-4 mb-6 rounded-xl border border-red-200 bg-red-50 text-red-700">
                    <div class="font-semibold mb-2">Revisa los siguientes campos:</div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.productos.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block font-semibold text-gray-800">Categoría</label>
                    <select name="categoria_id"
                            class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                   focus:border-[#FA8331] focus:ring-[#FA8331]">
                        <option value="">Sin categoría</option>
                        @foreach($categorias as $c)
                            <option value="{{ $c->id }}" @selected(old('categoria_id') == $c->id)>
                                {{ $c->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-semibold text-gray-800">Código</label>
                        <input name="codigo"
                               class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                      focus:border-[#FA8331] focus:ring-[#FA8331]"
                               value="{{ old('codigo') }}"
                               placeholder="Ej. 7501234567890"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-800">Nombre</label>
                        <input name="nombre"
                               class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                      focus:border-[#FA8331] focus:ring-[#FA8331]"
                               value="{{ old('nombre') }}"
                               placeholder="Ej. Leche 1L"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-gray-800">Descripción</label>
                    <textarea name="descripcion"
                              rows="4"
                              class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                     focus:border-[#FA8331] focus:ring-[#FA8331]"
                              placeholder="Opcional...">{{ old('descripcion') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-semibold text-gray-800">Precio</label>
                        <input name="precio" type="number" step="0.01" min="0"
                               class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                      focus:border-[#FA8331] focus:ring-[#FA8331]"
                               value="{{ old('precio') }}"
                               required>
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-800">Stock</label>
                        <input name="stock" type="number" min="0"
                               class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                      focus:border-[#FA8331] focus:ring-[#FA8331]"
                               value="{{ old('stock') }}"
                               required>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="activo" id="activo"
                           class="rounded border-gray-300 text-[#FB4848] focus:ring-[#FB4848]"
                           {{ old('activo', true) ? 'checked' : '' }}>
                    <label for="activo" class="font-medium text-gray-700">Activo</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-white font-semibold shadow-md
                                   bg-[#FB4848] hover:bg-[#FD0A60] transition">
                        Guardar
                    </button>

                    <a href="{{ route('admin.productos.index') }}"
                       class="px-5 py-2.5 rounded-xl border border-gray-300 font-semibold
                              hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>