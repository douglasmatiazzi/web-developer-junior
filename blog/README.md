# Blog Público – Visualização de Posts

Atividade 2 – Projeto para avaliação técnica da vaga de Desenvolvedor Web Júnior

---

## 📍 Deploy Online

Acesse para testar (Como a plataforma é grátis, deve-se clicar em "Visit Site" na tela inicial do ngrok, então o site é redirecionado ao projeto):  
🔗 [https://905737b2728f.ngrok-free.app/blog_publico](https://905737b2728f.ngrok-free.app/blog_publico)

---

## 📚 Sobre o Projeto

Aplicação frontend estática, construída com HTML, Bootstrap e jQuery, que consome a API pública da aplicação principal (`gerenciador_de_posts`) para exibir os posts cadastrados.  
O sistema oferece visualização pública dos posts com busca em tempo real, filtro por autor e ordenação por data.

---

## ✅ Pré-requisitos

- PHP 8.x (para usar o servidor embutido)
- Navegador moderno
- Backend rodando em paralelo (atividade 1 – `php spark serve`)

---

## 🚀 Como rodar localmente

1. **Certifique-se de que o Gerenciador de Posts está rodando:**
    Instruções em gerenciador-de-posts/README.md.

2. **Abra outro terminal e rode o blog público:**
    ```sh
    cd web-developer-junior/blog_publico
    php -S localhost:3000
    ```

3. **Acesse o blog no navegador:**
    - [http://localhost:3000](http://localhost:3000)

---

## 📁 Estrutura de Pastas

```
blog_publico/
├── assets/
│   ├── css/
│   │   └── styles.css      # Estilos customizados
│   └── js/
│       └── scripts.js      # Lógica JS para consumir a API
├── index.html              # Página principal com listagem e filtros
├── post.html               # Página de detalhes do post
└── README.md               # Instruções do projeto
```

## 🎯 Funcionalidades Entregues

- Listagem pública de posts com:
  - Título
  - Imagem
  - Autor e data
  - Trecho do conteúdo
- Página de detalhes do post
- Busca por título em tempo real (AJAX)
- Filtro por autor
- Ordenação por data (mais recentes primeiro)
- Botão para limpar filtros
- Layout responsivo com Bootstrap 5
- Integração direta com a API da atividade 1 (`/api/posts`)

---

## 📝 Observações Técnicas

- A busca e os filtros são feitos em tempo real via jQuery e `fetch`
- O `scripts.js` permite configurar a `baseURL` da API para ambiente local ou produção
- Não é necessário banco de dados neste projeto – tudo é carregado da API
- Nenhuma dependência externa além do Bootstrap e jQuery CDN
- Compatível com dispositivos móveis

---

## 👨‍💻 Autor

Douglas Aguiar

---
