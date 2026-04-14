<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Catálogo de productos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($productos as $p)
                <div class="border rounded-lg p-4 shadow-sm bg-white">
                    <h2 class="text-lg font-semibold mb-1">
                        {{ $p->nombre }}
                    </h2>

                    <div class="text-sm text-gray-600 mb-2">
                        Código: {{ $p->codigo }}
                    </div>

                    <div class="text-sm mb-1">
                        <strong>Categoría:</strong>
                        {{ $p->categoria->nombre ?? 'Sin categoría' }}
                    </div>

                    <div class="text-sm mb-1">
                        <strong>Precio:</strong>
                        $ {{ number_format($p->precio, 2) }}
                    </div>

                    <div class="text-sm mb-1">
                        <strong>Stock:</strong>
                        {{ $p->stock }}
                    </div>

                    <div class="text-sm">
                        <strong>Estado:</strong>
                        @if($p->activo)
                            <span class="text-green-600 font-semibold">Disponible</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactivo</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    No hay productos disponibles.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $productos->links() }}
        </div>
    </div>
</x-app-layout>