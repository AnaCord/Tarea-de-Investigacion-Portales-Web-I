<?php
require_once 'config1.php';

//verificar la conexion
try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta="SELECT c.name AS category_name, COUNT(f.film_id) AS total_films
                FROM category c
                LEFT JOIN film_category fc ON c.category_id = fc.category_id /*/<!--Para asegurar que todas las categorías se incluyan, incluso si no hay películas asignadas a ellas -->*/
                LEFT JOIN film f ON fc.film_id = f.film_id
                LEFT JOIN inventory i ON f.film_id = i.film_id
                WHERE i.inventory_id IS NOT NULL
                GROUP BY c.name
                ORDER BY total_films DESC;"; //<!-- consulta que muestre el nombre y apellido de los actores -->
    $stmt=$conn->query($consulta);
    $categorias=$stmt->fetchAll(PDO::FETCH_ASSOC); //el fetchAll trae todos los datos y los almacena en un array
//    var_dump($actores);

}catch(PDOException $pe){
    die(" Could not connect to the database $dbname :" . $pe->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Peliculas Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-md">
    <h1 class="text-center">Peliculas Disponibles </h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">Categoría</th>
            <th scope="col">Cantidad de Películas Disponibles</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($categorias as $categoria) { ?> <!-- Recorre todos los registros del arreglo. Itera sobre un array llamado $aulass. En cada iteración, asigna el valor actual a la variable $aulas.*/-->
            <tr>
                <td><?php echo $categoria['category_name']; ?></td>
                <td><?php echo $categoria['total_films']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


</body>

</html>

