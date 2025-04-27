# 📚 Guia de Execução do Projeto

Siga os passos abaixo para executar o projeto corretamente:

---

## 1. 📥 Clonar o repositório

```bash
git clone https://github.com/KauanCalheiro/configuration-management.git
```

---

## 2. 📂 Acessar a pasta do projeto

```bash
cd configuration-management
```

---

## 3. 🛠️ Configurar variáveis de ambiente da API

Edite o arquivo `.env.production` da API:

```bash
nano ./api/.env.production
```

Preencha as seguintes informações:

```
# 📬 Configurar serviço de e-mail
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=

# 🗄️ Configurar banco de dados
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres

# 🌎 Configurar localização para português do Brasil
APP_LOCALE=pt_BR
```

---

## 4. 🛠️ Configurar variáveis de ambiente do Frontend

Edite o arquivo `.env.production` do Frontend:

```bash
nano ./web/.env.production
```

Preencha a seguinte informação:

```
# 🌐 Configurar URL do servidor
SANCTUM_BASE_URL=http://SEU_IP:80/thorn-api
```

**⚠️ Importante:**  
Substitua `SEU_IP` pelo endereço IP da sua máquina ou servidor onde o sistema está rodando.

---

## 5. 🔐 Acessar modo superusuário

```bash
sudo su
```

---

## 6. 🐳 Subir os containers com Docker

```bash
docker compose -f 'docker-compose.yml' up -d --build
```

---

# ✅ Pronto!
Seu projeto estará rodando em segundo plano com a API e o Frontend conectados.