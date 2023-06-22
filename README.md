## Projeto Phonebook

Este projeto é para o desafio que me foi passado. Aqui estará toda documentação do mesmo.


## Docker:

Para instalar o projeto será necessario ter o docker em sua maquina.

- <a target="_blank" href="https://docs.docker.com/desktop/install/mac-install/"> Install macos </a> <br>
- <a target="_blank" href="https://docs.docker.com/desktop/install/windows-install/"> Install windows </a> <br>
- <a target="_blank" href="https://docs.docker.com/desktop/install/linux-install/"> Install linux </a> <br>

---
## Rodando o projeto:

- Copie o .env.example para um arquivo .env 
```
cp .env.example .env
```

- Rode o build do projeto:

```
docker compose up -d --build 
 ```

- Instalando pacotes: 
``` 
docker exec phonebook composer install 
``` 

- Rodar a chave para o projeto: 
```
docker exec phonebook php artisan key:generate 
```

- Rodar as migrate: 
```
docker exec phonebook php artisan migrate 
```

E já poderá acessar o projeto:
 
- <a href="http://localhost:8003"> Aplicação </a> <br>
- <a href="http://localhost:8025"> Mailtip </a> <br>

--- 
### Teste(TDD)

Usei o <b> Desenvolvimento Orientado por Testes</b> (TDD)  como prática de começar o desenvolvimento a partir do teste <br>
Para rodar os testes, rode: 
``` 
docker exec -it phonebook ./vendor/bin/phpunit 
```

Link de referencia para o artigo do TDD: - **[Test Driven Development](https://www.ibm.com/garage/method/practices/code/practice_test_driven_development/)**

---

### Endpoints da aplicação:

<p> Use a url base: <a href="http://localhost:8003">http://localhost:8003 </a> </p>


1) <b>Criar um usuário: </b>

```
POST - /api/v1/users
```

Request:
``` 
{
   "name": "teste",Listar os contatos
   "email": "teste@gmail.com",
   "password": "12345678"
}
```
Response:
```
{
    "data": {
         "token": "7|eldB7LpB2HDQ2BnqpX8yg9WUJAZVM35Xk79vrbPh"
    }	
}
```

###
2) <b>Logando um usuário: </b>

```
POST - /api/v1/users/login
```

Request:
``` 
{
   "email": "teste@gmail.com",
   "password": "12345678"
}
``` 
Response:
```
{
    "data": {
         "token": "7|eldB7LpB2HDQ2BnqpX8yg9WUJAZVM35Xk79vrbPh"
    }	
}
```
---
<b> OBS: Necessário estar autenticado </b> <br>

3) <h3>Criar um contato: </h3> <br>

```
POST - /api/v1/contacts/
```

Request:
``` 
{
    "first_name": "Ana",
    "last_name": "Gomes",
    "email": "ana@hotmail.com",
    "phone": "33997313612"
}
```

Response:
```
{
    "data": [
      {
            "id": 1,
            "first_name": "Lucas",
            "last_name": "Souza",
            "email": "souzalucas@hotmail.com",
            "phone": "33997313812",
            "user_id": 1
        }
    ],
	"links": {
		"first": "http:\/\/localhost:8003\/api\/v1\/contacts\/1?page=1",
		"last": null,
		"prev": null,
		"next": null
	},
	"meta": {
		"current_page": 1,
		"from": 1,
		"path": "http:\/\/localhost:8003\/api\/v1\/contacts\/1",
		"per_page": 15,
		"to": 1
	}
}
```

4) <h3>Listar os contatos</h3>

```
GET - /api/v1/contacts/
```

Response:
``` 
{
    "data": [
      {
            "id": 1,
            "first_name": "Lucas",
            "last_name": "Souza",
            "email": "souzalucas@hotmail.com",
            "phone": "33997313812",
            "user_id": 1
        }
	],
	"links": {
		"first": "http:\/\/localhost:8003\/api\/v1\/contacts\/1?page=1",
		"last": null,
		"prev": null,
		"next": null
	},
	"meta": {
		"current_page": 1,
		"from": 1,
		"path": "http:\/\/localhost:8003\/api\/v1\/contacts\/1",
		"per_page": 15,
		"to": 1
	}
}
```

5) <h3> Lista um contato </h3>

```
GET - /api/v1/contacts/{id}
```

Response:
``` 
{
    "data": [
         {
            "id": 1,
            "first_name": "Ana",
            "last_name": "Gomes",
            "email": "ana@hotmail.com",
            "phone": "33997313612",
            "user_id": 1
        },
    ]
  }
```

6) <h3>Atualizar um contato</h3>

```
PUT - /api/v1/contacts/{id}
```

Request:
``` 
{
    "first_name": "Ana",
    "last_name": "Gomes De Olveira",
    "email": "ana@hotmail.com",
    
}
```
<span>O campo phone não é obrigatorio quando for atualizar, no entanto caso seja passado, ele nao poderá ser o mesmo valor.</span>

Response:
```
{
    "data": [
         {
            "id": 1,
            "first_name": "Ana",
            "last_name": "Gomes De Oliveira",
            "email": "ana@hotmail.com",
            "phone": "33997313612",
            "user_id": 1
        },
    ]
  }
```

7) <h3>Excluindo um contato </h3>

```
DELETE - /api/v1/contacts/{id}
```

Response:
``` 
{
	"data": [
		{
			"id": 2,
			"first_name": "Lucas",
			"last_name": "Souza",
			"email": "souzalucas@hotmail.com",
			"phone": "33997313812",
			"user_id": 1
		}
	],
	],
	"links": {
		"first": "http:\/\/localhost:8003\/api\/v1\/contacts\/1?page=1",
		"last": null,
		"prev": null,
		"next": null
	},
	"meta": {
		"current_page": 1,
		"from": 1,
		"path": "http:\/\/localhost:8003\/api\/v1\/contacts\/1",
		"per_page": 15,
		"to": 1
	}
 }
```
<span>Caso nao exista nenhum contato irá retornar um objeto vazio, como no exemplo</span>
