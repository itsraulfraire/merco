<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-10 bg-[#F6F7F9]">
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                {{-- IZQUIERDA (brand con paleta) --}}
                <div class="hidden lg:flex flex-col justify-between p-12"
                     style="background: linear-gradient(135deg, #BFE4CD 0%, #DDB37D 100%);">
                    <div>
                        <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-16 w-auto drop-shadow-sm">

                        <h1 class="mt-10 text-4xl font-extrabold text-[#1b1b18] leading-tight">
                            Bienvenido a <span style="color:#FA8331;">Merco</span>
                        </h1>

                        <p class="mt-4 text-lg leading-relaxed text-[#1b1b18]/80">
                            Crea tu cuenta para empezar a ver productos, promociones y novedades.
                        </p>

                        {{-- Barra de colores (paleta) --}}
                        <div class="mt-10 flex gap-2">
                            <span class="h-2 w-16 rounded-full" style="background:#BFE4CD;"></span>
                            <span class="h-2 w-16 rounded-full" style="background:#DDB37D;"></span>
                            <span class="h-2 w-16 rounded-full" style="background:#FA8331;"></span>
                            <span class="h-2 w-16 rounded-full" style="background:#FB4848;"></span>
                            <span class="h-2 w-16 rounded-full" style="background:#FD0A60;"></span>
                        </div>
                    </div>

                    <div class="text-sm text-[#1b1b18]/70">
                        © {{ date('Y') }} Merco
                    </div>
                </div>

                {{-- DERECHA (form) --}}
                <div class="flex items-center justify-center p-8 sm:p-10 bg-white">
                    <div class="w-full max-w-md">

                        {{-- Logo en móvil --}}
                        <div class="flex items-center justify-center lg:hidden mb-6">
                            <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="h-14 w-auto">
                        </div>

                        <h2 class="text-3xl font-bold text-[#1b1b18]">
                            Crear cuenta
                        </h2>
                        <p class="text-sm mt-1 text-[#1b1b18]/60">
                            Completa tus datos para registrarte.
                        </p>

                        <form method="POST" action="{{ route('register') }}" class="mt-7 space-y-4">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input
                                    id="name"
                                    class="block mt-2 w-full rounded-xl border-gray-300
                                           focus:border-[#FA8331] focus:ring-[#FA8331]"
                                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Correo')" />
                                <x-text-input
                                    id="email"
                                    class="block mt-2 w-full rounded-xl border-gray-300
                                           focus:border-[#FA8331] focus:ring-[#FA8331]"
                                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Contraseña')" />
                                <x-text-input
                                    id="password"
                                    class="block mt-2 w-full rounded-xl border-gray-300
                                           focus:border-[#FA8331] focus:ring-[#FA8331]"
                                    type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                                <x-text-input
                                    id="password_confirmation"
                                    class="block mt-2 w-full rounded-xl border-gray-300
                                           focus:border-[#FA8331] focus:ring-[#FA8331]"
                                    type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <button type="submit"
                                class="w-full mt-2 rounded-2xl px-4 py-3 font-semibold text-white shadow-md transition
                                       hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                style="background:#FA8331; focus:ring-color:#FA8331;">
                                Registrarme
                            </button>

                            <div class="text-sm text-center text-[#1b1b18]/70 pt-2">
                                ¿Ya tienes cuenta?
                                <a href="{{ route('login') }}"
                                   class="font-semibold hover:underline"
                                   style="color:#FD0A60;">
                                    Inicia sesión
                                </a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>