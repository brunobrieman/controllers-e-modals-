 

    <?php

    require __DIR__."/../models/Professor.php";
     
    
   

    function index(){
        $users = new Professor();
        $listaProfessor = $users->todos();
        require __DIR__."/../view/professor.php";
    }
    function home(){
        header('Location:../view/index.php');
    }
    function cadastrar(){
        require __DIR__."/../view/usuario_cadastro.php";
    }
    function salvar(){
      //  $cod_user = $_POST['cod_user'];
        
        $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $codTipuser = $_POST['codTipuser'];
        $login = $_POST['login'];
        $user = new Profesor();

      
        $user->salvar($email,$nome,$codTipuser,$login,0);
        

        index();
    }
    
    function editar(){
        $user = new Profesor();  
        $dados_user = $user->getUserById($_GET['cod_user']);
        require __DIR__."/../view/usuario_editar.php";

    }
    function atualizar(){
        $cod_user = $_POST['cod_user'];
        $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST['email'];
        $codTipuser = $_POST['codTipuser'];
        $login = $_POST['login'];
        $userCreate = $_POST['userCreate'];
        $user = new Professor();
        $user->update($email,$nome,$cod_user,$codTipuser,$login,$userCreate);
        index();
    }
    function excluir(){
        $user = new Professor();
        $user->delete($_GET['cod_user']);
        index();
    }


    // function login(){
        
    //         if(isset($_POST['submit'])){
    //             $email = $_POST['email'];
    //             $senha = $_POST['senha'];
    //             if (empty($email) || empty($senha)) {
    //                 header('Location:../view/login.php?dados=vazio');
    //                 echo '<div class="alert alert-danger">Campos vazios </div>';
    //             }else{
    //                 $user = new Usuario();

    //                 if($user->login($email,$senha)){
    //                     session_start();
    //                     $_SESSION['usuario'] = $email;
    //                     index();                        
    //                 }else{
    //                     header('Location:../view/login.php?dados=invalid');
    //                     echo '<div class="alert alert-danger">usuario ou senha inválidos</div>';
    //                 }
    //             }
    //         } 
    // }
    // function logout(){
    //     unset($_SESSION['usuario']);
    //     home();
    // }


    // if (isset($_GET['acao']) and function_exists($_GET['acao']) ){
    //     call_user_func($_GET['acao']);
    // }else {
    //     index();
    // }
