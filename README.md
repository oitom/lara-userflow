<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# Lara UserFlow

[![CodeFactor](https://www.codefactor.io/repository/github/oitom/lara-userflow/badge)](https://www.codefactor.io/repository/github/oitom/lara-userflow) [![Maintainability](https://api.codeclimate.com/v1/badges/dcc7615375dc117ab0c0/maintainability)](https://codeclimate.com/github/oitom/lara-userflow/maintainability)

**`Laravel`**
**`Bootstrap 4.5`**
**`ChartJs 4.4`**
**`API ViaCEP`**
**`Docker V3`**
**`MySQL 5.7`**
  

## Requisitos
- Docker

## Como executar o projeto
1. Clone o repositório:
```bash
git clone https://github.com/oitom/lara-userflow.git
```

2. Entre no diretório do projeto:
```bash
cd lara-userflow
```

3. Execute o Docker Compose para construir as imagens e iniciar os contêineres:
```bash
docker-compose up -d
```

4. Aguarde alguns instantes até que os serviços estejam prontos.

Se ao acessar a URL do projeto você receber o erro `502 Bad Gateway`, isso indica que o framework ainda está sendo instalado. 
Esse processo pode levar até 3 minutos.
Para acompanhar o progresso da instalação, utilize o comando:
```bash
docker logs lara_docker_app
```
A aplicação estará pronta quando a mensagem NOTICE: ready to handle connections for exibida.


5. O projeto estará acessível em [http://localhost:8000](http://localhost:8000).

6. Para parar os contêineres, execute:

```bash
docker-compose down
```

## Screenshot App
![Tela Inicial](public/img/home.png)

![Lista de usuários](public/img/lista-usuario.png)

![Modal usuário](public/img/lista-usuario-modal.png)

![Novo usuário](public/img/novo-usuario.png)

![Editar usuário](public/img/editar-usuario.png)

![Banco de dados](public/img/bd.png)

![Docker](public/img/docker.png)
