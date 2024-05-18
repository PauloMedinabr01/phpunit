<?php

namespace Alura\Leilao\Model;

/**
 * Class Leilao
 * @package Alura\Leilao\Model
 */
class Leilao
{
    /** @var Lance[] */
    private array $lances;
    /** @var string */
    private string $descricao;

    /**
     * Leilao constructor.
     * @param string $descricao
     */
    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    /**
     * @param Lance $lance
     * @return void
     */
    public function recebeLance(Lance $lance): void
    {
        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function obterLances(): array
    {
        return $this->lances;
    }
}
