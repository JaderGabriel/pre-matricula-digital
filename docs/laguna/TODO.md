# TODO — Ajustes Laguna na Pré-matrícula (TR 5.8)

> Código em `portabilis/pre-matricula-digital` · **não** criar `buriti/i-educar-fila-pre-matricula-package`


## Onda 1 (finalizada 2026-11-24)

- [x] Matriz PoC / evidências / testes da onda
- [ ] Ensaio UI roteiro R1 (humano)

## Levantamento (fazer primeiro)

- [ ] Montar matriz 5.8.x (OCR) × telas/GraphQL atuais
- [ ] Listar só itens **gap** (ignorar o que já atende)
- [ ] Separar gaps “bloqueiam 85%” vs “cabem nos 30 dias”

## Gaps típicos do executivo Laguna (validar na matriz antes de codar)

- [ ] Consulta pública de situação/protocolo (completar se faltar algo do TR)
- [ ] WhatsApp (opt-in + eventos de status)
- [ ] Escolas credenciadas / terceirizadas no processo
- [ ] Relatórios de previsão de vagas
- [ ] Regramentos finos do TR ainda não cobertos (após matriz)

## Integração (sem novo pacote de fila)

- [ ] Documentar campos/queries já usados pela apps-api
- [ ] Expor apenas o que faltar em `buriti/i-educar-apps-api-package` (consumidor)

## Cobertura 100% do TR

- [ ] Percorrer 100% de [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) (95 itens) e marcar atende/gap/N/A

- [ ] Abrir tarefas para **cada gap** (ou agrupar com IDs explícitos)

- [ ] Evidências de PoC por item atende

- [ ] Lista dos ≤15% com datas ≤30 dias

### Lotes (mesmo do ROADMAP)

- [ ] Lote R1: 5.8.1 … 5.8.16

- [ ] Lote R2: 5.8.17 … 5.8.31

- [ ] Lote R3: 5.8.32 … 5.8.46

- [ ] Lote R4: 5.8.47 … 5.8.61

- [ ] Lote R5: 5.8.62 … 5.8.76

- [ ] Lote R6: 5.8.77 … 5.8.91

- [ ] Lote R7: 5.8.92 … 5.8.96

## Gate PoC

- [ ] `REQUISITOS-TR.md` 100% classificado
- [ ] ≥ 85% atende com evidência
- [ ] ≤ 15% gap com plano ≤ 30 dias
- [ ] Roteiro binário ensaiado

## Referências

- `tmp/DOC-EXECUTIVO-PE-77-2026-LAGUNA-IEDUCAR.md` (linha 5.8)
- Pacote: `packages/portabilis/pre-matricula-digital/`
- Índice Laguna: `packages/buriti/PE-77-2026-LAGUNA.md`
