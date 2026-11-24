# ROADMAP — Ajustes Laguna na Pré-matrícula (TR 5.8)

> Produto: `portabilis/pre-matricula-digital` · **adaptação**, não pacote novo · Prioridade **P1** · Nota **B**  
> Fonte: `tmp/DOC-EXECUTIVO-PE-77-2026-LAGUNA-IEDUCAR.md`

## Visão

Partir do que já está operacional na pré-matrícula Portabilis (2.12) e fechar só o que o TR 5.8 de Laguna ainda exige para passar de ~B para ≥ 85% na PoC.

## Fases

### F0 · Matriz de gaps (obrigatória)

- Extrair checklist 5.8.x do OCR.
- Marcar cada item: **atende** (tela/API) · **gap** · **N/A**.
- Ordenar gaps pelo impacto no 85% (P0 da PoC vs. 30 dias).

### F1 · Gaps de consulta e transparência

- Completar consulta pública de protocolo/situação se o TR for além do que já existe.
- Ajustes de textos/comprovantes exigidos no edital.

### F2 · Gaps de canal (WhatsApp)

- Opt-in e notificações de andamento; integração com provedor já usado na operação Serventec, se houver.
- Não criar segundo “portal de fila”.

### F3 · Credenciadas / terceirizadas + previsão de vagas

- Incluir tipos de escola/processo exigidos.
- Relatórios de previsão de vagas e regramentos finos ainda faltantes.

### F4 · Apps-api + PoC

- Garantir que `buriti/i-educar-apps-api-package` leia status/fila/rematrícula deste pacote.
- Ensaio binário ≥ 85%; lista dos ≤ 15% para os 30 dias.

## Conformidade (2.12)

- Trabalhar **dentro** de `portabilis/pre-matricula-digital` (composer/provider já existentes).
- Manter GraphQL/Sanctum/Frontier; evitar schema paralelo Buriti.
- Compatibilidade com i-Educar **2.12**; validar após mudanças com a suíte do pacote (`pest`/testes existentes).

## Cobertura 100% dos requisitos (TR)

Fonte: [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) — **95 itens**.

Cada lote deve sair da PoC como **atende** ou entrar no plano de 30 dias.

### Lote R1 — itens 5.8.1 … 5.8.16 (15)

- `5.8.1`, `5.8.2`, `5.8.3`, `5.8.4`, `5.8.5`, `5.8.6`, `5.8.7`, `5.8.8`, `5.8.9`, `5.8.104`, `5.8.12`, `5.8.13`, `5.8.14`, `5.8.15`, `5.8.16`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Lote R2 — itens 5.8.17 … 5.8.31 (15)

- `5.8.17`, `5.8.18`, `5.8.19`, `5.8.20`, `5.8.21`, `5.8.22`, `5.8.23`, `5.8.24`, `5.8.25`, `5.8.26`, `5.8.27`, `5.8.28`, `5.8.29`, `5.8.30`, `5.8.31`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Lote R3 — itens 5.8.32 … 5.8.46 (15)

- `5.8.32`, `5.8.33`, `5.8.34`, `5.8.35`, `5.8.36`, `5.8.37`, `5.8.38`, `5.8.39`, `5.8.40`, `5.8.41`, `5.8.42`, `5.8.43`, `5.8.44`, `5.8.45`, `5.8.46`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Lote R4 — itens 5.8.47 … 5.8.61 (15)

- `5.8.47`, `5.8.48`, `5.8.49`, `5.8.50`, `5.8.51`, `5.8.52`, `5.8.53`, `5.8.54`, `5.8.55`, `5.8.56`, `5.8.57`, `5.8.58`, `5.8.59`, `5.8.60`, `5.8.61`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Lote R5 — itens 5.8.62 … 5.8.76 (15)

- `5.8.62`, `5.8.63`, `5.8.64`, `5.8.65`, `5.8.66`, `5.8.67`, `5.8.68`, `5.8.69`, `5.8.70`, `5.8.71`, `5.8.72`, `5.8.73`, `5.8.74`, `5.8.75`, `5.8.76`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Lote R6 — itens 5.8.77 … 5.8.91 (15)

- `5.8.77`, `5.8.78`, `5.8.79`, `5.8.80`, `5.8.81`, `5.8.82`, `5.8.83`, `5.8.84`, `5.8.85`, `5.8.86`, `5.8.87`, `5.8.88`, `5.8.89`, `5.8.90`, `5.8.91`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Lote R7 — itens 5.8.92 … 5.8.96 (5)

- `5.8.92`, `5.8.93`, `5.8.94`, `5.8.95`, `5.8.96`

- [ ] Implementar / validar / evidenciar na matriz PoC

### Gate 100%

- [ ] Todos os lotes R* com status atende ou gap≤30dias
- [ ] Soma atende ≥ 85% na demonstração

## Dependências

- Núcleo i-Educar (escolas, cursos, vagas/turnos conforme o processo).
- `buriti/i-educar-apps-api-package` só como consumidor.
- Exportação unificada (4.x) se o TR exigir formatos extras nos relatórios da fila.

## Riscos

- Tratar como pacote novo atrasa e duplica regra — **evitar**.
- OCR ruidoso: confirmar numeração 5.8.x antes de implementar “fantasma”.
- WhatsApp depende de provedor/credenciais de operação, não só de código.

## Pronto para PoC

Matriz 5.8 fechada + gaps F1–F3 necessários ao 85% mergeados no `pre-matricula-digital` + roteiro de demo.
