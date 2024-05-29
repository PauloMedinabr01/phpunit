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

        $usuario = $lance->obterUsuario();

        $totalLancesUsuario = $this->quantidadeLancesPorUsuario($usuario);

        if ($totalLancesUsuario >= 5) {
            return;

        }
        $this->lances[] = $lance;
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

    /**
     * @param Usuario $usuario
     * @return integer
     */
    public function quantidadeLancesPorUsuario(Usuario $usuario): int
    {
        $totalLancesUsuario = array_reduce(
            $this->lances,
            function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
                if ($lanceAtual->obterUsuario() === $usuario) {
                    return $totalAcumulado + 1;
                }

                return $totalAcumulado;

            },
            0);
        return $totalLancesUsuario;
    }

    /**
     * @return Lance[]
     */
    public function obterLances(): array
    {
        return $this->lances;
    }
}
