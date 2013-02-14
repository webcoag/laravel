## Laravel 4 Webcompany

Repositório público do framework Laravel para uso em projetos ;)

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
