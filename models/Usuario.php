 
<?php

require __DIR__."/../classes/conexao.php";

class Usuario {
    //ATRIBUTOS DA CLASSE
    public $cod_user;
    public $nome;
    public $email;
    public $senha;
    public $tipoUsuario;
    public $conexao;
    //COMPORTAMENTOS
    public function __construct(){
     
        $conexao_objeto = new Connection();
        //o atributo $this->conexao agora sabe como se
        // comunicar com o banco de dados
        $this->conexao = $conexao_objeto->getConnection();
    }
    public function exibe (){
        echo "usuario {$this->nome} foi criado com o tipo {$this->codTipuser} e cod_user {$this->cod_user} \n";
    }
    public function todos(){
        return $this->conexao->query("select * from usuario")->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    public function getUserById(int $cod_user){
        $user = $this->conexao->query("select * from usuario where cod_user = {$cod_user}")->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function salvar($email,$nome,$tipoUsuario,$login,$userCreate){
        $sql = "insert into usuario(email,nome,codTipuser,login,userCreate) values('$email','$nome','$tipoUsuario','$login','$userCreate')";
        $resultado = $this->conexao->exec($sql);
        return $resultado;
    }
    public function update($email,$nome,$cod_user,$codTipuser){
        $sql = "update usuario set email='$email',nome='$nome',codTipuser = '$codTipuser',cod_user = '$cod_user' WHERE cod_user='$cod_user'";
        $resultado = $this->conexao->exec($sql);
        return $resultado;
    }
    public function delete($cod_user){
        $sql = "delete from usuario where cod_user='$cod_user'";
        $this->conexao->exec($sql);
    }

    public function login($email,$senha){
        
        $resultado = $this->conexao->query("select email,senha from nupe INNER JOIN usuario on nupe.cod_user = usuario.cod_user WHERE email = '$email' and senha = '$senha'")->fetch(PDO::FETCH_ASSOC);
        print_r($resultado);
        
        if (empty($resultado)) {
            return false;
        }else{

        return true;
        }
    }

   
}


