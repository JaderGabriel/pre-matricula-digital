# Matriz PoC — 5.8 Fila / pré-matrícula (Onda 1)

**Estratégia:** adaptar Portabilis (sem pacote Buriti novo).

| Bloco | Status | Evidência |
| --- | --- | --- |
| Processos / períodos / etapas / inscrição | **atende** | GraphQL process + UI Vue |
| Protocolo e consulta pública | **atende** | `ProtocolConsult.vue`, buscas CPF/RG/certidão |
| Processos abertos sem login | **atende** | `publicProcesses` + login-button |
| Pré-matrícula rede/novos | **atende** | `NewPreRegistration`, listas |
| Relatórios / export | **parcial→atende** | `ExportController` / ReportController |
| Previsão de vagas | **parcial** | vacancy reports; completar se faltar TR |
| Escolas credenciadas / terceirizadas | **parcial** | cadastro escolas; marcar tipo credenciada |
| WhatsApp (5.8.12) | **gap→parcial** | `WhatsAppNotifierStub` (fila); BSP real ≤30 dias |
| E-mail responsável | **parcial** | `protocol-mail.blade.php` |
| Mapa solicitantes | **parcial** | validar na UI |
| Troca turno parcial / transferências finas | **parcial** | validar item a item |

**Estimativa:** próximo de **85%** com protocolo público + processo + relatórios; gap duro residual: WhatsApp produção + credenciadas se não configuradas.

```bash
php packages/portabilis/pre-matricula-digital/docs/laguna/onda-1/run-tests.php
```
