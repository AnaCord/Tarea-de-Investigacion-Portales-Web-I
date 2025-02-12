<?php
require_once 'config1.php';

//verificar la conexion
try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta="SELECT s.first_name, s.last_name, COUNT(r.rental_id) AS total_rentals
                FROM staff s
                LEFT JOIN rental r ON s.staff_id = r.staff_id
                GROUP BY s.staff_id
                ORDER BY total_rentals DESC;"; //<!-- consulta que muestre el nombre y apellido de los actores -->
    $stmt=$conn->query($consulta);
    $staffUsuarios=$stmt->fetchAll(PDO::FETCH_ASSOC); //el fetchAll trae todos los datos y los almacena en un array
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




    <div class="container">
        <h1 class="text-center">Peliculas Rentadas</h1>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <div class="row">
            <?php foreach ($staffUsuarios as $usuario) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <!-- Puedes añadir una imagen si lo deseas, con una URL en src -->
                        <img src="..." class="card-img-top" alt="Imagen del Usuario">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $usuario['first_name'] . ' ' . $usuario['last_name']; ?></h5>
                            <p class="card-text">Total de películas rentadas: <?php echo $usuario['total_rentals']; ?></p>
                            <a href="#" class="btn btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>



</body>

</html>

