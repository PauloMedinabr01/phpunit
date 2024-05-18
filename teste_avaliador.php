<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

// Arrange - Given / Preparação do cenário
$leilao = new Leilao('Fiat 147 0KM');

$maria = new Usuario('Maria');
$joao = new Usuario('João');

$leilao->recebeLance(new Lance ($maria, 2000));
$leilao->recebeLance(new Lance ($joao, 2500));

$leiloeiro = new Avaliador();

// Act - When / Executar a ação a ser testada
$leiloeiro->avaliarLeilao($leilao);

$maiorValor = $leiloeiro->obterMaiorValor();

// Assert - Then / Verificação do resultado
$valorEsperado = 2500;

if ($valorEsperado == $maiorValor) {
    echo "Teste ok";
} else {
    echo "Teste falhou";
}

//echo "O maior lance foi de: R$ " . $maiorValor;