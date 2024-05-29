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
        if (!empty($this->lances) && $this->lanceEhDoultimoUsuario($lance)) {
            return;
        }
        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function obterLances(): array
    {
        return $this->lances;
    }

    /**
     * @param Lance $lance
     * @return boolean
     */
    public function lanceEhDoultimoUsuario(Lance $lance): bool
    {
        $ultimoLance = $this->lances[count($this->lances) - 1]->obterUsuario();
        return $lance->obterUsuario() === $ultimoLance;
    }
}
