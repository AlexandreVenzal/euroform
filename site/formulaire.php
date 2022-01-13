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
    

    ?>




    <?php

    //Vérifie les caractères rentrés dans les catégories du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $adresse = test_input($_POST["adresse"]);
        $mdp = test_input($_POST["mdp"]);
        $codePostal = test_input($_POST["codePostal"]);
        $ville = test_input($_POST["ville"]);
        $statut = test_input($_POST["statut"]);
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
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }


        if (empty($_POST["adresse"])) {
            $adresseErr = "Adresse is required";
        } else {
            $adresse = test_input($_POST["adresse"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^[a-zA-Z-0-9' ]*$/", $adresse)) {
                $adresseErr = "Invalid adresse format";
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

        if (empty($_POST["codePostal"])) {
            $codePostalErr = "codePostal is required";
        } else {
            $codePostal = test_input($_POST["codePostal"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^[0-9' ]*$/", $codePostal)) {
                $codePostalErr = "Invalid code postal";
            }
        }

        if (empty($_POST["ville"])) {
            $villeErr = "ville is required";
        } else {
            $ville = test_input($_POST["ville"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^[a-zA-Z-' ]*$/", $ville)) {
                $villeErr = "Invalid ville";
            }
        }

        if (empty($_POST["numTel"])) {
            $numTelErr = "Numero is required";
        } else {
            $numTel = test_input($_POST["numTel"]);
            // check if e-mail address is well-formed
            if (!preg_match("/^[0-9' ]*$/", $numTel)) {
                $numTelErr = "Invalid numero";
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
    }
    ?>

    <h2>PHP Form Validation Example</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        Name: <input type="text" name="name">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        E-mail:
        <input type="text" name="email">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        Adresse:
        <input type="text" name="adresse">
        <span class="error">* <?php echo $adresseErr; ?></span>
        <br><br>
        Code Postal:
        <input type="text" name="codePostal">
        <span class="error">* <?php echo $codePostalErr; ?></span>
        <br><br>
        Ville:
        <input type="text" name="ville">
        <span class="error">* <?php echo $villeErr; ?></span>
        <br><br>
        Mdp:
        <input type="password" name="mdp">
        <span class="error">* <?php echo $mdpErr; ?></span>
        <br><br>
        N° Telephone:
        <input type="text" name="numTel">
        <span class="error">* <?php echo $numTelErr; ?></span>
        <br><br>
        Formation:
        <select name="statut">
            <option>BTS SIO</option>
            <option>BTS MCO</option>
        </select>


        <br><br>
        <input type="submit" name="submit" value="Submit">

    </form>

    <?php


    if (empty($_POST['mdp']) || empty($_POST['email'])) {
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-Z-' ]*$/", $name) && preg_match("/^[a-zA-Z0-9' ]*$/", $adresse)) {

        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO test (name, email, adresse, codePostal, ville , mdp, numTel, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissis", $_POST['name'], $_POST['email'], $_POST['adresse'], $_POST['codePostal'], $_POST['ville'], md5($_POST['mdp']), $_POST['numTel'], $_POST['statut']);
        $stmt->execute();


        header('Location: formulaire.php');
    }


    ?>
</body>

</html>