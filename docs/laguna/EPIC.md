# EPIC — Ajustes Laguna na Pré-matrícula Digital (TR 5.8)

| Campo | Valor |
| --- | --- |
| Produto base | `portabilis/pre-matricula-digital` (adaptar — **não** criar pacote Buriti novo) |
| Namespace | `iEducar\Packages\PreMatricula\` |
| TR Laguna | **5.8** |
| Prioridade | **P1** |
| Nota atual (executivo) | **B** (~70–84%; fechar para ≥ 85%) |
| Fonte | `tmp/DOC-EXECUTIVO-PE-77-2026-LAGUNA-IEDUCAR.md` |
| Regra de ouro | PoC ≥ 85% no módulo · gaps ≤ 15% em ≤ 30 dias |
| Alvo runtime | i-Educar **2.12** · PHP ≥ 8.3 · Laravel 13 |

## Objetivo

Levantamento **item a item** do TR 5.8 × o que a pré-matrícula Portabilis **já faz**, e implementar **somente os gaps** necessários para Laguna (WhatsApp, escolas credenciadas/terceirizadas, consulta pública, previsão de vagas e regramentos finos). Alterações entram no próprio pacote `portabilis/pre-matricula-digital` (fork/branch de evolução Serventec/Buriti), não num pacote paralelo.

## O que NÃO é este EPIC

- Greenfield de fila/pré-matrícula.
- Novo `buriti/i-educar-fila-*-package`.
- UI Android/iOS (consumo via `buriti/i-educar-apps-api-package`).
- Reescrever GraphQL/Lighthouse ou o fluxo principal de inscrição que já atende boa parte do 5.8.

## Cobertura 100% do TR

Este EPIC cobre **todos** os requisitos do módulo(s) 5.8 listados em [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) (95 itens OCR).

- PoC: ≥ **85%** demonstráveis e operacionais.
- Até **15%** restante: produção em ≤ **30 dias**, sem ônus.
- Nenhum item do `REQUISITOS-TR.md` pode ficar fora do `ROADMAP.md` / `TODO.md` (direto ou por grupo rastreável).

## Épicos filhos (só gaps)

1. **Matriz 5.8.x** — checklist binário (já atende / gap / N/A) sobre o OCR do Anexo I.
2. **Consulta pública** — protocolo/status se ainda não cobrir o texto Laguna.
3. **WhatsApp** — notificações/opt-in exigidos pelo TR (integração; não reinventar a fila).
4. **Credenciadas / terceirizadas** — participação de escolas nesse perfil no processo.
5. **Relatórios de previsão de vagas** e regramentos finos faltantes.
6. **Contrato para apps-api** — expor status/fila/rematrícula já existentes (e os novos campos) sem duplicar regra de negócio.

## Critérios de aceite (PoC)

- [ ] Checklist [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) com **100%** dos itens classificados (atende / gap / N/A)
- [ ] Itens **atende** demonstráveis na PoC (≥ 85% do módulo 5.8)
- [ ] Itens **gap** ≤ 15% com plano ≤ 30 dias em produção, sem ônus
- [ ] Nenhum requisito do TR omitido da matriz


## Padrão técnico

| Item | Valor |
| --- | --- |
| Onde codar | `packages/portabilis/pre-matricula-digital/` |
| Stack já usada | Lighthouse/GraphQL, Sanctum, Frontier (manter) |
| Migrations | no pacote Portabilis; respeitar tenancy do app 2.12 |
| Apps | apenas endpoints/dados consumidos por `buriti/i-educar-apps-api-package` |
| Referência Buriti (geral) | `packages/buriti/PADRAO-PACOTE-2.12.md` (para o apps-api; aqui o dono é o pacote Portabilis) |
