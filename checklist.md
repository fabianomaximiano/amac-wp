# ✅ CHECKLIST DO PROJETO - TEMA CHAVEIRO / SaaS CHAVEIRO

---

## 🔧 ESTRUTURA GERAL

- [x] Estrutura modular com arquivos em `inc/`
- [x] `functions.php` organizado carregando módulos separados
- [x] Setup do tema separado em arquivo próprio
- [x] Separação entre:
  - [x] PHP → lógica e renderização
  - [x] CSS → estilos
  - [x] JS → comportamentos
- [x] Estrutura pensada para evolução como produto/SaaS

### Arquivos/módulos carregados atualmente
- [x] `setup.php`
- [x] `menu.php`
- [x] `hero.php`
- [x] `admin-hero.php`
- [x] `servicos.php`
- [x] `sobre.php`
- [x] `faq.php`
- [x] `admin-faq.php`
- [x] `footer-config.php`
- [x] `whatsapp-float.php`
- [x] `admin-menu.php`
- [x] `clientes.php`
- [x] `leads.php`
- [x] `cidades.php`

---

## 🧱 SETUP DO TEMA

- [x] Suporte a `title-tag`
- [x] Suporte a `post-thumbnails`
- [x] Suporte a HTML5
- [x] Suporte a logo personalizada
- [x] Registro de menu principal

---

## 🖼️ IMAGENS / MÍDIA

- [x] Registro de tamanhos nativos:
  - [x] `hero_desktop`
  - [x] `hero_mobile`
  - [x] `sobre_quadrado`
- [x] Conversão automática de uploads JPEG/PNG para WebP
- [x] Uso de crop quadrado para imagem da seção Sobre

### 🔜 Melhorias futuras
- [ ] Ajustar uso prático dos tamanhos nativos diretamente no hero
- [ ] Estratégia mais completa para imagens responsivas
- [ ] Lazy load mais controlado

---

## 🎨 TIPOGRAFIA

- [x] Google Fonts dinâmico
- [x] Fonte do body configurável
- [x] Peso do body configurável
- [x] Tamanho do body configurável
- [x] Estilo do body configurável
- [x] Fonte do H1 configurável
- [x] Peso do H1 configurável
- [x] Tamanho do H1 configurável
- [x] Fonte do H2 configurável
- [x] Peso do H2 configurável
- [x] Tamanho do H2 configurável
- [x] Variáveis CSS globais geradas no `wp_head`

### 🔜 Melhorias futuras
- [ ] Dropdown fechado de fontes para evitar erro manual
- [ ] Line-height configurável
- [ ] Letter-spacing configurável
- [ ] Mais níveis tipográficos

---

## 🎨 CORES / PRESETS

- [x] Variáveis CSS globais para cores principais
- [x] Presets de cores prontos
  - [x] padrão
  - [x] vermelho
  - [x] verde
- [x] Aplicação de preset via AJAX
- [x] Estrutura para personalização visual do tema

### 🔜 Melhorias futuras
- [ ] Mais presets
- [ ] Presets por nicho
- [ ] Exportar/importar preset

---

## 🧭 MENU / HEADER

- [x] Menu dinâmico via WordPress
- [x] Registro de menu principal
- [x] Controle visual por CSS custom properties
- [x] Menu transparente
- [x] Cor de fundo do menu
- [x] Cor do menu ao scroll
- [x] Cor do texto do menu
- [x] Cor hover do menu

### 🔜 Melhorias futuras
- [ ] Revisão final do CTA do header conforme layout desejado
- [ ] Melhor controle visual do botão do topo via painel
- [ ] Mega menu simples
- [ ] Ícones no menu

---

## 🦸 HERO

### Estado atual implementado
- [x] Seção hero ativável/desativável
- [x] Estrutura com carrossel Bootstrap
- [x] Até 4 slides
- [x] Imagem principal por slide
- [x] Imagem mobile opcional por slide
- [x] Título por slide
- [x] Subtítulo por slide
- [x] Botão por slide
- [x] Link do botão por slide
- [x] Cor do botão por slide
- [x] Overlay no hero
- [x] Altura 100vh
- [x] Background com `cover`

### Estado visual/funcional atual do arquivo enviado
- [x] Hero ainda usa formulário fixo lateral dentro do banner
- [x] Campo oculto de origem no formulário do hero
- [x] Campo oculto de URL de origem no formulário do hero

### 🔜 Melhorias futuras
- [ ] Migrar definitivamente de formulário fixo para modal
- [ ] Limpar CTA duplicado no hero
- [ ] Melhorar experiência em tablet/mobile
- [ ] Revisar alinhamento final do conteúdo

---

## 📝 FORMULÁRIO DE LEADS

