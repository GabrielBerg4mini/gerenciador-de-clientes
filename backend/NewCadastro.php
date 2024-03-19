<?php
//Classe cliente
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
        $this->nome = strip_tags($nome);
        $this->email = strip_tags($email);
        $this->endereco = strip_tags($endereco);
        $this->telefone = $telefone; // Não use strip_tags para o telefone
        $this->descricao = strip_tags($descricao);
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
        $descricao_truncada = $this->truncarDescricao($this->descricao, 60);

        return array('nome' => $this->nome, 'email' => $this->email, 'telefone' => $this->telefone, 'endereco' => $this->endereco, 'descricao' => $descricao_truncada);
    }

    //função para truncar a descrição (...)
    private function truncarDescricao($descricao, $maxLenght = 60)
    {
        if (strlen($descricao) > $maxLenght) {
            // Trunca a string para o comprimento máximo desejado e adiciona "..."
            $truncada = substr($descricao, 0, $maxLenght - 3) . '...';
            return $truncada;
        } else {
            return $descricao;
        }
    }
}

//Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=gerenciador-de-clientes", 'root', '');

if (isset($_POST['acao'])) {

    //cria um novo objeto Cliente com os dados do formulário
    $cliente = new Cliente(
        $_POST['nome'] ?? '',
        $_POST['email'] ?? '',
        $_POST['password'] ?? '',
        $_POST['endereco'] ?? '',
        $_POST['telefone'] ?? '',
        $_POST['descricao'] ?? ''
    );

    //preparando a consulta SQL para inserir o cliente no banco de dados
    $sql = $pdo->prepare("INSERT INTO `tb.clientes`(`nome`,`email`, `senha`, `telefone`, `endereco`, `descricao`) VALUES (?, ?, ?, ?, ?, ?) ");

    //executando a consulta SQL
    if ($sql->execute([$cliente->nome, $cliente->email, $cliente->getSenhaHash(), $cliente->telefone, $cliente->endereco, $cliente->descricao])) {
        header("Location: ../index.php?success=1"); //redireciona para index.php com parâmetro de sucesso
        exit(); //encerra o script para evitar execução adicional

    } else {
        die("Falha ao inserir o cliente" . print_r($sql->errorInfo(), true));
    }
}


//Recuperar todos os clientes do banco de dados

$sql = $pdo->prepare("SELECT * FROM `tb.clientes`");
$sql->execute();

$clientes = $sql->fetchAll();
