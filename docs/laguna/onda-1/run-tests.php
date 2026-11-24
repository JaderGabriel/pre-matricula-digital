#!/usr/bin/env php
<?php

declare(strict_types=1);

require __DIR__.'/WhatsAppNotifierStub.php';

use iEducar\Packages\PreMatricula\Laguna\WhatsAppNotifierStub;

$ok = 0;
$fail = 0;
$assert = static function (bool $c, string $m) use (&$ok, &$fail): void {
    echo ($c ? '  OK  ' : ' FAIL ').$m."\n";
    $c ? $ok++ : $fail++;
};

// Evidências de código Portabilis (arquivos-chave Onda 1.2)
$root = dirname(__DIR__, 3); // packages/portabilis/pre-matricula-digital
$assert(is_file($root.'/resources/ts/components/elements/ProtocolConsult.vue'), 'ProtocolConsult.vue (consulta pública)');
$assert(is_file($root.'/graphql/process.graphql'), 'process.graphql (publicProcesses)');
$assert(is_file($root.'/resources/views/auth/login-button.blade.php'), 'login-button processos abertos');
$assert(is_file($root.'/src/Http/Controllers/ExportController.php'), 'ExportController relatórios');

$wa = new WhatsAppNotifierStub();
$wa->enfileirar('PMD-2026-0001', '(48) 99999-0000', 'status_atualizado', ['situacao' => 'deferido']);
$assert($wa->total() === 1, 'WhatsApp stub enfileira evento');
$assert($wa->pendentes()[0]['telefone'] === '48999990000', 'telefone normalizado');

$threw = false;
try {
    $wa->enfileirar('', '1', 'x');
} catch (InvalidArgumentException) {
    $threw = true;
}
$assert($threw, 'WhatsApp stub valida entrada');

echo "\nResultado: {$ok} ok, {$fail} falhas\n";
exit($fail > 0 ? 1 : 0);