- [x] Formulário de captação no hero
- [x] Campos:
  - [x] nome
  - [x] telefone
  - [x] tipo de serviço
  - [x] CEP
  - [x] cidade
  - [x] bairro
  - [x] urgência
  - [x] mensagem
  - [x] origem
  - [x] URL de origem
- [x] Envio via AJAX
- [x] Retorno JSON com mensagem
- [x] Link de WhatsApp gerado automaticamente após envio
- [x] Validação básica de obrigatórios no back-end

### 🔜 Melhorias futuras
- [ ] Validação visual mais avançada no front-end
- [ ] Modal de atendimento como fluxo principal
- [ ] Melhor feedback de carregamento/envio

---

## 📱 WHATSAPP

- [x] Número de WhatsApp configurável no tema
- [x] Botão flutuante lateral
- [x] Barra fixa no rodapé com CTA para WhatsApp
- [x] Texto do botão flutuante configurável
- [x] Texto do botão do rodapé configurável
- [x] Link do WhatsApp puxado do tema

### 🔜 Melhorias futuras
- [ ] Mais controles pelo Customizer
- [ ] Exibição condicional por dispositivo
- [ ] Mensagem inicial dinâmica por contexto

---

## 🧰 SERVIÇOS

### Seção de serviços
- [x] Seção ativável/desativável
- [x] Título configurável
- [x] Subtítulo configurável
- [x] Fundo configurável por:
  - [x] cor sólida
  - [x] gradiente
  - [x] imagem
- [x] Overlay configurável
- [x] Cor base do texto
- [x] Cor do título
- [x] Cor do subtítulo
- [x] Cor do card
- [x] Cor do texto do card

### CPT Serviços
- [x] Custom Post Type `servicos`
- [x] Interface no admin
- [x] Suporte a título
- [x] Suporte a editor
- [x] Suporte a ordem (`page-attributes`)
- [x] Suporte a imagem destacada
- [x] Suporte a REST

### Metabox do serviço
- [x] Exibir/ocultar serviço na seção
- [x] Tipo de mídia:
  - [x] ícone
  - [x] imagem
- [x] Classe de ícone
- [x] Subtítulo
- [x] Descrição curta

### Renderização
- [x] Loop dinâmico
- [x] Ordenação por `menu_order` e data
- [x] Card com topo por imagem
- [x] Card com topo por ícone
- [x] Uso de resumo customizado
- [x] Fallback para excerpt

### 🔜 Melhorias futuras
- [ ] CTA individual por serviço
- [ ] Mais variações de layout dos cards
- [ ] Filtros/categorias de serviço

---

## 👤 SOBRE

- [x] Seção Sobre ativável/desativável
- [x] Imagem configurável
- [x] Formato da imagem:
  - [x] circular
  - [x] quadrada
  - [x] arredondada
- [x] Título configurável
- [x] Subtítulo configurável
- [x] Descrição configurável
- [x] Renderização em 2 colunas
- [x] Crop quadrado nativo para imagem

### 🔜 Melhorias futuras
- [ ] Mais opções de layout
- [ ] Mais controle visual da seção

---

## ❓ FAQ

- [x] Seção FAQ no Customizer
- [x] Título configurável
- [x] Controle para exibir ícone no título
- [x] Classe do ícone do título configurável
- [x] Controle para exibir ícones nas perguntas
- [x] Classe do ícone das perguntas configurável
- [x] Cor de fundo da seção
- [x] Cor do título
- [x] Cor do ícone do título
- [x] Cor de fundo da pergunta
- [x] Cor do texto da pergunta
- [x] Cor de fundo da resposta
- [x] Cor do texto da resposta
- [x] Cor do ícone das perguntas
- [x] Até 10 perguntas
- [x] Até 10 respostas
- [x] CSS dinâmico da FAQ no `wp_head`

### 🔜 Melhorias futuras
- [ ] Revisar render da seção FAQ conforme layout final
- [ ] Melhorias visuais no accordion
- [ ] Controle de ativar/desativar seção, se ainda não existir no render

---

## 🦶 RODAPÉ

### Rodapé no Customizer
- [x] Seção completa de rodapé no painel
- [x] Agrupamento visual de campos no Customizer
- [x] Cores principais do rodapé:
  - [x] fundo
  - [x] texto
  - [x] títulos
  - [x] links
  - [x] linha divisória

### Ícones sociais
- [x] Cor do ícone
- [x] Cor de fundo do ícone
- [x] Cor da borda
- [x] Cor do hover
- [x] Cor de fundo no hover
- [x] Estilo do ícone:
  - [x] somente ícone
  - [x] círculo
  - [x] quadrado
  - [x] quadrado arredondado

### Endereço
- [x] CEP
- [x] Rua
- [x] Número
- [x] Complemento
- [x] Bairro
- [x] Cidade
- [x] Estado
- [x] Busca automática de endereço por CEP no Customizer

### Atendimento
- [x] Horário de atendimento

