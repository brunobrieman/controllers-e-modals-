<?php
 
require __DIR__."/../models/Nupe.php";

 
	function index(){
        $nupes = new Nupe();
        $listaNupes = $nupes->todos();
        require __DIR__."/../view/ListaNupe.php";
    }

    function cadastrarNupe(){
    	require __DIR__."/../view/CadastroNupe.php";
    }

	function salvarCadNupe(){
	    $login = $_POST['login'];
	    $codNupe = $_POST['codNupe'];
	    $senha = $_POST['senha'];
	    $cod_user = $_POST['cod_user'];
	    $userNup = new Nupe();
	    $userNup->salvarCadNupe($login,$codNupe,$cod_user,$senha);
        index();
	    
	}

	function editarNupe(){
        $user = new Nupe();  
        $dados_user = $user->getNupeById($_GET['cod_user']);
        require __DIR__."/../view/NupeEditar.php";

    }
    function atualizar(){
        $cod_user = $_POST['cod_user'];
        $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $codTipuser = $_POST['codTipuser'];
        $user = new Nupe();
        $user->update($email,$nome,$cod_user,$codTipuser);
        index();
    }
    function excluir(){
        $user = new Nupe();
        $user->delete($_GET['cod_user']);
        index();
    }

    function login(){
        $email = $_POST['email'];
        $login = $_POST['login'];   
        $senha = $_POST['senha'];
        $user = new Nupe();
        $user->update($email,$login,$senha);
    }
    

		 if (isset($_GET['acao']) and function_exists($_GET['acao']) ){
		    call_user_func($_GET['acao']);
		}else {
		    index();
		}