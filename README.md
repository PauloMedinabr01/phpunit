# Testes com PHPUNIT

Este repositório contém um exemplo de testes unitários com PHPUNIT e utiliza o Linux Ubuntu 24.04, php 8.3, composer
2.7.6 e phpunit
11.2-dev.

## Requisitos

Você precisa ter o php instalado em sua máquina. Você pode verificar a versão do php com o comando:

```bash
php -v
```

Caso você não tenha o php instalado, você pode instalar com o comando:

```bash
sudo add apt-repository ppa:ondrej/php
```

Confirme a instalação e depois atualize o repositório com o comando:

```bash
sudo apt-get update
```

E instalar o php com o comando:

```bash
sudo apt-get install php8.3
```

Para alterar a versão do php, você pode alterar o arquivo `composer.json` e mudar a versão do php para a versão
instalada em sua máquina.

```json
{
  "require": {
    "php": "^8.3"
  }
}
```

## Instalação do composer

Caso você não tenha o composer instalado, você pode baixá-lo
em [https://getcomposer.org/download/](https://getcomposer.org/download/)
Você pode verificar a versão do composer com o comando:

```bash
composer -V
```

## Instalação das dependências

Rode o comando abaixo para instalar as dependências:

```bash
composer install
```

## Instalação

Faça o download do PHPUNIT via composer com o comando:

```bash
composer require --dev phpunit/phpunit
```

## Configuração do PHPUNIT

Crie um arquivo de configuração chamado `phpunit.xml` na raiz do projeto com o seguinte conteúdo:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" bootstrap="vendor/autoload.php" colors="true"
         testdox="true" stopOnFailure="false" xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/11.2/phpunit.xsd"
         cacheDirectory=".phpunit.cache">
    <testsuites>
        <testsuite name="Testes">
            <directory>tests</directory>
        </testsuite>
    </testsuites>

    <logging>
        <testdoxHtml outputFile="tests/phpunit/_output/testdox.html"/>
        <testdoxText outputFile="tests/phpunit/_output/testdox.txt"/>
    </logging>
</phpunit>
```

Caso seja necessário validar o xml do arquivo, você pode utilizar o comando:

```bash
./vendor/bin/phpunit --migrate-configuration
```

## Executando os testes

Para executar os testes, basta rodar o comando:

```bash
./vendor/bin/phpunit
``` 

Ou, se preferir, você pode criar um script no `composer.json`:

```json
{
  "scripts": {
    "test": "./vendor/bin/phpunit"
  }
}
```

E rodar o comando:

```bash
composer test
```

