<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center
                bg-gradient-to-br from-[#BFE4CD] to-[#DDB37D]">
            
            <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
                        <div class="flex justify-center mb-4">
                <img src="{{ asset('images/Logo.png') }}"
                    alt="Logo Merco"
                    class="h-16 w-auto">
            </div>
            <div class="w-16 h-1 bg-[#FA8331] mx-auto rounded mb-4"></div>

            <h2 class="text-2xl font-bold text-center text-[#FB4848] mb-6">
                Iniciar sesión
            </h2>

            <!-- Estado de sesión -->
            <x-auth-session-status class="mb-4 text-center text-green-600"
                                   :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Correo -->
                <div>
                    <x-input-label for="email" value="Correo electrónico" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FA8331] focus:ring-[#FA8331]"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div class="mt-4">
                    <x-input-label for="password" value="Contraseña" />
                    <x-text-input id="password"
                                  class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FA8331] focus:ring-[#FA8331]"
                                  type="password"
                                  name="password"
                                  required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Recordarme -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-gray-300 text-[#FB4848] focus:ring-[#FB4848]"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">
                            Recuérdame
                        </span>
                    </label>
                </div>

                <!-- Botón y link -->
                <div class="flex items-center justify-between mt-6">

                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#FA8331] hover:text-[#FD0A60]"
                           href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    <button type="submit"
                            class="bg-[#FB4848] hover:bg-[#FD0A60] text-white
                                   px-6 py-2 rounded-lg shadow-md transition">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>