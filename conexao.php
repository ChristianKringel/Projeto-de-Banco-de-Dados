 <?php /*
//Login DataBase
$hostname = "localhost";
$bancodedados = "database";
$usuario = "root";
$senha = "";
$conn = new PDO("mysql:host=$hostname;dbname=" . $bancodedados, $usuario, $senha);

    if($conexao ->connect_errno)
        echo "Falha ao conectar: (" . $conexao->connect_errno . " ) " . $conexao->connect_errno;
   /* else 
        echo "Conectado ao banco de dados";
*/
   
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Defina o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Outras configurações, se necessário
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
     ?> 