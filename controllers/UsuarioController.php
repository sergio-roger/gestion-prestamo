<?php

if($peticionAjax){
    require_once '../models/UsuarioModel.php';
}
else{
    require_once 'models/UsuarioModel.php';
}

class UsuarioController
{
    private $usuarioModel; 

    public function __construct() {
        $this->usuarioModel = new UsuarioModel('usuarios');
    }

    public function index($vista){
        include $vista;
    }

    public function insertShort(){
       $rol = 1;
       $nombres = $this->usuarioModel->cleanString($_POST['nombres']);
       $apellidos = $this->usuarioModel->cleanString($_POST['apellidos']);
       $correo = $this->usuarioModel->cleanString($_POST['correo']);
       $genero = $this->usuarioModel->cleanString($_POST['sexo']);
       $clave = $this->usuarioModel->cleanString($_POST['clave']);
       $confclave  = $this->usuarioModel->cleanString($_POST['conf-clave']);     
    
       if($genero == 'M')
          $foto = 'avatar-m.PNG';
       else
          $foto = 'avatar-f.PNG';
        
        if($clave != $confclave){
            $alerta = [
                'alert' => 'simple',
                'tittle' => 'Ups ocurrió un error',
                'text' => 'Las contraseñas no coinciden, intente nuevamente',
                'type' => 'error'
            ];
            //return $alerta;
        }elseif($clave == '' || $confclave == ''){
            $alerta = [
                'alert' => 'simple',
                'tittle' => 'Contraseñas vacías',
                'text' => 'Debe ingresar las contraseñas',
                'type' => 'warning'
            ];
        }elseif($correo == ''){
            $alerta = [
                'alert' => 'simple',
                'tittle' => 'Ups ocurrió un error',
                'text' => 'Ingrese un correo para continuar',
                'type' => 'warning'
            ];
            //return $alerta;
        }elseif($correo != ''){

            $sql = "SELECT `usu_correo` FROM usuarios where `usu_correo`='$correo'";
            //echo "<br>$sql<br>";
            $consulta = $this->usuarioModel->ejecutarSQL($sql);
            //var_dump($consulta);
            //$resultado = $consulta->fetchAll();
            $resultado = $consulta->rowCount();
            //var_dump($resultado);

            if($resultado > 0){
                $alerta = [
                    'alert' => 'simple',
                    'tittle' => 'Ups ocurrió un error',
                    'text' => 'El correo ingresado ya se encuentra registrado en el sistema',
                    'type' => 'error'
                ];
            }else{
                //Registrar Usuario
                $claveEnc= $this->usuarioModel->encryption($clave);

                $data = [
                    'rol' => $rol,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'correo' => $correo,
                    'sexo' => $genero,
                    'foto' => $foto,
                    'clave' => $claveEnc,
                    'estado' => 'A'
                ];
    
                $save = $this->usuarioModel->insertShort($data);
    
                if($save){
                    $alerta = [
                        'alert' => 'limpiar',
                        'tittle' => 'Listo',
                        'text' => 'Tu cuenta se ha registrado con éxito !',
                        'type' => 'success'
                    ];
                }else{
                    $alerta = [
                        'alert' => 'simple',
                        'tittle' => 'Ups ocurrió un error',
                        'text' => 'No se ha podido registrar el usuario',
                        'type' => 'error'
                    ];
                }
            }
        }
        return $this->usuarioModel->sweetAlert($alerta);
    }

    public function encryption($string){
        $string = $this->usuarioModel->encryption($string);
        return $string;
    }

    public function getUsuario(){
        $id = $_POST['id'];
        $usuario = $this->usuarioModel->getUsuario($id);
        
        return $usuario;
    }

    public function login(){
       $correo = $this->usuarioModel->cleanString($_POST['correo']);
       $clave = $this->usuarioModel->cleanString($_POST['clave']);
       $clave = $this->usuarioModel->encryption($clave);

       $datos = [
           'correo' => $correo,
           'clave' => $clave
       ];

       $consulta = $this->usuarioModel->login($datos);
       $resultado = $consulta->rowCount();
       //svar_dump($resultado);

       if($resultado == 1){
            //Aki comparar el rol y verificar tipo de usuario
            //Agregar un control de inicios de seción 
            $row = $consulta->fetch();
            $fechaActual = date('Y-m-d');   $horaActual = date('h:i:s a');

            // var_dump($row);
            // die();
            session_start(['name' => 'CE']);  
            $_SESSION['usuario'] = $row;
            $_SESSION['tipo'] = $row['rol_id'];
            $_SESSION['token'] = md5(uniqid(mt_rand(),true));       //Creando un token unico

            if($row['rol_id'] == 1){
                $url = BASE.'home';
            }else{
                $url = BASE;
            }

            return $urlLocation = '
            <script>
                window.location = "'.$url.'" 
            </script>';

        }else{
                $alerta = [
                    'alert' => 'simple',
                    'tittle' => 'Ups ocurrió un error',
                    'text' => 'El correo y/o contraseña no son correctos',
                    'type' => 'error'
                ];
            }
        return $this->usuarioModel->sweetAlert($alerta);
    }

    public function forzarCierrreSession(){
        session_destroy();
        return header('Location: '.BASE.'login');
    }

    public function cerrarSesion(){
        session_start(['name' => 'CE']);  
        $token = $this->usuarioModel->descryption($_GET['token']);
        $hora = date('h:i:s a');
        $datos = [
            'usuario' => $_SESSION['usuario'],
            'token_sesion' =>  $_SESSION['token'],
            'token_boton' => $token
        ];

        $resultado = $this->usuarioModel->cerrarSesion($datos);
        return $resultado;
    }

    public function confirmarCorreo($id){
        $respuesta = $this->usuarioModel->confirmarCorreo($id);

        if($respuesta)  return true; 
        else            return false;
    }
}