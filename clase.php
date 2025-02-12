<?php
require_once 'config1.php';

try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta="SELECT * FROM actor"; //<!-- consulta que muestre el nombre y apellido de los actores -->
    $stmt=$conn->query($consulta); //query es para acciones sencillas, como llamar datos solamente
    $actores=$stmt->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($actores);

}catch(PDOException $pe){
    die(" Could not connect to the database $dbname :" . $pe->getMessage());
}

//Verificar si se envio el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){ //el metodo post es para enviar solicitud
    $first_name =$_POST["first_name"] ?? null;   //decalaracion de variable que almacenara el nombre proveniente del formulario
    $last_name = $_POST["last_name"] ?? null;

    if($first_name && $last_name){
        $sql = "INSERT INTO actor (first_name, last_name, last_update) VALUES (:first_name, :last_name, NOW())"; //el now adquiere/registra la hora y fecha donde se ejecuta la consulta
        $stmt = $conn->prepare($sql); //en formularios se utiliza prepare para evitar ser victima de inyeccion de sql
        $stmt->execute([
            "first_name" => $first_name,
            "last_name" => $last_name
        ]); // array asociativo
        echo "Actor agregado correctamente";
        echo $_SERVER["REMOTE_ADDR"]; //usado para saber la ip remoto
    } else{
        echo "Todos los campos son obligatorios.";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"

    <title>Mi primera pagina en php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 style="...">Bienvenidos</h1>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!--<div class="container">-->
<!--    <button type="button" class="btn btn-outline-primary">Primary</button>-->
<!--</div>-->

<!--FORMULARIO-->
<div class="container">
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre del Actor</label>
            <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Apellido del Actor</label>
            <input type="text" name="last_name" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>





<?php //foreach ($actores as $actor) { ?>
<!--<div class="card">-->
<!---->
<!--    <div class="card-body">-->
<!--        --><?php //echo $actor['first_name'].' - ' $actor['last_name']; ?>
<!---->
<!--    </div>-->
<!---->
<!--    --><?php //} ?>
<!--</div>-->
<?php
////foreach ($aulass as $aulas) {
////    echo "<h4>"."ID: ". $aulas['edificio'].' - '.'Nombre de Aula: '. $aulas['piso'].' - '.' Campus: '. $aulas['campus']."</h4>";
////}
////?>


</body>

</html>
