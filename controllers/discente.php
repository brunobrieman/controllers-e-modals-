<?php

require __DIR__."/../models/Discente.php";

  
	function index(){
        $alunos = new Discente();
        $listaAlunos = $alunos->todos();
        require __DIR__."/../view/ListaDisc.php";
    }

    function cadastrarDisc(){
    	require __DIR__."/../view/Cadastrodisc.php";
    }

	function salvarCadDisc(){
	    $login = $_POST['login'];
	    $matricula = $_POST['codMat'];
	    $senha = $_POST['senha'];
	    $cod_user = $_POST['cod_user'];
        $curso = $_POST['curso'];
        $emailResp = $_POST['resp'];
        $nomeResp = $_POST['respnome'];
        $userDisc = new Discente();
	    $userDisc->salvarCadDisc($curso,$emailResp,$nomeResp,$matricula,$cod_user,$login,$senha);
        index();
	    
	}

	function editarDisc(){
        $user = new Discente();  
        $dados_user = $user->getNupeById($_GET['cod_user']);
        require __DIR__."/../view/DiscEditar.php";

    }
    function atualizar(){
        $cod_user = $_POST['cod_user'];
        $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $codTipuser = $_POST['codTipuser'];
        $user = new Discente();
        $user->update($email,$nome,$cod_user,$codTipuser);
        index();
    }
    function excluir(){
        $user = new Discente();
        $user->delete($_GET['cod_user']);
        index();
    }
    

		 if (isset($_GET['acao']) and function_exists($_GET['acao']) ){
		    call_user_func($_GET['acao']);
		}else {
		    index();
		}