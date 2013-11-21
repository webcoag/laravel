## Laravel 4 Webcompany

Repositório público do framework Laravel para uso em projetos ;)

## Requisitos Mínimos de Servidor

### PHP
Versão >= 5.3.8

### Extensões
Mcrypt;
Fileinfo;
GD;
MySQL;
PDO;
pdo_mysql;
pdo_odbc

### Diretrizes
register_globals = Off;
register_long_arrays = Off;
allow_url_fopen = On

### Apache Modules
rewrite_module = enabled

## Segurança

### API KEY
Para garantir a segurança das informações enviadas/recebidas gere uma API KEY.
Você pode utilizar o nosso gerador (http://webco.ag/laravel/secretkey/) para gerar uma chave segura para a aplicação.

#### Configurando a API KEY
Após gerar sua chave de segurança, atualize-a dentro no arquivo (./application/config/application.php) no parametro 'key'

## Primeiras Configurações

### Database

Em: ./application/config/database.php pode se configurar as conexões para o banco de dados.


### Boas Práticas

https://github.com/enricopereira/PSR_PT-BR