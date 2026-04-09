# 🚀 Checklist de Ajustes — Pagespeed Mobile

Projeto: AMAC — Chaveiro e Acessórios  
Objetivo: Elevar desempenho Mobile de ~73 para ≥ 90  
Regra principal: NÃO alterar visual nem estrutura do layout

---

# 📊 BASELINE INICIAL

Antes de iniciar os ajustes:

[ ] Criar branch dedicada

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
[ ] style.css  
[ ] menu.css  
[ ] hero.css  
[ ] servicos.css  
[ ] footer-config.css  
[ ] outros CSS carregados  

---

## Coverage JS

[ ] Executar Coverage Scripts  
[ ] Identificar scripts não utilizados  

Arquivos esperados:

[ ] script.js  
[ ] bootstrap.js  
[ ] plugins externos  
[ ] scripts duplicados  

---

# 🧱 FASE 2 — ORGANIZAÇÃO DO style.css

Objetivo: Limpar e organizar o CSS principal.

---

## Estrutura padrão

Organizar style.css em blocos:

[ ] BASE  
[ ] LAYOUT  
[ ] COMPONENTES  
[ ] PÁGINAS  
[ ] UTILITÁRIOS  

---

## Limpeza

[ ] Remover CSS duplicado  
[ ] Remover CSS não utilizado  
[ ] Remover regras antigas  
[ ] Garantir que nenhuma mudança visual ocorra  

Arquivo afetado:

assets/css/style.css  

---

# 🧩 FASE 3 — OTIMIZAÇÃO DO BOOTSTRAP

Objetivo: Reduzir tamanho do Bootstrap carregado.

---

## Bootstrap Custom

Criar:

assets/css/bootstrap-custom.css  

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
[ ] Garantir carregamento no footer  
[ ] Remover bloqueio de renderização  

---

## CSS

[ ] Identificar CSS crítico  
[ ] Aplicar preload no CSS principal  
[ ] Carregar CSS secundário de forma assíncrona  

---

## Fontes

[ ] Usar display=swap  
[ ] Reduzir famílias de fontes  
[ ] Evitar múltiplas variações  

---

# 📱 FASE 6 — OTIMIZAÇÃO ESPECÍFICA PARA MOBILE

Objetivo: Reduzir peso apenas no mobile.

---

## Desativar recursos pesados

Se existirem:

[ ] autoplay no hero  
[ ] animações pesadas  
[ ] scripts decorativos  
[ ] efeitos visuais não essenciais  
[ ] bibliotecas desnecessárias  

---

## Verificações

[ ] Nenhuma alteração visual  
[ ] Nenhuma quebra de layout  

---

# 🖼️ FASE 7 — OTIMIZAÇÃO DE IMAGENS (CRÍTICO PARA LCP)

Objetivo: Melhorar Largest Contentful Paint.

---

## Hero

[ ] Criar versão mobile da imagem  
[ ] Usar WebP ou AVIF  
[ ] Definir dimensões fixas  
[ ] Aplicar preload  

---

## Demais imagens

[ ] Usar lazy loading  
[ ] Converter para WebP  
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

Data: ______  

Alteração:

_________________________________

Arquivo afetado:

_________________________________

Resultado:

_________________________________

---