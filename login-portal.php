<html>
    <head>  
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title> Government Portal </title>
    	<link rel="stylesheet" href="css/login-portal.css">
    	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
     	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
         crossorigin=""/>
         <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
     	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
         crossorigin=""></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <?php include('connection.php'); ?>
    </head>
    <body>  
    <div class="grid-container">
        <div class="sidebar">
            <div class="button-box">
                <a href="index.php">
                    <img src="images/logo.svg" id="logo" alt="Water Systems Australia Logo">
                </a>
                <div class="messages">
                <?php include('errors.php'); ?>
                        <?php if (isset($_SESSION['confirmation'])) : ?>
                            <div class="success">
                                <?php 
          	                        echo $_SESSION['confirmation']; 
          	                        unset($_SESSION['confirmation']);
                                ?>
                            </div>
  	                    <?php endif ?>
                </div>
                <div class="log-in-form">
                    <form name="login" action="login-portal.php" method="POST" id="login-form">
                        <div class="log-in-id">
                            <p>Username</p>
                            <input type="text" name="username">
                        </div>
                        <div class="log-in-password">
                            <p>Password</p>
                            <input type="PASSWORD" name="password">
                        </div><br>
                        <button type="submit" class="btn btn-info" name="login">Login</button>
                    </form><br><br> 
                </div>
                <a class="btn btn-primary" href="/create-account.php" role="button" id="create"> Want to create an account? </a>                                               
            </div>
    </div>
    <div class="waves">
    	<img class="waves-bottom" src="images/waves.png" alt="Waves Graphic">
    </div>

    </body>
    <script>
        jQuery(document).ready(function(){
            jQuery('#login').on('click', function(event) {        
                jQuery('#login-form').toggle('show');
            });
        });
        jQuery(document).ready(function(){
            jQuery('#forgot').on('click', function(event) {        
                jQuery('#forgot-form').toggle('show');
            });
        });
        jQuery(document).ready(function(){
            jQuery('#create').on('click', function(event) {        
                jQuery('#create-form').toggle('show');
            });
        });
    </script>

</html>