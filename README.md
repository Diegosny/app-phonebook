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
Para rodar os testes, rode: ``` docker exec -it phonebook ./vendor/bin/phpunit ```

Link de referencia para o artigo do TDD: - **[Test Driven Development](https://www.ibm.com/garage/method/practices/code/practice_test_driven_development/)**

---

### Endpoints da aplicação:

<p> Use a url base: <a href="http://localhost:8003">http://localhost:8003 </a> </p>


<b>Criar um usuário: </b>

- <h3> create: </h3> 
```
POST - /api/v1/users
```

``` 
{
   "name": "teste",
   "email": "teste@gmail.com",
   "password": "12345678"
}
```

###
<b>Logando um usuário: </b>
- <h3> login: </h3> 
```
POST - /api/v1/users/login
```

``` 
{
   "email": "teste@gmail.com",
   "password": "12345678"
}
```
