<?php

declare(strict_types=1);

namespace iEducar\Packages\PreMatricula\Laguna;

/**
 * Stub Laguna — notificações WhatsApp (TR 5.8.12).
 * Onda 1: contrato + fila de eventos; provedor real (API oficial / BSP) entra nos ≤15%/30 dias.
 */
final class WhatsAppNotifierStub
{
    /** @var list<array{protocolo: string, telefone: string, evento: string, payload: array<string, mixed>}> */
    private array $fila = [];

    /**
     * @param array<string, mixed> $payload
     */
    public function enfileirar(string $protocolo, string $telefone, string $evento, array $payload = []): void
    {
        $telefone = preg_replace('/\D+/', '', $telefone) ?? '';
        if ($protocolo === '' || strlen($telefone) < 10) {
            throw new \InvalidArgumentException('Protocolo/telefone inválidos para WhatsApp.');
        }
        $this->fila[] = [
            'protocolo' => $protocolo,
            'telefone' => $telefone,
            'evento' => $evento,
            'payload' => $payload,
        ];
    }

    /** @return list<array{protocolo: string, telefone: string, evento: string, payload: array<string, mixed>}> */
    public function pendentes(): array
    {
        return $this->fila;
    }

    public function total(): int
    {
        return count($this->fila);
    }
}
