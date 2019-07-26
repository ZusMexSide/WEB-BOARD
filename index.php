<!DOCTYPE html>
<?php
include_once './backend/modelo/BD.php';
include_once './backend/modelo/MLogin.php';
include_once './backend/controlador/Clogin.php';
include_once './backend/logica/LLogin.php';
?>
<html>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>Login</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
            <a class="navbar-brand" href="#">WebBoard</a>
            <div class="collapse navbar-collapse p-2" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="login">
                    <form method="post" class="form-container">
                        <div class="col-md">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="row justify-content-center">
                                            <img class="img-responsive" id="img1" src="img/webBoard.svg" alt="img2">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="formulario">
                                            <div class="form-group">
                                                <br>
                                                <input  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario"  placeholder="Ingresa tu usuario">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Ingresa tu Password">
                                            </div>
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="login">   
                                                        <button type="submit" name="ingresar" class="btn btn-primary">Ingresar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="error">
                                            <?php
                                            if (isset($error)) {
                                                echo $error;
                                            }
                                            ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <script>
            var looper;
            var degrees = 0;
            function rotateAnimation(el, speed) {
                var elem = document.getElementById(el);
                if (navigator.userAgent.match("Chrome")) {
                    elem.style.WebkitTransform = "rotate(" + degrees + "deg)";
                } else if (navigator.userAgent.match("Firefox")) {
                    elem.style.MozTransform = "rotate(" + degrees + "deg)";
                } else if (navigator.userAgent.match("MSIE")) {
                    elem.style.msTransform = "rotate(" + degrees + "deg)";
                } else if (navigator.userAgent.match("Opera")) {
                    elem.style.OTransform = "rotate(" + degrees + "deg)";
                } else {
                    elem.style.transform = "rotate(" + degrees + "deg)";
                }
                looper = setTimeout('rotateAnimation(\'' + el + '\',' + speed + ')', speed);
                degrees++;
                if (degrees > 359) {
                    degrees = 1;
                }
                document.getElementById("status").innerHTML = "rotate(" + degrees + "deg)";
            }
        </script>
        <script>rotateAnimation("img1", 30);</script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>
