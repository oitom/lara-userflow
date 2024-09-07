<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Lara UserFlow

**`Laravel`**
**`Bootstrap 5.3`**
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

4. Aguarde alguns segundos até os seviços ficarem prontos.
```
Isso pode levar até 3 minutos.
```
Você pode ver o progresso da instalação usando o comando abaixo:
```
docker logs lara_docker_app
```

5. Execute as migrations necessárias para construir os dados da aplicação:

```
docker exec lara_docker_app php artisan migrate --seed
```

6. O projeto estará acessível em [http://localhost:8080](http://localhost:8080).


7. Para parar os contêineres, execute:

```bash
docker-compose down
```
