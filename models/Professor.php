 <?php

require __DIR__."/../classes/conexao.php";
class Professor {
    //ATRIBUTOS DA CLASSE
    public $cod_user;
    public $nome;
    public $email;
    public $senha;
    public $codNupe;
    public $tipoUsuario;
    public $conexao;
    //COMPORTAMENTOS
    public function __construct(){
     
        $conexao_objeto = new Connection();
        //o atributo $this->conexao agora sabe como se
        // comunicar com o banco de dados
        $this->conexao = $conexao_objeto->getConnection();
    }

    public function todos(){
        return $this->conexao->query("select * from prof")->fetchAll(PDO::FETCH_CLASS, 'Professor');
    }

    public function getUserById(int $cod_user){
        $prof = $this->conexao->query("select * from prof where cod_user = {$cod_user}")->fetch(PDO::FETCH_ASSOC);
        return $prof;
    }

    public function update($cod_user,$siape){
        $sql = "update prof set siape = '$siape' WHERE cod_user='$cod_user'";
        $resultado = $this->conexao->exec($sql);
        return $resultado;
    }

    public function delete($cod_user){
        $sql = "delete from prof where cod_user='$cod_user'";
        $this->conexao->exec($sql);
    }

    public function salvarCadDisc($siape,$cod_user,$login,$senha){
    
        $sql = "insert into prof(siape,cod_user,login,senha) values($siape','$cod_user','$login','$senha')";
        $resultado = $this->conexao->exec($sql);
        return $resultado;

    }
}