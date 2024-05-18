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
    private mixed $maiorValor;

    /**
     * @param Leilao $leilao
     */
    public function avaliarLeilao(Leilao $leilao): void
    {
        $lances = $leilao->obterLances();
        $ultimoLance = $lances[count($lances) - 1];
        $this->maiorValor = $ultimoLance->obterValor();
    }

    /**
     * @return mixed
     */
    public function obterMaiorValor(): mixed
    {
        return $this->maiorValor;
    }
}