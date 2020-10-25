<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Index</title>
        <link href="css/bootstrap-4.3.1.css" rel="stylesheet" type="text/css" />
        <style>
            /* Pad the vision text */
            .vision {
                padding-right: 100px;
                padding-left: 100px;
            }
            .container {
                display: flex;
            }
            /* Remove padding from default BS4 elements */
            .no-padding {
                padding-left: 0;
                padding-right: 0;
            }
            /* Centered text for buttons */
            .centered {
                position: absolute;
                top: 50%;
                text-align: center;
                left: 50%;
                transform: translate(-50%, -50%);
                font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
                font-size: 40px;
                color: #fffefe;
                /* Add shadow for more contrast */
                text-shadow: 0px 6px 8px black;
            }
            /* Hover activated blur animation */
            .imgbutton:hover {
                animation: blur 0.3s forwards;
            }
            /* keyframes for above blur */
            @keyframes blur {
                /* Start frame */
                0% {
                    -webkit-filter: blur(0px);
                }
                /* End frame */
                100% {
                    -webkit-filter: blur(5px);
                }
            }
        </style>
    </head>
    <body>
    <!-- Navbar with logo -->
    <nav class="navbar navbarlogo fixed-top navbar-expand-lg navbar-light bg-light">
            <img src="img/logo.png" width="449" height="48" alt="" />
            <ul class="navbar-nav mr-auto"></ul>
    </nav>

        <!-- Bootstrap columns -->
        <div class="row">
            <!-- Right button -->
            <div class="col-lg-6 no-padding shadow">
                <!-- Link to map file -->
                <a href="viewmap.php">
                    <img href="public.php" class="imgbutton" src="img/leftbutton.jpg" width="100%" height="100%" alt="" />
                    <div class="centered">View Map</div>
                </a>
          </div>
            <!-- Left button -->
            <div class="col-lg-6 no-padding">
                <!-- Link to gov page file -->
                <a href="gov.php">
                    <img href="login-portal.php" class="imgbutton" src="img/rightbutton.jpg" width="100%" height="100%" alt="" />
                    <div class="centered">Government Login</div>
                </a>
          </div>
        </div>
        <!-- Our vision text -->
        <div class="jumbotron" style="background-color: #ffffff;">
            <!-- Large Heading -->
            <h1 class="display-4"><center>Our Vision</center></h1>
            <div class="vision lead">
                <center>
                    Water Systems Australia aims to make it easier for the Australian public to have access to comprehensive water quality data. Additionally, we provide a intuitive management system that allows government officials to
                    update water quality data for waterbodies that are flagged by the public.
                </center>
            </div>
        </div>

        <!-- Footer Image -->
        <div id="ocean">
            <img src="img/waves.png" width="100%" height="100%" alt="" />
        </div>

        <!-- Scripts -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>
