<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\AuditorService;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\RateLimiter;

class RegistrarDobleFalloLogin
{
    public function handle(Failed $event): void
    {
        $email = $event->credentials['email'] ?? null;
        if (!$email) return;

        // Solo si el correo existe
        if (!User::where('email', $email)->exists()) return;

        $ip = request()->ip();
        $key = 'login-fallido-2:' . strtolower($email) . ':' . $ip;

        // 1) Incrementa el contador (expira en 10 min)
        RateLimiter::hit($key, 600);

        // 2) Lee cuántos intentos van (DESPUÉS de incrementar)
        $intentos = RateLimiter::attempts($key);

        // ✅ SOLO cuando llegue EXACTAMENTE a 2
        if ($intentos === 2) {
            AuditorService::registrar(
                nivel: 'ATAQUE',
                accion: 'LOGIN_FALLIDO_2',
                estado: 'FALLO',
                descripcion: "2 intentos fallidos de inicio de sesión para {$email} desde IP {$ip}",
                usuarioId: null,
                entidad: 'User',
                entidadId: null
            );
        }
    }
}