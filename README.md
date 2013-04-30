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


## Primeiras Configurações

### Locais

Em: ./paths.php modifique a linha 26 de acordo com o local de instalação do novo projeto.

```php
<?php

$environments = array(

  'local' => array('http://localhost/laravel*', '*.dev'),

);

```

### Database

Em: ./application/config/database.php pode se configurar as conexões para o banco de dados.


### Boas Práticas


https://github.com/enricopereira/PSR_PT-BR
