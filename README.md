Projeto desenvolvido em Laravel e PHP8, tem como objetivo principal comparar duas tabelas iguais em servidores diferentes.

Suponha que você tenha migrado um banco de dados de servidor e por alguma razão os dados não tenham sido sincronizados corretamente! Este projeto te ajuda a comparar a tabela do servidor antigo com o servidor novo.

Basta configurar suas conexões na .env

```bash
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

DB_CONNECTION=mysql_old
DB_OLD_HOST=
DB_OLD_PORT=
DB_OLD_DATABASE=
DB_OLD_USERNAME=
DB_OLD_PASSWORD=
```

Onde DB_CONNECTION=mysql refere-se a base atual e a DB_CONNECTION=mysql_old refere-se a conexão da base anterior.

Após realizar a instalação do projeto (basta instalar como um projeto Laravel qualquer), basta rodar via terminal o seguinte comando:

```bash
php artisan data:compare {name_table}

```

Onde **{name_table}** refere-se ao nome da tabela que você deseja comparar.
