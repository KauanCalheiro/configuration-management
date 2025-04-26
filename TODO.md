# Gerencia de Configuração

---

## Task 2 - Development and publishing

### Passo 1: Desenvolvimento da Aplicação

iar o projeto (qualquer linguagem de programação e banco de dados)

- [x] Criar uma tabela `tarefa` com os campos:
  - id
  - descricao
  - data_criacao
  - data_prevista
  - data_encerramento
  - situacao
- [x] Popular a tabela `tarefa` com 10 registros (via script de insert)
- [x] Desenvolver uma tela para exibir a listagem das tarefas cadastradas

### Passo 2: Publicação da Aplicação

- [x] Acessar a máquina virtual (VM)
- [x] Instalar as ferramentas necessárias:
  - [x] Compilador
  - [x] Banco de dados
  - [x] Linguagem de programação
  - [x] Bibliotecas necessárias
- [x] Implantar o projeto na VM, tornando-o público

### Passo 3: Documentação

#### Da aplicação

- [x] Documentar o número de classes da aplicação
- [x] Documentar a modelagem do banco de dados
- [x] Documentar a interface desenvolvida

#### Da publicação

- [x] Documentar o acesso à VM
- [x] Documentar a instalação de cada ferramenta
- [x] Documentar a implantação da aplicação
- [x] Informar a URL de acesso à aplicação

#### Dos tempos

- [x] Documentar o tempo gasto em:
  - [x] Desenvolvimento da aplicação
  - [x] Criação do ambiente na VM
  - [x] Publicação da aplicação

### Entrega Final

- [x] Gerar arquivo de documentação em formato PDF
- [x] Disponibilizar o link de acesso à aplicação na VM
- [x] Disponibilizar o link do repositório (Github)

---

## Task 3 - Unit Tests

### Melhorias no protótipo da Task 2

- [x] Completar o CRUD de tarefas:
  - [x] Criar nova tarefa
  - [x] Visualizar detalhes da tarefa
  - [x] Editar tarefa existente
  - [x] Excluir tarefa
- [x] Adicionar login ao sistema
- [x] Implementar envio de e-mail após criação ou atualização de uma tarefa
- [x] Adicionar filtros:
  - [x] Filtro por data
  - [x] Filtro por status
- [x] Implementar exportação das tarefas para PDF

### Testes Unitários

- [x] Desenvolver 20 testes unitários
      Aqui está sua listagem atualizada e corrigida conforme seus testes passaram:

      📝 Testes de Task
      1. CREATE TASK: Testar criação de uma nova tarefa válida
      2. CREATE TASK MISSING FIELDS: Testar tentativa de criação com campos obrigatórios faltando
      3. UPDATE TASK: Testar atualização de descrição, status ou datas de uma tarefa existente
      4. UPDATE TASK INVALID ID: Testar atualização de uma tarefa inexistente
      5. DELETE TASK: Testar exclusão lógica (soft delete) de uma tarefa
      6. GET TASK BY ID: Testar busca de uma tarefa específica por ID
      7. GET TASK INVALID ID: Testar erro ao buscar tarefa inexistente
      8. LIST TASKS: Testar listagem de todas tarefas
      9. LIST TASKS WITH VALID FILTER: Testar listagem filtrada com um filtro válido
      10. LIST TASKS WITH INVALID FILTER: Testar listagem filtrada com um filtro inválido
      11. SEARCH TASK BY DESCRIPTION: Testar busca usando o `toSearchableArray`
      12. EMAIL ON TASK CREATION: Testar disparo de e-mail após criação
      13. EMAIL ON TASK UPDATE: Testar disparo de e-mail após atualização
      14. PDF EXPORT TASKS: Testar geração de exportação em PDF

      🔒 Testes de Autenticação / User
      15. VALID LOGIN: Testar login com credenciais corretas
      16. INVALID LOGIN: Testar erro de login com credenciais erradas
      17. RETURN LOGGED USER: Testar retorno do usuário logado
      18. ACCESS PROTECTED ROUTES WITHOUT LOGIN: Testar proteção de rotas (sem autenticação)
      19. ACCESS PROTECTED ROUTES WITH LOGIN: Testar acesso a rotas protegidas (com autenticação)
      20. LOGOUT: Testar logout (encerrar sessão do usuário)

  ![alt text](image.png)

---

### Publicação

- [ ] Publicar a nova versão da aplicação na máquina virtual (VM)

---
