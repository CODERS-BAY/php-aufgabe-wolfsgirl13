<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>FirmenLogin</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Mega&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>


<?php session_start(); 

    $class = (isset($_SESSION['color'])) ? $_SESSION['color'] : '';
    ?>

<body class="<?php echo $class; ?>">

    <!-- wenn wir eingeloggt sind, dann sehen wir folgendes... -->
    <?php if(isset($_SESSION['username'])) : ?>

    <header>
        <!-- Navigation -->

        <div class="container">

            <div class="row">

                <div class="col-lg-2">
                    <?php if(isset($_SESSION['teams_picture'])): ?>
                    <div class="teamspicture">
                        <img src="<?php echo $_SESSION['teams_picture'] ?>" class="img-fluid" width="170px" /></div>
                    <?php  endif; ?></div>

                <div class="col-lg-7">
                    <nav>
                        <ul class="nav-area">
                            <li class="nav-item"><a class="nav-link" href="index.php">Notizen</a>
                            </li>
                            

                            <?php if($_SESSION['rights'] == 'user') : ?>
        
                            <li class="nav-item"><a class="nav-link" href="user_update.php">Profil updaten</a>
                            </li>
                            <?php endif; ?>

                            <?php if($_SESSION['rights'] == 'admin') : ?>
                            <!-- wenn Rechte = Admin z.B dann .... kommt usermanagement.php-->
                            <li class="nav-item"><a class="nav-link" href="usermanagement.php">Usermanagement</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="teammanagement.php">Teammanagement</a>
                            </li>
                            <?php endif; ?>

                            <?php if($_SESSION['rights'] == 'teamleiter') : ?>
                            <li class="nav-item"><a class="nav-link" href="teamleiter.php">Teamleiter</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="user_update.php">Profil updaten</a>
                            </li>
                            <?php endif; ?>

                            <li class="nav-item"><a class="nav-link" href="remind.php">Merkliste</a></li>

                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-1"><id class="nav_user"><?php echo $_SESSION['username']?></id>
                </div>
            
                <div class="col-lg-2"> <?php if(isset($_SESSION['user_picture'])): ?>
                <div class="userpicture"><img src="<?php echo $_SESSION['user_picture'] ?>" width="150px"
                        style="border-radius: 50%" ; /></div>
                <?php endif; ?></div>

                </div>
            </div>

        </div>
    </header>

    <?php  endif; ?>