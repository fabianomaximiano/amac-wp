# 🚀 Checklist de Ajustes — Pagespeed Mobile

Projeto: AMAC — Chaveiro e Acessórios  
Objetivo: Elevar desempenho Mobile de ~73 para ≥ 90  
Regra principal: NÃO alterar visual nem estrutura do layout

---

# 📊 BASELINE INICIAL

Antes de iniciar os ajustes:

[x] Criar branch dedicada

git checkout -b pagespeed-ajustes

[ ] Executar Pagespeed Mobile  
[ ] Registrar score inicial  
[ ] Registrar métricas:

Score Mobile Inicial: ______  
LCP Inicial: ______  
CLS Inicial: ______  
TBT Inicial: ______  

---

# 🧭 FASE 1 — MAPEAMENTO REAL DE USO

Objetivo: Identificar o que realmente está sendo usado.

---

## Coverage CSS

[ ] Abrir Chrome DevTools  
[ ] Acessar:

F12 → Coverage  
Ctrl + Shift + R  

[ ] Exportar lista CSS usada  
[ ] Identificar arquivos com maior desperdício  

Arquivos esperados:

[ ] bootstrap.css  
[x] style.css  
[x] menu.css  
[x] hero.css  
[x] servicos.css  
[x] footer-config.css  
[x] outros CSS carregados  

---

## Coverage JS

[ ] Executar Coverage Scripts  
[ ] Identificar scripts não utilizados  

Arquivos esperados:

[x] script.js  
[ ] bootstrap.js  
[ ] plugins externos  
[ ] scripts duplicados  

---

# 🧱 FASE 2 — ORGANIZAÇÃO DO style.css

Objetivo: Limpar e organizar o CSS principal.

---

## Estrutura padrão

Organizar style.css em blocos:

[x] BASE  
[ ] LAYOUT  
[ ] COMPONENTES  
[ ] PÁGINAS  
[x] UTILITÁRIOS  

---

## Limpeza

[x] Remover CSS duplicado  
[x] Remover CSS não utilizado  
[x] Remover regras antigas  
[x] Garantir que nenhuma mudança visual ocorra  

Arquivo afetado:

assets/css/style.css  

---

# 🧩 FASE 3 — OTIMIZAÇÃO DO BOOTSTRAP

Objetivo: Reduzir tamanho do Bootstrap carregado.

---

## Bootstrap Custom

Criar:

assets/css/bootstrap-custom.css  

[ ] Criar arquivo  

---

## Remover componentes não usados

Possíveis remoções:

[ ] carousel  
[ ] modal  
[ ] dropdown avançado  
[ ] alerts  
[ ] toasts  
[ ] tables (se não usadas)  
[ ] print styles  
[ ] utilities desnecessárias  

---

## Manter apenas:

[ ] grid  
[ ] container  
[ ] row  
[ ] col  
[ ] buttons  
[ ] navbar  
[ ] utilities essenciais  

---

# 🧹 FASE 4 — MINIFICAÇÃO

Objetivo: Reduzir tamanho dos arquivos.

---

## CSS

Gerar:

[ ] style.min.css  
[ ] menu.min.css  
[ ] hero.min.css  
[ ] servicos.min.css  
[ ] footer-config.min.css  
[ ] bootstrap-custom.min.css  

---

## JS

Gerar:

[ ] script.min.js  
[ ] bootstrap.min.js  

---

## Garantir enqueue correto

[ ] Atualizar functions.php  
[ ] Usar versões .min  

Arquivo afetado:

functions.php  

---

# ⚙️ FASE 5 — OTIMIZAÇÃO DE RENDERIZAÇÃO

Objetivo: Melhorar carregamento no navegador.

---

## JavaScript

[ ] Adicionar defer nos scripts  
[x] Garantir carregamento no footer  
[ ] Remover bloqueio de renderização  

---

## CSS

[ ] Identificar CSS crítico  
[ ] Aplicar preload no CSS principal  
[ ] Carregar CSS secundário de forma assíncrona  

---

## Fontes

[x] Usar display=swap  
[ ] Reduzir famílias de fontes  
[ ] Evitar múltiplas variações  

---

# 📱 FASE 6 — OTIMIZAÇÃO ESPECÍFICA PARA MOBILE

Objetivo: Reduzir peso apenas no mobile.

---

## Desativar recursos pesados

Se existirem:

