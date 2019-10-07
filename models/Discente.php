<?php

require __DIR__."/../classes/conexao.php";
class Discente {
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
        return $this->conexao->query("select * from discente")->fetchAll(PDO::FETCH_CLASS, 'Discente');
    }

    public function getUserById(int $cod_user){
        $disc = $this->conexao->query("select * from discente where cod_user = {$cod_user}")->fetch(PDO::FETCH_ASSOC);
        return $disc;
    }

    public function update($login,$matricula,$curso,$Emailresp,$cod_user,$Nomeresp,$senha){
        $sql = "update discente set login='$login',matricula='$matricula',senha = '$senha',curso = '$curso',emailResp = '$Emailresp',nomeResp = '$Nomeresp' WHERE cod_user='$cod_user'";
        $resultado = $this->conexao->exec($sql);
        return $resultado;
    }

    public function delete($cod_user){
        $sql = "delete from discente where cod_user='$cod_user'";
        $this->conexao->exec($sql);
    }

    public function salvarCadDisc($curso,$emailResp,$nomeResp,$matricula,$cod_user,$login,$senha){
    
        $sql = "insert into discente(curso,emailResp,nomeResp,matricula,cod_user,login,senha) values('$curso,$emailResp,$nomeResp,$matricula','$cod_user','$login','$senha')";
        $resultado = $this->conexao->exec($sql);
        return $resultado;

    }
}