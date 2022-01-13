<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>

<body>
    <?php
    // define variables and set to empty values
    $name = $email = $adresse = $codePostal = $ville = $numTel = $mdp = $statut = "";
    $nameErr = $emailErr = $adresseErr = $codePostalErr = $villeErr = $numTelErr = $mdpErr = $statutErr = "";



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inscription";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    session_start();

    $newEmail = $_SESSION['email'];
   
    $sql = "SELECT  name FROM test";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    $newName = $row['name'];
  }
} else {
  echo "0 results";
}
 
    ?>
    <h1>Connexion reussie, bienvenue <?php echo $newName ?></h1>

    <?php session_reset();?>
</body>

</html>