[x] autoplay no hero  
[ ] animações pesadas  
[ ] scripts decorativos  
[x] efeitos visuais não essenciais  
[ ] bibliotecas desnecessárias  

---

## Verificações

[x] Nenhuma alteração visual  
[x] Nenhuma quebra de layout  

---

# 🖼️ FASE 7 — OTIMIZAÇÃO DE IMAGENS (CRÍTICO PARA LCP)

Objetivo: Melhorar Largest Contentful Paint.

---

## Hero

[x] Criar versão mobile da imagem  
[x] Usar WebP ou AVIF  
[ ] Definir dimensões fixas  
[ ] Aplicar preload  

---

## Demais imagens

[ ] Usar lazy loading  
[x] Converter para WebP  
[ ] Reduzir tamanho real  

---

# 📦 FASE 8 — CACHE E SERVIDOR

Objetivo: Melhorar entrega dos arquivos.

---

## .htaccess

[ ] Cache ativado  
[ ] Brotli ou Gzip ativo  
[ ] Cache-Control configurado  
[ ] Expire Headers definidos  

Arquivo:

.htaccess  

---

# 📊 FASE 9 — VALIDAÇÃO FINAL

Executar novamente:

[ ] Pagespeed Mobile  
[ ] Lighthouse  
[ ] Coverage  

---

Registrar resultados:

Score Mobile Final: ______  
LCP Final: ______  
CLS Final: ______  
TBT Final: ______  

---

# 🎯 META FINAL

Objetivo mínimo:

Score Mobile ≥ 90

Sem:

❌ alterar visual  
❌ alterar layout  
❌ alterar UX  

---

# 🧾 HISTÓRICO DE AJUSTES

Registrar cada alteração feita:

---

# 🧾 HISTÓRICO DE AJUSTES

Registrar cada alteração feita:

---

Data: 2026-04-09  

Alteração:

Criação da branch dedicada para os ajustes de performance Pagespeed Mobile.

Arquivo afetado:

Repositório / Git

Resultado:

Ambiente isolado criado para realizar otimizações sem afetar a branch principal.

---

Data: 2026-04-09  

Alteração:

Reorganização do CSS principal, separando responsabilidades e removendo regras duplicadas do style.css.

Arquivo afetado:

assets/css/style.css  

Resultado:

Arquivo base mais enxuto e preparado para carregamento modular.

---

Data: 2026-04-09  

Alteração:

Separação dos estilos específicos em arquivos dedicados: hero.css, modal.css, whatsapp.css e kanban.css.

Arquivo afetado:

assets/css/hero.css  
assets/css/modal.css  
assets/css/whatsapp.css  
assets/css/kanban.css  

Resultado:

CSS modularizado, facilitando manutenção e permitindo carregamento condicional por contexto.

---

Data: 2026-04-09  

Alteração:

Revisão e organização dos CSS de menu, serviços, produtos, FAQ, avaliações, sobre e rodapé.

Arquivo afetado:

assets/css/menu.css  
assets/css/menu-estilo.css  
assets/css/servicos.css  
assets/css/produtos.css  
assets/css/faq.css  
assets/css/avaliacoes.css  
assets/css/sobre.css  
assets/css/footer-config.css  

Resultado:

Padronização estrutural dos estilos e preparação para otimização seletiva.

---

Data: 2026-04-10  

Alteração:

Atualização do functions.php para carregar CSS de forma condicional por contexto (home, serviços, produtos).

Arquivo afetado:

functions.php  

Resultado:

Redução do carregamento de CSS desnecessário fora dos contextos onde são usados.

---

Data: 2026-04-10  

Alteração:

Separação do JavaScript em arquivos independentes por responsabilidade.

Arquivo afetado:

assets/js/script.js  
assets/js/modal.js  
assets/js/hero.js  
assets/js/kanban.js  

Resultado:

Scripts modularizados e preparados para carregamento seletivo.

---

Data: 2026-04-10  

Alteração:

Atualização do functions.php para controle de carregamento de scripts por contexto.

Arquivo afetado:

functions.php  

Resultado:

hero.js passou a carregar apenas na Home e modal.js permaneceu global.

---

Data: 2026-04-10  

Alteração:

Bloqueio do carrossel no mobile, removendo controles e exibindo apenas a primeira imagem.

Arquivo afetado:

assets/js/hero.js  

Resultado:

Redução de processamento no mobile e melhora potencial no LCP.

---