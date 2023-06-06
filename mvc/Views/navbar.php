<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Title</title>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light">
    <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <i class="fas fa-bars"></i>
    </button>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="navbar-brand" href="#"
                ><img
                        id="MDB-logo"
                        src="https://mdbcdn.b-cdn.net/wp-content/uploads/2018/06/logo-mdb-jquery-small.png"
                        alt="MDB Logo"
                        draggable="false"
                        height="30"
                    /></a>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center mx-auto">
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="/public/index.php"><i class="fas fa-plus-circle pe-2"></i>Currencies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="/mvc/Views/calculator.php?page=calculator"><i class="fas fa-bell pe-2"></i>Calculator</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Navbar -->
</body>
</html>
