<?php include('connection.php') ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account</title>
    <link rel="stylesheet" href="css/create-account.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <?php include("header.php"); ?>
</head>
<body>

    <div class="page">
        
    </div>

            <div class="errors">
                <?php include('errors.php'); ?>
            </div>
        
            <div class="log-in-form">
                <form name="create-account" action="create-account.php" onsubmit="return validation()" method="POST" id="create-account">
                    <div class="log-in-id">
                        <p>Username</p>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="log-in-password">
                        <p>Password</p>
                        <input type="text" name="password-1" id="password">
                    </div>
                    <div class="log-in-password-2">
                        <p>Confirm password</p>
                        <input type="text" name="password-2" id="password">
                    </div><br>                    
                    <div class="log-in-branch">
                        <p>Government Branch</p>
                        <input type="text" name="branch" id="branch">
                    </div>       
                    <div class="log-in-role">
                        <p>Job Role</p>
                        <input type="text" name="role" id="role">
                    </div> 
                    <div class="log-in-suburb">
                        <p>Suburb/Region</p>
                        <input type="text" name="suburb" id="suburb">
                    </div><br>                                                      
                    <button type="submit" class="btn btn-info" name="create">Create account</button>
                </form>
            </div>
        
        
        <div class="waves">
            <img class="waves-bottom" src="images/waves.png" alt="Waves graphic">
        </div>
       
       <script type="text/javascript">


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
    
    
    
</body>
</html>