### Contato
- [x] Telefone 1
- [x] Telefone 2
- [x] E-mail

### Redes sociais
- [x] Facebook
- [x] Instagram
- [x] LinkedIn
- [x] X
- [x] Sanitização dos usuários/identificadores
- [x] Geração de URLs sociais

### CSS / UX do painel
- [x] Estilo customizado do painel do rodapé no Customizer
- [x] Scripts auxiliares no Customizer
  - [x] máscara/formatação de CEP
  - [x] máscara/formatação de telefone
  - [x] sanitização dos campos sociais

### 🔜 Melhorias futuras
- [ ] Garantir checklist do template visual do footer renderizado
- [ ] Revisão final do layout do footer público

---

## 🗂️ LEADS / CRM / ADMIN

### Tabela de leads
- [x] Criação automática da tabela `wp_chaveiro_leads`
- [x] Campos estruturados para captação comercial
- [x] Criação na ativação do tema
- [x] Garantia também no `init`

### Captura e automação
- [x] Salvar lead via AJAX
- [x] Sanitização dos campos
- [x] Definição automática de status inicial `novo`
- [x] Geração de mensagem para WhatsApp com dados do lead

### CRM
- [x] Página de leads no admin
- [x] Filtro por status
- [x] Busca por nome, telefone, cidade, bairro e serviço
- [x] Lista com status editável

### Kanban
- [x] Página de Kanban CRM
- [x] Colunas:
  - [x] novo
  - [x] contato
  - [x] fechado
- [x] Cards arrastáveis preparados para operação no front-end

### Menu administrativo
- [x] Menu principal “SaaS Chaveiro”
- [x] Dashboard
- [x] Clientes
- [x] Leads
- [x] Kanban CRM

### Dashboard
- [x] Total de leads
- [x] Total de novos
- [x] Total em contato
- [x] Total fechados

### 🔜 Melhorias futuras
- [ ] Melhor acabamento visual do dashboard
- [ ] Mais indicadores de performance
- [ ] Paginação/exportação de leads
- [ ] Histórico de movimentação

---

## 🔗 SHORTCODE / ESTRUTURA DE LANDING

- [x] Shortcode `[lp_chaveiro]`
- [x] Shortcode renderiza `index.php`
- [x] Base pronta para landing pages por shortcode

---

## 🎨 ESTILO / UX

- [x] Bootstrap 4 carregado
- [x] Font Awesome carregado
- [x] CSS principal do tema
- [x] CSS adicional opcional em:
  - [x] `assets/css/style.css`
  - [x] `assets/css/hero.css`
  - [x] `assets/css/faq.css`
  - [x] `assets/css/footer-config.css`
- [x] Responsividade básica implementada
- [x] Hero com estrutura visual responsiva
- [x] Botão flutuante e barra fixa de WhatsApp

### 🔜 Melhorias futuras
- [ ] Revisão final unificando o que está no `style.css` com o layout desejado
- [ ] Limpeza de estilos antigos do hero com formulário fixo
- [ ] Refinamento de UX em tablet/mobile

---

## ⚙️ PERFORMANCE

- [x] Versionamento por `filemtime` em CSS/JS
- [x] Google Fonts carregado dinamicamente
- [x] Conversão de imagens para WebP iniciada

### 🔜 Melhorias futuras
- [ ] Lazy load mais agressivo
- [ ] Minificação
- [ ] Remoção de CSS não utilizado
- [ ] Revisão de dependências

---

## 🧱 ARQUITETURA / VISÃO DE PRODUTO

- [x] Base preparada para múltiplos módulos
- [x] Base administrativa com CRM
- [x] Base de captação integrada ao WhatsApp
- [x] Estrutura compatível com ideia de SaaS
- [x] Base para múltiplos nichos locais

### 🔜 Evolução
- [ ] Sistema de templates por nicho
- [ ] Ativação/desativação avançada de seções
- [ ] Base multi-cliente mais completa
- [ ] Painel de configuração comercial por cliente

---

## 🚀 STATUS ATUAL REAL DO PROJETO

✔ Tema modular carregando vários módulos  
✔ Hero em carrossel implementado  
✔ Hero ainda com formulário fixo no arquivo enviado  
✔ Serviços com painel e CPT bem avançados  
✔ FAQ dinâmica com até 10 perguntas  
✔ Rodapé com painel muito avançado  
✔ WhatsApp flutuante e barra fixa implementados  
✔ Leads, CRM e Kanban funcionando na base do projeto  
✔ Presets de cor, fontes dinâmicas e WebP já iniciados  

---

## 🔥 PRÓXIMO FOCO RECOMENDADO

1. Consolidar o hero final (fixo x modal)  
2. Revisar header + CTA principal  
3. Finalizar render público do rodapé conforme painel  
4. Refinar UX mobile/tablet  
5. Evoluir CRM com mais relatórios e automações