<?php

class Cliente
{
    private $nome;
    private $email;
    private $endereco;
    private $telefone;
    private $senhaHash;

    public function __construct($nome, $email, $senha, $endereco, $telefone)
    {
        $this->nome = strip_tags($nome);
        $this->email = strip_tags($email);
        $this->endereco = strip_tags($endereco);
        $this->telefone = $telefone; // Não use strip_tags para o telefone
        $this->senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function getSenhaHash()
    {
        return  $this->senhaHash;
    }

    public function verificarSenha($senha)
    {
        return password_verify($senha, $this->senhaHash);
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
