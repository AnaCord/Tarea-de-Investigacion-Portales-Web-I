<?php
require_once 'config1.php';

try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta="SELECT * FROM actor"; //<!-- consulta que muestre el nombre y apellido de los actores -->
    $stmt=$conn->query($consulta);
    $actores=$stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($actores);

}catch(PDOException $pe){
    die(" Could not connect to the database $dbname :" . $pe->getMessage());
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
    <div class="container">
        <button type="button" class="btn btn-outline-primary">Primary</button>
    </div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Numero</th>
        <th scope="col">Apellido</th>
        <th scope="col">Fecha</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($actores as $actor) { ?> <!-- Recorre todos los registros del arreglo. Itera sobre un array llamado $aulass. En cada iteración, asigna el valor actual a la variable $aulas.*/-->
        <tr>
            <th scope="row"><?php echo $actor['actor_id']; ?></th>
           <td> <?php echo $actor['first_name']; ?></td> <!--//echo es que imprime, aqui se imprime el valor que representa piso en la base de datos del arreglo aulass-->
            <td><?php echo $actor['last_name']; ?></td>
            <td><?php echo $actor['last_update']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php
//foreach ($aulass as $aulas) {
//    echo "<h4>"."ID: ". $aulas['edificio'].' - '.'Nombre de Aula: '. $aulas['piso'].' - '.' Campus: '. $aulas['campus']."</h4>";
//}
//?>


</body>

</html>
