<?php

namespace Alura\Leilao\Model;

/**
 * Class Leilao
 * @package Alura\Leilao\Model
 */
class Lance
{
    /** @var Usuario */
    private Usuario $usuario;
    /** @var float */
    private float $valor;

    public function __construct(Usuario $usuario, float $valor)
    {
        $this->usuario = $usuario;
        $this->valor = $valor;
    }

    public function obterUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function obterValor(): float
    {
        return $this->valor;
    }
}
