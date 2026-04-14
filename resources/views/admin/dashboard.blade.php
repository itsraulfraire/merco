<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-[#BFE4CD] to-[#DDB37D] py-10">

        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-8">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-[#FB4848]">
                    Panel Administrador
                </h1>

                <span class="text-sm text-gray-500">
                    Gestión del supermercado
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- PRODUCTOS --}}
                <a href="{{ route('admin.productos.index') }}"
                   class="bg-[#BFE4CD] hover:bg-[#a8d8bb] transition
                          rounded-xl p-6 shadow-md flex items-center gap-4">

                    <div class="text-3xl">📦</div>

                    <div>
                        <div class="font-semibold text-lg text-[#1b1b18]">
                            Gestionar Productos
                        </div>
                        <div class="text-sm text-gray-700">
                            Alta, edición y eliminación
                        </div>
                    </div>
                </a>

                {{-- CATEGORÍAS --}}
                <a href="{{ route('admin.categorias.index') }}"
                   class="bg-[#DDB37D] hover:bg-[#cfa06b] transition
                          rounded-xl p-6 shadow-md flex items-center gap-4">

                    <div class="text-3xl">🗂️</div>

                    <div>
                        <div class="font-semibold text-lg text-[#1b1b18]">
                            Gestionar Categorías
                        </div>
                        <div class="text-sm text-gray-800">
                            Alta, edición y eliminación
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

</x-app-layout>