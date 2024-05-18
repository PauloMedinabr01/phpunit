<?php

namespace Alura\Leilao\Model;

/**
 * Class Leilao
 * @package Alura\Leilao\Model
 */
class Usuario
{
    /** @var string */
    private string $nome;

    /**
     * Usuario constructor.
     * @param string $nome
     */
    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function obterNome(): string
    {
        return $this->nome;
    }
}
