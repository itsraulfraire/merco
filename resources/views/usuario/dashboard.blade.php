<x-app-layout>
    <div class="min-h-screen bg-[#F6F7F9]">

        {{-- WIDGET SUPERIOR --}}
        <div class="w-full border-b border-gray-200 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">

                <div class="rounded-3xl overflow-hidden shadow-sm border border-gray-100"
                     style="background: linear-gradient(135deg, #BFE4CD 0%, #DDB37D 100%);">
                    <div class="p-6 sm:p-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

                        <div>
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('images/Logo.png') }}" class="h-14 w-auto" alt="Merco">
                                <div class="hidden sm:block">
                                    <div class="text-sm text-[#1b1b18]/70">Bienvenido</div>
                                    <div class="font-bold text-[#1b1b18]">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                            </div>

                            <h1 class="mt-6 text-3xl sm:text-4xl font-extrabold text-[#1b1b18] leading-tight">
                                Encuentra tus productos en <span style="color:#FA8331;">Merco</span>
                            </h1>

                            <p class="mt-3 text-[#1b1b18]/75 text-base sm:text-lg">
                                Promociones, novedades y productos disponibles en un solo lugar.
                            </p>

                            {{-- mini barra paleta --}}
                            <div class="mt-6 flex gap-2">
                                <span class="h-2 w-14 rounded-full" style="background:#BFE4CD;"></span>
                                <span class="h-2 w-14 rounded-full" style="background:#DDB37D;"></span>
                                <span class="h-2 w-14 rounded-full" style="background:#FA8331;"></span>
                                <span class="h-2 w-14 rounded-full" style="background:#FB4848;"></span>
                                <span class="h-2 w-14 rounded-full" style="background:#FD0A60;"></span>
                            </div>
                        </div>

                        {{-- BUSCADOR --}}
                        <div class="bg-white/70 backdrop-blur rounded-3xl p-6 border border-white">
                            <div class="text-sm font-semibold text-[#1b1b18]">
                                Buscar producto
                            </div>

                            <form method="GET" action="{{ route('usuario.dashboard') }}" class="mt-3">
                                <div class="flex gap-2">
                                    <input
                                        type="text"
                                        name="q"
                                        value="{{ $q ?? '' }}"
                                        placeholder="Ej. leche, galletas, código..."
                                        class="w-full rounded-2xl border-gray-300 focus:border-[#FA8331] focus:ring-[#FA8331]"
                                    >
                                    <button
                                        class="px-5 rounded-2xl font-semibold text-white shadow-sm hover:opacity-95"
                                        style="background:#FA8331;"
                                        type="submit"
                                    >
                                        Buscar
                                    </button>
                                </div>

                                @if(!empty($q))
                                    <div class="mt-2 text-sm text-[#1b1b18]/70">
                                        Mostrando resultados para: <span class="font-semibold">{{ $q }}</span>
                                        · <a href="{{ route('usuario.dashboard') }}" class="underline" style="color:#FD0A60;">Quitar filtro</a>
                                    </div>
                                @endif
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        {{-- LISTADO DE PRODUCTOS --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">

            <div class="flex items-end justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#1b1b18]">Productos</h2>
                    <p class="text-sm text-[#1b1b18]/60">
                        {{ $productos->count() }} disponibles
                    </p>
                </div>
            </div>

            @if($productos->isEmpty())
                <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center">
                    <div class="text-lg font-semibold text-[#1b1b18]">No hay productos para mostrar</div>
                    <div class="text-sm text-[#1b1b18]/60 mt-1">Intenta con otra búsqueda.</div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($productos as $p)
                        <a href="{{ route('usuario.productos.show', $p) }}"
                           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition overflow-hidden">

                            {{-- “cinta” superior con color --}}
                            <div class="h-2" style="background: linear-gradient(90deg, #FA8331 0%, #FD0A60 100%);"></div>

                            <div class="p-5">
                                <div class="text-xs font-semibold text-[#1b1b18]/60">
                                    Código: {{ $p->codigo }}
                                </div>

                                <div class="mt-1 text-lg font-bold text-[#1b1b18] group-hover:underline">
                                    {{ $p->nombre }}
                                </div>

                                <div class="mt-1 text-sm text-[#1b1b18]/70 line-clamp-2">
                                    {{ $p->descripcion ?? 'Sin descripción.' }}
                                </div>

                                <div class="mt-4 flex items-center justify-between">
                                    <div class="text-xl font-extrabold" style="color:#FB4848;">
                                        $ {{ number_format($p->precio, 2) }}
                                    </div>

                                    <div class="text-sm font-semibold px-3 py-1 rounded-full"
                                         style="background:#BFE4CD; color:#1b1b18;">
                                        Stock: {{ $p->stock }}
                                    </div>
                                </div>

                                <div class="mt-3 text-sm text-[#1b1b18]/60">
                                    Categoría: <span class="font-semibold">{{ $p->categoria->nombre ?? 'Sin categoría' }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>