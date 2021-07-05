# Desafio Desenvolvedor PHP Tray!

# Instalacão
## requisitos:
1. Docker
2. Docker-compose
3. PHP 7.4
4. NGINX
5. MySql

## Passos

### Clone o repositório
```
$ git clone https://github.com/MatMr7/desafio-tray.git
```
### Entre no repositório

```
$ cd tray-api
```

### Ajuste a pasta 'docker-compose.yml'
```
Altere o 'user' para o desejado
```
### Configure o .env
```
$ cp .env-example .env
```
```
Altere o .env criado com as suas configs
```
### Execute o docker
```
$ sudo docker-compose up
```

### Execute as migrations
```
$ sudo docker-compose exec tray-api bash
```
```
$ php artisan migrate
```

### Executando a API
```
Caso esteja no bash, saia dele com o comando 'exit'
```
```
$ php artisan migrate
```
```
Agora, a Api deve estar rodadando no endereco: 'http://localhost:8000'
Obs: Esse endereco é entendido como {{ base_url }} nas secoes abaixo
```

# API

### Endpoint
Os métodos a seguir são disponibilizados para acesso via HTTPS em seus respectivos verbos. O header Content-Type e o corpo da mensagem devem seguir o formato application/json.

### Vendedor

#### Cadastra vendedor
```
POST - {{ base_url }}seller
```
##### Request Fields:

| Nome  |  Tipo  | Descricao
| ------------------- | ------------------- |--------------|
|  email |  String | Faz referencia ao email do vendedor a ser cadastrado|
|  name |  String | Faz referencia ao nome do vendedor a ser cadastrado|
```
request:
{
	"email":"matheus@maill",
	"name":"matheus Name"
}

response:
{
  "data": {
    "id": "abd679df-96d0-49ae-96d8-a692df0a3390",
    "name": "Test Name",
    "email": "teste@nail",
    "created_at": "2021-07-05T12:27:42.000000Z"
  }
}
```
#### Lista vendedores
```
GET - {{ base_url }}seller
```
```
response: {
{	"data": [
     {
	   "id": "381327e8-92cb-4389-bda8-f4aa2e5454e5",
	   "name": "Jose",
	   "email": "jose@mail.com",
	   "created_at": "2021-07-05T02:21:47.000000Z"
    },
    {
      "id": "8c5447fa-ab41-4007-a9e6-b1f789a9fb76",
      "name": "Maria",
      "email": "maria@mail.com",
      "created_at": "2021-07-05T02:22:13.000000Z"
    },
    {
      "id": "2f084629-7789-4f9d-ae52-41460d51e81e",
      "name": "mario",
      "email": "maio@mail.com",
      "created_at": "2021-07-05T02:22:49.000000Z"
    },
    {
      "id": "56d3ed06-8a97-49da-95c1-e67fe4dcfa1e",
      "name": "katia",
      "email": "katia@mail.com",
      "created_at": "2021-07-05T02:23:21.000000Z"
    }
   ]
}
```

### Vendas

#### Cadastra venda
```
POST - {{ base_url }}seller
```
##### Request Fields:

| Nome  |  Tipo  | Descricao
| ------------------- | ------------------- |--------------|
|  seller_id |  string | Faz referencia ao id do vendedor correspondente a venda
|  sale_value |  String | Faz referencia ao valor da venda e deve estar, são 12 dígitos representando o valor, considerando os últimos 2 dígitos como casas decimais. Exemplo: "000000001250" é equivalente R$ 12,50 |
```
request:
{
	"seller_id":"13eb1ecd-37a5-49e0-a9dd-6ce00efdd2df",
	"sale_value": "000000012050"
}

response:
{
  "data": {
    "id": "4de7dbb0-93f2-4137-8f48-bf178862835c",
    "seller": {
      "name": "Matheus",
      "email": "ti.matheus.morais@gmail.com"
    },
    "sale_value": 120.5,
    "commission": 10.24,
    "created_at": "2021-07-05T11:52:44.000000Z"
  }
}
```

#### Listar vendas
```
GET - {{ base_url }}seller/{id}
```
##### Request Fields:
| Nome  |  Tipo  | Descricao
| ------------------- | ------------------- |--------------|
|  id |  String | Faz referencia ao id do vendedor que as vendas serao recuperadas|

```
response:
{
  "data": [
    {
      "id": "87c80f49-204e-4721-9a0c-b54e7ba989e3",
      "seller": {
        "name": "Test Name",
        "email": "teste@mail"
      },
      "sale_value": 120.5,
      "commission": 10.24,
      "created_at": "2021-07-05T12:46:13.000000Z"
    },
    {
      "id": "45b6df81-2ac5-4b7d-be3a-99f90c5be815",
      "seller": {
        "name": "Test Name",
        "email": "teste@mail"
      },
      "sale_value": 190.5,
      "commission": 16.19,
      "created_at": "2021-07-05T12:46:20.000000Z"
    }
  ]
}
```

### Enviar relatório de vendas das ultimas 24 horas
```
$ sudo docker-compose exec tray-api bash
```
```
$ php artisan report:send *email-recebedor*
```
```
Configure um CronJob ou um Supervisor para executar esse comando a cada 24 horas
```

### Testes

```
$ php artisan test
```
