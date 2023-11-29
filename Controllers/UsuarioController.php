<?php
namespace Controllers;
Use Lib\Pages;
use Models\Usuario;
class UsuarioController{
    private Pages $pages;




    function __construct(){

        $this->pages= new Pages();
        

    }
    public function registro():void{
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Falta sanear y validar
        if($_POST['data']){
        $registrado = $_POST['data'];

        //Encriptar contraseña
        $registrado['pass'] = password_hash($registrado['pass'], PASSWORD_BCRYPT, ['cost'=>4]);
        $usuario = Usuario::fromArray($registrado);
        $save= $usuario->save();
        
        if($save){
        $_SESSION['register'] = "complete";
        }else{
            $_SESSION['register'] = "failed";
            
        }
    }else{
        $_SESSION['register'] = "failed";
        
    }
}
$this->pages->render('usuario/registro');
    }

}
        



    