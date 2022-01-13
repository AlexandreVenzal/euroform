<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    

    <style>
        /* change couleur texte * requis 
        */
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    // define variables and set to empty values
    $email =  $mdp= "";
     $emailErr = $mdpErr = "";
    

    
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
    

    ?>




    <?php

    //Vérifie les caractères rentrés dans les catégories du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = test_input($_POST["email"]);
        
        $mdp = test_input($_POST["mdp"]);
       
        
        /*$gender = test_input($_POST["gender"]);*/
    }

    //Vérifie les caractères rentrés et leurs concordences.
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
        

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }




        if (empty($_POST["mdp"])) {
            $mdpErr = "Password is required";
        } else {
            $mdp = test_input($_POST["mdp"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^[a-zA-Z-' ]*$/", $mdp)) {
                $mdpErr = "Invalid password";
            }
        }


        if (empty($_POST["statut"])) {
            $numTelErr = "Statut is required";
        } else {
            $numTel = test_input($_POST["statut"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^[a-zA-Z-' ]*$/", $statut)) {
                $statutErr = "Invalid statut";
            }
        }
       
        $sql = "SELECT email, mdp FROM test WHERE email = '$email' AND mdp = '".hash('md5', $mdp)."'";
        $result = $conn->query($sql);
        
        $rows = mysqli_num_rows($result);
        if($rows==1){
            
            $_SESSION['email'] = $email;
            header("Location: connecte.php");
        }else{
          
          $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
          echo($message);
        

        }
         
          $conn->close();
    }
    ?>

    <h2>PHP Form Validation Example</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    Email:
        <input type="text" name="email">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        
      
        Mdp:
        <input type="password" name="mdp">
        <span class="error">* <?php echo $mdpErr; ?></span>
        <br><br>
      
      
        
        
       
        <input type="submit" name="submit" value="Submit">

    </form>

    
</body>

</html>