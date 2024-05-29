<?php

namespace phpunit\Tests\Models;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    /**
     * Método auxiliar para criar cenários de leilões.
     * @return array
     */
    public static function geraLances(): array
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilaoCom1Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom1Lances->recebeLance(new Lance($joao, 1000));

        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));

        $leilaoSemLances = new Leilao('Fiat 147 0KM');

        return [
            [2, $leilaoCom2Lances, [1000, 2000]],
            [1, $leilaoCom1Lances, [1000]],
            [0, $leilaoSemLances, []]
        ];

    }

    #[DataProvider('geraLances')]
    public function testLeilaoDeveReceberLances(int $qtdLances, Leilao $leilao, array $valores)
    {
        $this->assertCount($qtdLances, $leilao->obterLances());

        foreach ($valores as $i => $valorEsperado) {
            $this->assertEquals($valorEsperado, $leilao->obterLances()[$i]->obterValor());
        }
    }

    /**
     * @return void
     */
    public function testLeilaoNaoDeveReceberLancesRepetidos()
    {
        $leilao = new Leilao('Variante 0KM');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1000));
        $leilao->recebeLance(new Lance($ana, 1500));

        $this->assertCount(1, $leilao->obterLances());
        $this->assertEquals(1000, $leilao->obterLances()[0]->obterValor());
    }

    /**
     * @return void
     */
    public function testLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
    {
        $leilao = new Leilao('Brasília Amarela 0KM');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));

        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));

        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));

        // deve ser ignorado
        $leilao->recebeLance(new Lance($joao, 6000));

        $this->assertCount(10, $leilao->obterLances());
        $this->assertEquals(5500, $leilao->obterLances()[array_key_last($leilao->obterLances())]->obterValor());
    }
}