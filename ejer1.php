<?php
require_once 'config1.php';

//verificar la conexion
try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta="SELECT f.film_id, f.title, COUNT(r.rental_id) AS total_rentals
                FROM film f
                LEFT JOIN inventory i ON f.film_id = i.film_id
                LEFT JOIN rental r ON i.inventory_id = r.inventory_id
                GROUP BY f.film_id, f.title
                ORDER BY total_rentals DESC
                LIMIT 5;"; //<!-- consulta que muestre el nombre y apellido de los actores -->
    $stmt=$conn->query($consulta);
    $peliculas=$stmt->fetchAll(PDO::FETCH_ASSOC); //el fetchAll trae todos los datos y los almacena en un array
//    var_dump($actores);

}catch(PDOException $pe){
    die(" Could not connect to the database $dbname :" . $pe->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Top 5 de peliculas mas rentadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-md">
<h1 style="...">Le muestro aca Las 5 Peliculas mas rentadas </h1>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Titulo</th>
        <th scope="col">Rentas</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($peliculas as $pelicula) { ?> <!-- Recorre todos los registros del arreglo. Itera sobre un array llamado $aulass. En cada iteración, asigna el valor actual a la variable $aulas.*/-->
        <tr>
            <td><?php echo $pelicula['film_id']; ?></td>
            <td><?php echo $pelicula['title']; ?></td>
            <td><?php echo $pelicula['total_rentals']; ?></td>

        </tr>
    <?php } ?>
    </tbody>
</table>
</div>


</body>

</html>

