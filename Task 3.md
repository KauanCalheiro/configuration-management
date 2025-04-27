# Task 3 - Unit Tests

🔗 Link: [thorngym.com](http://thorngym.com/)

**NOTA:**

- 📧 Colocado meu e-mail e senha de acesso ao sistema, para que o professor possa acessar a aplicação e verificar as funcionalidades implementadas.
- 📤 Foi usado o e-mail real para poder enviar as notificações.

**Login:** `kauan.calheiro@universo.univates.br`  
**Senha:** `admin`

📂 **Repositório:** [GitHub - Task 3 Repository](https://github.com/KauanCalheiro/configuration-management.git)

---

## Melhorias no protótipo da Task 2

- [x] ✅ Completar o CRUD de tarefas:
  - [x] ➕ Criar nova tarefa
  - [x] 👀 Visualizar detalhes da tarefa
  - [x] ✏️ Editar tarefa existente
  - [x] 🗑️ Excluir tarefa
- [x] 🔐 Adicionar login ao sistema
- [x] 📬 Implementar envio de e-mail após criação ou atualização de uma tarefa
- [x] 🗂️ Adicionar filtros:
  - [x] 📅 Filtro por data
  - [x] 📌 Filtro por status
- [x] 📄 Implementar exportação das tarefas para PDF

---

## Testes Unitários

- [x] 🧪 Desenvolver 20 testes unitários

📝 **Testes de Task**
1. ✅ **CREATE TASK**: Testar criação de uma nova tarefa válida
2. ⚠️ **CREATE TASK MISSING FIELDS**: Testar tentativa de criação com campos obrigatórios faltando
3. ✅ **UPDATE TASK**: Testar atualização de descrição, status ou datas de uma tarefa existente
4. ❌ **UPDATE TASK INVALID ID**: Testar atualização de uma tarefa inexistente
5. 🗑️ **DELETE TASK**: Testar exclusão lógica (soft delete) de uma tarefa
6. 🔎 **GET TASK BY ID**: Testar busca de uma tarefa específica por ID
7. ❌ **GET TASK INVALID ID**: Testar erro ao buscar tarefa inexistente
8. 📋 **LIST TASKS**: Testar listagem de todas tarefas
9. ✅ **LIST TASKS WITH VALID FILTER**: Testar listagem filtrada com filtro válido
10. ⚠️ **LIST TASKS WITH INVALID FILTER**: Testar listagem filtrada com filtro inválido
11. 🔍 **SEARCH TASK BY DESCRIPTION**: Testar busca usando o `toSearchableArray`
12. 📤 **EMAIL ON TASK CREATION**: Testar disparo de e-mail após criação
13. ✉️ **EMAIL ON TASK UPDATE**: Testar disparo de e-mail após atualização
14. 📄 **PDF EXPORT TASKS**: Testar geração de exportação em PDF

🔒 **Testes de Autenticação / User**
15. 🔑 **VALID LOGIN**: Testar login com credenciais corretas
16. ❌ **INVALID LOGIN**: Testar erro de login com credenciais erradas
17. 👤 **RETURN LOGGED USER**: Testar retorno do usuário logado
18. 🚫 **ACCESS PROTECTED ROUTES WITHOUT LOGIN**: Testar proteção de rotas (sem autenticação)
19. ✅ **ACCESS PROTECTED ROUTES WITH LOGIN**: Testar acesso a rotas protegidas (com autenticação)
20. 🔓 **LOGOUT**: Testar logout (encerrar sessão do usuário)

![alt text](image.png)

---

## Publicação

- [x] 🚀 Publicar a nova versão da aplicação na máquina virtual (VM)

<br>
<br>
<br>