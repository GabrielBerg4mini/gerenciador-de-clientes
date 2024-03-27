<?php

class Cliente
{
    private $nome;
    private $email;
    private $endereco;
    private $telefone;
    private $senhaHash;

    public function __construct($nome = null, $email = null, $senha = null, $endereco = null, $telefone = null)
    {
        $this->nome = strip_tags($nome);
        $this->email = strip_tags($email);
        $this->endereco = strip_tags($endereco);
        $this->telefone = $telefone; // Não use strip_tags para o telefone
        $this->senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getEndereco()
    {
        return $this->endereco;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function getSenhaHash()
    {
        return  $this->senhaHash;
    }

    public function verificarSenha($senha)
    {
        return password_verify($senha, $this->senhaHash);
    }
}
