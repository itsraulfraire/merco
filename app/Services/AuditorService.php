<?php

namespace App\Services;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Log;

class AuditorService
{
    public static function registrar(
        string $nivel,
        string $accion,
        string $estado,
        string $descripcion,
        ?int $usuarioId = null,
        ?string $entidad = null,
        ?int $entidadId = null
    ): void {
        $r = request();

        $ruta = $r?->path() ?? '-';
        $metodo = $r?->method() ?? '-';
        $ip = $r?->ip() ?? '-';
        $ua = $r?->userAgent() ?? '-';

        // 1) Guardar en BD (bitacora)
        Bitacora::create([
            'usuario_id' => $usuarioId,
            'nivel' => $nivel,
            'accion' => $accion,
            'estado' => $estado,
            'descripcion' => $descripcion,
            'ruta' => $ruta,
            'metodo' => $metodo,
            'ip' => $ip,
            'agente_usuario' => $ua,
            'entidad' => $entidad,
            'entidad_id' => $entidadId,
            'created_at' => now(),
        ]);

        // 2) Log "humano" (una línea clara)
        $usuarioTxt = $usuarioId ? "UsuarioID={$usuarioId}" : "UsuarioID=Anon";
        $entidadTxt = $entidad ? "{$entidad}" . ($entidadId ? "#{$entidadId}" : "") : "Entidad=-";

// 2) Log "humano" (corto)
// Nota: NO agregues timestamp aquí, Laravel ya lo pone.
$usuarioTxt = $usuarioId ? "u={$usuarioId}" : "u=anon";
$entidadTxt = $entidad ? "e={$entidad}" . ($entidadId ? "#{$entidadId}" : "") : "e=-";

        // Mensaje corto (una sola línea)
        $linea = sprintf(
            "%s %s %s ip=%s %s %s",
            strtoupper($nivel),   // ATAQUE / MOVIMIENTO
            $accion,              // LOGIN_FALLIDO_2 / ALTA_PRODUCTO / etc
            strtoupper($estado),  // EXITO / FALLO
            $ip,
            $usuarioTxt,
            $entidadTxt
        );

        // Canal audit (audit.log)
        Log::channel('audit')->info($linea, [
            // contexto útil (aquí sí pon TODO lo necesario)
            'descripcion' => $descripcion,
            'usuario_id' => $usuarioId,
            'nivel' => $nivel,
            'accion' => $accion,
            'estado' => $estado,
            'ruta' => $ruta,
            'metodo' => $metodo,
            'ip' => $ip,
            'agente_usuario' => $ua,
            'entidad' => $entidad,
            'entidad_id' => $entidadId,
        ]);

        // Canal audit (tu audit.log)
        Log::channel('audit')->info($linea, [
            // contexto (opcional): queda oculto en el log pero útil para depurar
            'usuario_id' => $usuarioId,
            'nivel' => $nivel,
            'accion' => $accion,
            'estado' => $estado,
            'ruta' => $ruta,
            'metodo' => $metodo,
            'ip' => $ip,
            'entidad' => $entidad,
            'entidad_id' => $entidadId,
        ]);
    }
}