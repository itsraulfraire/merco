<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#BFE4CD] to-[#DDB37D] py-10">
        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-xl p-8">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-[#FB4848]">Nueva categoría</h1>
                <a href="{{ route('admin.categorias.index') }}"
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

            <form method="POST" action="{{ route('admin.categorias.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block font-semibold text-gray-800">Nombre</label>
                    <input name="nombre"
                           class="w-full mt-2 rounded-xl border border-gray-300 p-3
                                  focus:border-[#FA8331] focus:ring-[#FA8331]"
                           value="{{ old('nombre') }}"
                           placeholder="Ej. Abarrotes, Lácteos, Limpieza…"
                           required>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox"
                           name="activo"
                           id="activo"
                           class="rounded border-gray-300 text-[#FB4848] focus:ring-[#FB4848]"
                           checked>
                    <label for="activo" class="font-medium text-gray-700">Activa</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-white font-semibold shadow-md
                                   bg-[#FB4848] hover:bg-[#FD0A60] transition">
                        Guardar
                    </button>

                    <a href="{{ route('admin.categorias.index') }}"
                       class="px-5 py-2.5 rounded-xl border border-gray-300 font-semibold
                              hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>