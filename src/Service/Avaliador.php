<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

/**
 * Class Avaliador
 * @package Alura\Leilao\Service
 */
class Avaliador
{
    /** @var float */
    private float $maiorValor = -INF;

    /** @var float */
    private float $menorvalor = INF;

    /** @var array */
    private array $maioresLances;

    /**
     * @param Leilao $leilao
     */
    public function avaliarLeilao(Leilao $leilao): void
    {
        foreach ($leilao->obterLances() as $lance) {
            if ($lance->obterValor() > $this->maiorValor) {
                $this->maiorValor = $lance->obterValor();
            }
            if ($lance->obterValor() < $this->menorvalor) {
                $this->menorvalor = $lance->obterValor();
            }
        }

        $lances = $leilao->obterLances();
        usort($lances, function ($lance1, $lance2) {
            $lance1->obterValor() - $lance2->obterValor();
        });

        $this->maioresLances = array_slice($lances, 0, 3);
    }

    /**
     * @return float
     */
    public function obterMaiorValor(): float
    {
        return $this->maiorValor;
    }

    /**
     * @return float
     */
    public function obterMenorValor(): float
    {
        return $this->menorvalor;
    }

    /**
     * @return array
     */
    public function obterMaioresLances(): array
    {
        return $this->maioresLances;
    }
}