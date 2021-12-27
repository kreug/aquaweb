<?php 
// starts session
session_start();
$pdo = new PDO('mysql:host=51.15.100.196;dbname=aquaweb', 'aquaweb', 'webaqua123');
$indexphp = '../';
$user = null;
$password = null;

// checks if login is triggerd
if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // ecxecutes query
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
}

//<p>https://www.php-einfach.de/experte/php-codebeispiele/loginscript/</p>
?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" type="./x-icon" href="../../favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php // imports header
        include('../templates/header.php');
    ?>
    
    <main>
        <?php 
            // throws error message
            if(isset($errorMessage)) {
                echo $errorMessage;
            }
            echo '<div class="form">';
            // check if data is given
            if(isset($user) && isset($password)){
                // verifies data and sets usersession
                if ($user !== false && password_verify($password, $user['password'])) {
                    $_SESSION['userid'] = $user['id'];
                    header('Location: /dhbw/tinf20-aquaweb/php/aquarium.php?user=' . $_SESSION['userid']);
                }
            }
        ?>
        <?php
        $showFormular = true; // Variable to check if login is shown

        if($showFormular) {
        ?>
            <div class="container-fluid vh-100" style="margin-top:300px">
                <div class="" style="margin-top:200px">
                    <div class="rounded d-flex justify-content-center">
                        <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                            <div class="text-center">
                                <h3 class="text-primary">Sign In</h3>
                            </div>
                            <form action="?login=1" method="post">
                                <div class="p-4">
                                    <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                                class="bi bi-person-plus-fill text-white"></i></span>
                                        <label>
                                            <input name="username" type="text" class="form-control" placeholder="Username">
                                        </label>
                                    </div>
                                    <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                                class="bi bi-key-fill text-white"></i></span>
                                        <label>
                                            <input name="password" type="password" class="form-control" placeholder="password">
                                        </label>
                                    </div>
                                    <button class="btn btn-primary text-center mt-2" type="submit">
                                        Login
                                    </button>
                                    <p class="text-center mt-5 text-secondary">Don't have an account?
                                        <span class="text-primary">Sign Up</span>
                                    </p>
                                    <p class="text-center text-primary">Forgot your password?</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
    </main>

    <?php // imports footer
        include('../templates/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>