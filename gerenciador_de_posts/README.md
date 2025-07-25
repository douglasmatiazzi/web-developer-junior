# Gerenciador de Posts de Blog

Atividade 1 – Projeto para avaliação técnica da vaga de Desenvolvedor Web Júnior

---

## 📍 Deploy Online

Acesse para testar:  
🔗 [https://cf6e04737df2.ngrok-free.app/](https://cf6e04737df2.ngrok-free.app/)

---

## 📚 Sobre o Projeto

Sistema monolítico construído em CodeIgniter 4 com Eloquent ORM, que permite a visualização pública de posts de blog e gerencia as ações de criação, edição e exclusão de posts mediante autenticação de usuário. O layout é responsivo, utilizando Bootstrap e jQuery, e segue as melhores práticas de organização de código.

---

## ✅ Pré-requisitos

- PHP 8.x
- Composer
- MySQL 5.7 ou superior
- Git
- Extensões PHP: `pdo`, `pdo_mysql`, `mbstring`, `intl`, `fileinfo`, `openssl`

> Dica: Usando XAMPP, Laragon, MAMP ou WAMP já vem tudo pronto.

---

## 🚀 Como rodar localmente

1. **Clone o repositório e acesse a pasta do projeto:**
    ```sh
    git clone https://github.com/douglasmatiazzi/web-developer-junior.git
    cd web-developer-junior/gerenciador_de_posts
    ```

2. **Instale as dependências:**
    ```sh
    composer install
    ```

3. **Configure o ambiente:**
    - Copie o arquivo `.env.example` para `.env`:
      ```sh
      cp .env.example .env
      ```
    - Edite o `.env` e ajuste as variáveis de conexão com o MySQL:
      ```
      database.default.hostname = localhost
      database.default.database = <nome_do_banco>
      database.default.username = <seu_usuario>
      database.default.password = <sua_senha>
      ```

4. **Crie o banco de dados vazio no MySQL** (mesmo nome do `.env`).

5. **Execute as migrations para criar as tabelas:**
    ```sh
    php spark migrate
    ```

6. **Inicie o servidor de desenvolvimento:**
    ```sh
    php spark serve
    ```
    O sistema estará disponível em [http://localhost:8080](http://localhost:8080)

7. **Cadastre um usuário pelo sistema para criar, editar ou apagar posts.  
A visualização dos posts é pública.**

---

## 🗄️ Diagrama do Banco de Dados

![](https://i.imgur.com/mazFLJ3.png)

---

## 🎯 Funcionalidades Entregues

- Visualização pública dos posts
- Cadastro e login de usuário para criar, editar e apagar seus próprios posts
- Apenas usuários autenticados podem criar, editar ou apagar posts
- Apenas o autor pode editar/excluir seus próprios posts
- CRUD completo de posts (título, imagem, descrição em HTML)
- Layout responsivo com Bootstrap 5 e jQuery
- Código limpo, seguro, sem arquivos/testes desnecessários
- Models utilizando Eloquent ORM

---

## 📝 Observações Técnicas

- Upload restrito a arquivos de imagem e html
- Todas as ações sensíveis protegidas por sessão de usuário autenticado
- Feedback de validação exibido ao usuário
- Migrations inclusas e prontas para uso
- Deploy funcional na URL acima

---

## 👨‍💻 Autor

Douglas Aguiar

---
