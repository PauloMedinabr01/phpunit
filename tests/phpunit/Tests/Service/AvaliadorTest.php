<?php

namespace phpunit\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarMaiorValor()
    {
        // Arrange - Given / Preparação do cenário
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance ($maria, 2500));
        $leilao->recebeLance(new Lance ($joao, 2000));

        $leiloeiro = new Avaliador();

        // Act - When / Executar a ação a ser testada
        $leiloeiro->avaliarLeilao($leilao);

        $maiorValor = $leiloeiro->obterMaiorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 2500;
        self::assertEquals($valorEsperado, $maiorValor);
        self::assertIsFloat($maiorValor);
    }
}