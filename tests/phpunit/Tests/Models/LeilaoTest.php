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

}