<?php include('connection.php') ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal</title>
    <link rel="stylesheet" href="css/login-portal.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <?php include("header.php"); ?>
</head>
<body>

    <div class="page">
        
    </div>
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
                <form name="login" action="login-portal.php" method="POST" id="log-in">
                    <div class="log-in-id">
                        <p>Username</p>
                        <input type="text" name="username">
                    </div>
        
                    <div class="log-in-password">
                        <p>Password</p>
                        <input type="text" name="password">
                    </div><br>
                    <button type="submit" class="btn btn-info" name="login">Login</button>
                </form><br><br> 
                <form action="password-recovery.php">
                    <input type="submit" class="btn btn-info" value="Forgot your password?" />
                </form><br>
                <form action="create-account.php">
                    <input type="submit" class="btn btn-info" value="Want to create an account?" />
                </form>
            </div>
        
        
        <div class="waves">
            <img class="waves-bottom" src="images/waves.png" alt="Waves graphic">
        </div>
</body>       
<script type="text/javascript">

        //ripple effect for buttons
        const buttons = document.querySelectorAll('a.menu_button');
        buttons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;

                let ripples = document.createElement('span');
                ripples.style.left = x + "px";
                ripples.style.top = y + "px";
                this.appendChild(ripples);

                setTimeout(() => {
                    ripples.remove()
                }, 1000);
            })
        })
</script>       
    
</html>