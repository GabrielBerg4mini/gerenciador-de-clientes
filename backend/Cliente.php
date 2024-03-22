<?php

class Cliente
{
    public $nome;
    public $email;
    public $endereco;
    public $telefone;
    private $senha_hash;

    public function __construct($nome, $email, $senha, $endereco, $telefone)
    {
        $this->nome = strip_tags($nome);
        $this->email = strip_tags($email);
        $this->endereco = strip_tags($endereco);
        $this->telefone = $telefone; // Não use strip_tags para o telefone
        $this->senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getSenhaHash()
    {
        return  $this->senha_hash;
    }

    public function verificarSenha($senha)
    {
        return password_verify($senha, $this->senha_hash);
    }

    public function getInformacoes()
    {
        return array(
            'nome' => $this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'endereco' => $this->endereco
        );
    }
}
