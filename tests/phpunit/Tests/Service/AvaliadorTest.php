<?php

namespace phpunit\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /** @var Avaliador */
    private Avaliador $leiloeiro;

    /**
     * Método executado antes de cada teste.
     */
    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    /**
     * Método auxiliar para criar um cenário de leilão em ordem crescente.
     * @return Leilao[]
     */
    public static function leilaoEmOrdemCrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 1000));
        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($ana, 3000));

        return [
            [$leilao]
        ];
    }

    /**
     * Método auxiliar para criar um cenário de leilão em ordem decrescente.
     * @return Leilao[]
     */
    public static function leilaoEmOrdemDecrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 3000));
        $leilao->recebeLance(new Lance($joao, 2500));
        $leilao->recebeLance(new Lance($ana, 1000));

        return [
            [$leilao]
        ];
    }

    /**
     * Método auxiliar para criar um cenário de leilão em ordem aleatória.
     * @return Leilao[]
     */
    public static function leilaoEmOrdemAleatoria(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($ana, 3000));

        return [
            [$leilao]
        ];
    }

    #[DataProvider('leilaoEmOrdemCrescente')]
    #[DataProvider('leilaoEmOrdemDecrescente')]
    #[DataProvider('leilaoEmOrdemAleatoria')]
    public function testAvaliadorDeveEncontrarMaiorValorDeLances(Leilao $leilao)
    {
        // Act - When / Executar a ação a ser testada
        $this->leiloeiro->avaliarLeilao($leilao);

        $maiorValor = $this->leiloeiro->obterMaiorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 3000;
        self::assertEquals($valorEsperado, $maiorValor);
    }

    #[DataProvider('leilaoEmOrdemCrescente')]
    #[DataProvider('leilaoEmOrdemDecrescente')]
    #[DataProvider('leilaoEmOrdemAleatoria')]
    public function testAvaliadorDeveEncontrarMaiorValorOrdemDecrescente(Leilao $leilao)
    {
        // Act - When / Executar a ação a ser testada
        $this->leiloeiro->avaliarLeilao($leilao);

        $maiorValor = $this->leiloeiro->obterMaiorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 3000;
        self::assertEquals($valorEsperado, $maiorValor);
    }

    #[DataProvider('leilaoEmOrdemCrescente')]
    #[DataProvider('leilaoEmOrdemDecrescente')]
    #[DataProvider('leilaoEmOrdemAleatoria')]
    public function testAvaliadorDeveEncontrarMenorValorOrdemCrescente(Leilao $leilao)
    {
        // Act - When / Executar a ação a ser testada
        $this->leiloeiro->avaliarLeilao($leilao);

        $maiorValor = $this->leiloeiro->obterMenorValor();

        // Assert - Then / Verificação do resultado
        $valorEsperado = 1000;
        self::assertEquals($valorEsperado, $maiorValor);
    }

    #[DataProvider('leilaoEmOrdemCrescente')]
    #[DataProvider('leilaoEmOrdemDecrescente')]
    #[DataProvider('leilaoEmOrdemAleatoria')]
    public function testAvaliadorDeveBuscarOsTresMaioresLances(Leilao $leilao)
    {
        // Act - When / Executar a ação a ser testada
        $this->leiloeiro->avaliarLeilao($leilao);

        $maioresLances = $this->leiloeiro->obterMaioresLances();

        // Assert - Then / Verificação do resultado
        static::assertCount(3, $maioresLances);
        static::assertEquals(3000, $maioresLances[0]->obterValor());
        static::assertEquals(2500, $maioresLances[1]->obterValor());
        static::assertEquals(1000, $maioresLances[2]->obterValor());
    }
}