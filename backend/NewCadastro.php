<?php

class Cliente
{
    public $nome;
    public $email;
    public $endereco;
    public $telefone;
    public $descricao;
    private $senha_hash;

    public function __construct($nome, $email, $senha, $endereco, $telefone, $descricao)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->descricao = $descricao;
        $this->setSenha($senha);
    }

    public function setSenha($senha)
    {
        $this->senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verificarSenha($senha)
    {
        return password_verify($senha, $this->senha_hash);
    }

    public funtion getInformacoes() {
        return ($this->email; $this->telefone);;
    }
}


$pdo = new PDO("mysql:host=localhost;dbname=gerenciador-de-clientes, 'root', '' ");

if (isset($_POST['acao'])) {
    //dados do form...
    $nome = strip_tags($_REQUEST['nome']) ?? '';
    $email = strip_tags($_REQUEST['email']) ?? '';
    $senha = strip_tags($_REQUEST['password']) ?? '';

    $sql = $pdo->prepare("INSERT INTO `tb.clientes`(`nome`,`email`, `senha`) VALUES (?, ?) ");

    if ($sql->execute()) {
    }
}
