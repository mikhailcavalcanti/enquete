Enquete
=======

A Symfony project created on April 13, 2015, 9:31 pm.


##Database
>Dentro do diretório raiz do projeto executar.
  * Caso já exista um bando chamado enquete
    * php app/console doctrine:database:drop --force
  * Cria o banco
    * php app/console doctrine:database:create
  * Cria tabelas de acordo com as entidades
    * php app/console doctrine:schema:update --force