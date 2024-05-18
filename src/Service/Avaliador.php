<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

/**
 * Class Avaliador
 * @package Alura\Leilao\Service
 */
class Avaliador
{
    /** @var mixed */
    private mixed $maiorValor = -INF;

    /**
     * @param Leilao $leilao
     */
    public function avaliarLeilao(Leilao $leilao): void
    {
        foreach ($leilao->obterLances() as $lance) {
            if ($lance->obterValor() > $this->maiorValor) {
                $this->maiorValor = $lance->obterValor();
            }
        }
    }

    /**
     * @return mixed
     */
    public function obterMaiorValor(): mixed
    {
        return $this->maiorValor;
    }
}