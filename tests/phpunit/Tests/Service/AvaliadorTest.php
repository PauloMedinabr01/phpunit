<?php

namespace phpunit\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarMaiorValorOrdemCrescente()
    {
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
        self::assertEquals($valorEsperado, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarMaiorValorOrdemDecrescente()
    {
        // Arrange - Given / Preparação do cenário
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance ($maria, 2500));
        $leilao->recebeLance(new Lance ($joao, 2500));

        $leiloeiro = new Avaliador();

        // Act - When / Executar a ação a ser testada
        $leiloeiro->avaliarLeilao($leilao);

        $maiorValor = $leiloeiro->obterMaiorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 2500;
        self::assertEquals($valorEsperado, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarMenorValorOrdemCrescente()
    {
        // Arrange - Given / Preparação do cenário
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance ($maria, 2000));
        $leilao->recebeLance(new Lance ($joao, 2500));

        $leiloeiro = new Avaliador();

        // Act - When / Executar a ação a ser testada
        $leiloeiro->avaliarLeilao($leilao);

        $maiorValor = $leiloeiro->obterMenorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 2000;
        self::assertEquals($valorEsperado, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarMenorValorOrdemDecrescente()
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

        $maiorValor = $leiloeiro->obterMenorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 2000;
        self::assertEquals($valorEsperado, $maiorValor);
    }

    public function testAvaliadorDeveBuscarOsTresMaioresLances()
    {
        // Arrange - Given / Preparação do cenário
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        $jose = new Usuario('José');

        $leilao->recebeLance(new Lance ($maria, 1500));
        $leilao->recebeLance(new Lance ($joao, 1000));
        $leilao->recebeLance(new Lance ($ana, 2000));
        $leilao->recebeLance(new Lance ($jose, 1700));

        $leiloeiro = new Avaliador();

        // Act - When / Executar a ação a ser testada
        $leiloeiro->avaliarLeilao($leilao);

        $maioresLances = $leiloeiro->obterMaioresLances();

        // Assert - Then / Verificação do resultado
        static::assertCount(3, $maioresLances);
        static::assertEquals(2000, $maioresLances[0]->obterValor());
        static::assertEquals(1700, $maioresLances[1]->obterValor());
        static::assertEquals(1500, $maioresLances[2]->obterValor());
    }
}