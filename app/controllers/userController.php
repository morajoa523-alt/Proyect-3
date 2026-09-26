<?php
class userController extends Controller
{

private $daoUser;
private $datos;
public function __construct()
{
    $this->daoUser = new DaoUsuarios();
}

public function datos(){
session_start();

        $datosRolUser = $this->daoUser->selectTiposUsuario();
        $datosUsers = $this->daoUser->selectUsuarios();
        $datosUserLogueado = $this->daoUser->selectUsuario($_SESSION['usuario']['id_usuario']);

      $this->datos = [
      "tiposUsuario" => $datosRolUser,
      "usuarioLogueado" => $datosUserLogueado,
      "usuarios"  => $datosUsers 
       ];
      
       $this->render('Admin/userAndRegisterUser', $this->datos);
    

}


public function registerUser()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->render('Admin/registerUser', $datos);
  }

  public function vistaUser()
{
    // Instanciar el DAO2
    require_once __DIR__ . '/../models/DAO2.php';
    $dao = new DAO2();

    // Obtener todos los usuarios
    $usuarios = $dao->obtenerUsuarios();

    // Datos adicionales que quieras pasar a la vista
    $datos = [
        "title" => "Usuarios Registrados",
        "usuarios" => $usuarios
    ];
    

    // Cargar la vista y pasar los datos
    $this->render('Admin/vistaUser', $datos);
}






 public function selectUser()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->load_view('vistaUser', $datos);
  }



  public function insertUser()
{
    

    // Inicializar datos para la vista
    $datos = [
        "title" => "Registrar Usuario",
        "error" => "",
        "success" => ""
    ];

    // Verificar si el formulario fue enviado por POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtener y limpiar los datos del formulario
       
        $email    = trim($_POST['correo'] ?? '');
        $password = trim($_POST['contrasena'] ?? '');
        $idRol      = trim($_POST['id_tipo'] ?? '');
        // Validaciones básicas
        if (empty($email) || empty($password) || empty($idRol)) {
            $datos['error'] = "Todos los campos son obligatorios.";
        } else {
            // Enviar los datos al modelo DAO2
            $resultado = $this->daoUser->insertUsuario( $email, $password, $idRol);

            if ($resultado === true) {
                $datos['success'] = "Usuario registrado correctamente.";
            } else {
                $datos['error'] = $resultado; // Puede ser mensaje de error del modelo
            }
        }
    }

    // Cargar la vista y pasar los datos (errores, mensajes)
    $this->datos();
}


public function updateUser(): void
    {
        

        $correo    = $_POST['correo'] ?? null;
        $id_tipo   = $_POST['id_tipo'] ?? null;
        $idUsuario = $_POST['id_usuario'] ?? null;
        $nombre    = $_POST['nombre'] ?? null;
         
        

        

        $data = [
            'correo'  => $correo,
            'id_tipo' => $id_tipo,
            'id' => $idUsuario,
            'nombres' => $nombre
            
            
        ];

        // Contraseña opcional
        if (!empty($_POST['contrasena'])) {
            $data['contrasena'] = password_hash(
                $_POST['contrasena'],
                PASSWORD_BCRYPT
            );
        }

        $this->daoUser->updateUsuario($idUsuario, $data);

        $this->datos();
    }




  public function inicioSesionAdmin()
  {
    $datos = [
      "title" => "Inicio"
    ];
    $this->render('Admin/inicioSesionAdmin', $datos);
  }


  public function validacionUser()
{
    // Cargar la vista del formulario
    $datos = [
        "title" => "Inicio de Sesión Admin",
        "error" => ""
    ];

    // Verificar si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Validar que los campos no estén vacíos
        if (empty($email) || empty($password)) {
            
            $datos['error'] = "Por favor, ingresa tu email y contraseña.";
            $this->render('Admin/inicioSesionAdmin', $datos);
            return;
        }

        try {
         
            

            // Obtener usuario por email
            $usuario = $this->daoUser->selectUsuarioPorEmail($email);
            
            
            if ($usuario && $password == password_verify($password, $usuario['password'])) {
                // Validar que sea ADMIN
                if ($usuario['idRol'] === 1) {
                    
                    // Iniciar sesión
                    if (session_status() === PHP_SESSION_NONE) {
                       session_start();
                     }
                    
                    $_SESSION['usuario'] = [
                    'id_usuario' => $usuario['idUsuario'],
                    'nombre'     => $usuario['nombre'],
                    'rol'        => $usuario['idRol'],
                    'correo'     => $usuario['email']
                    ];
                    // REDIRECCIÓN CORRECTA
                   header("Location: /ventaPedido/inicio/inicioAdmin");
                   
                    exit(); // importante detener ejecución

                } else {
                    $datos['error'] = "No tienes permisos de administrador.";
                }
            } else {
                $datos['error'] = "Email o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $datos['error'] = "Error al iniciar sesión: " . $e->getMessage();
        }
    }

    // Mostrar la vista de login (si no se envió POST o hubo error)
    $this->render('Admin/inicioSesionAdmin', $datos);
}


  public function validacionUserCliente()
{
    // Cargar la vista del formulario
    $datos = [
        "title" => "Inicio de Sesión Admin",
        "error" => ""
    ];

    // Verificar si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Validar que los campos no estén vacíos
        if (empty($email) || empty($password)) {
            
            $datos['error'] = "Por favor, ingresa tu email y contraseña.";
            $this->render('Comercial/inicioSesionCliente', $datos);
            return;
        }

        try {
         
        $inter = new interfacesController();
            

            // Obtener usuario por email
            $usuario = $this->daoUser->selectUsuarioPorEmail($email);
            
            if ($usuario && $password == password_verify($password, $usuario['password'])) {
                // Validar que sea CLIENTE
                if ($usuario['idRol'] === 2) {
                    
                    // Iniciar sesión
                    if (session_status() === PHP_SESSION_NONE) {
                       session_start();
                     }
                    
                    $_SESSION['usuario2'] = [
                    'id_usuario' => $usuario['idUsuario'],
                    'nombre'     => $usuario['nombre'],
                    'rol'        => $usuario['idRol'],
                    'correo'     => $usuario['email']
                    ];
                    // REDIRECCIÓN CORRECTA
                    //$inter->inicio();
                   header("Location: /ventaPedido");
                    exit(); // importante detener ejecución

                } else {
                    $datos['error'] = "No tienes permisos de administrador.";
                }
            } else {
                $datos['error'] = "Email o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $datos['error'] = "Error al iniciar sesión: " . $e->getMessage();
        }
    }

    // Mostrar la vista de login (si no se envió POST o hubo error)
    $this->render('Comercial/inicioSesionCliente', $datos);
}

  





  public function datos2()
  {

    $dao = new DAO;
    if (isset($_POST['guardar'])) {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        
        if ($dao->insertar($nombre, $direccion, $telefono)) {
            echo "Centro de salud registrado correctamente";
        } else {
            echo "Error al registrar el centro de salud.";
        }
      }

      $dato = [

        "uno" => " "
      ];
      
    $this->load_view('inicio', $dato);

}

public function tabla()
  {

    $dao = new DAO;
    

      $dato = $dao->listar();
      
    $this->load_view('tabla', $dato);

}

public function cerrarSesion(){
session_start();
session_destroy();


header('Location: /ventaPedido');


}


   public function deleteUser(): void
    {
        if(isset($_POST['submit'])){
        $id = $_POST['id_usuario'] ?? 0;
        $ok = $this->daoUser->deleteUsuario($id);

         $this->datos();
        }



    }



}
?>