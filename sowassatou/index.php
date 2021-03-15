<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
 
    $pieces = explode("/", $_SERVER['REQUEST_URI']);
    $nomPage = $pieces[2] ;
    require "../database/database.php";
    $page = $db->prepare("SELECT * FROM pages WHERE nomDossierPage=:nomPage");
    $page->bindParam(':nomPage', $nomPage);
    $page->execute();
    if ($page->rowCount() == 1) {
        $page = $page->fetch(PDO::FETCH_OBJ);
    }else {
         exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require '../includes/head.php';?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Zokubird Connexion</title>
</head>
<body class="container-fluid p-0">
        <!-- Entente-->
    <header class="bg-warning container-fluid mb-4 sticky-top" style="height :60px;"></header>
    <div class="container">

        <!-- Corps-->
        
        <div class="row">
            <section class="col-12 col-lg-4 my-5 ">
                <section class="row d-flex flex-column mt-5 align-items-center align-self-center ">
                    <article class="p-2">
                        <img src="./../images/zbird.png" alt="logo de zokubird" srcset="" class="img-fluid mx-auto d-block" style="max-height :30vh;">
                    </article>
                    <article class="text-center">
                        <p class="fs-3">Bonjour, posez-moi une question j’écoute !</p>
                    </article>
                    <article class="btn" style="font-size: 3em;" id="mic">
                        <i class="fas fa-microphone-alt text-warning" id="micListen"></i>
                    </article>
                </section>
            </section>
            <section class="col-12 col-lg-8 mb-5">
                <input type="hidden" name="idpage" value="<?php echo @$page->numPage; ?>" id="idpage">
                <div class=" my-3">
                    <div class=""  style="" id="ressourcesImage">
                        <img src="./uploaded/<?php echo $page->imgPage; ?>" alt="image de description de l'hotel de sunshine" srcset="" class="img-fluid" style="">
                    </div>
                    <div class="ratio ratio-16x9" id="ressourceIframe">
                        <iframe src="https://www.youtube.com/embed/ogAhBq2CrvY" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <article>
                        <h2><?php echo $page->nomPage; ?></h2>
                        <strong><hr></strong>
                    </article>
                    <article>
                        <h5>Adresse</h5>
                        <p>PK14, Lagune Aby d’Assinie Mafia, Assinie Côte d'Ivoire</p>
                    </article>
                    <article>
                        <h5>Email :</h5>
                        <p><?php echo $page->emailPage; ?></p>
                    </article>
                    <article>
                        <h5>Téléphone :</h5>
                        <p><?php  ?></p>
                    </article>
                    <article>
                        <a href="<?php echo $page->facebookPage; ?>" style="font-size: 2em;" target="blank" class="text-primary"><i class="bi bi-facebook"></i></a>
                        <a href="<?php echo $page->youtubePage; ?>" style="font-size: 2em;" target="blank" class="text-danger ml-1"><i class="bi bi-youtube"></i></a>
                        <a href="<?php echo $page->twitterPage; ?>" style="font-size: 2em;" target="blank" class="text-info ml-1"><i class="bi bi-twitter"></i></a>
                        <a href="<?php echo $page->twitterPage; ?>" style="font-size: 2em;" target="blank" class="text-dark ml-1"><i class="bi bi-globe2"></i></a>
                    </article>
                </div>
            </section>
        </div>
    </div>
        <!-- footer-->
        <footer class="bg-warning text-light mt-2 text-center fixed-bottom fs-3" style="height :40px;"> Copyright@ Koya Michel</footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" integrity="sha512-LW9+kKj/cBGHqnI4ok24dUWNR/e8sUD8RLzak1mNw5Ja2JYCmTXJTF5VpgFSw+VoBfpMvPScCo2DnKTIUjrzYw==" crossorigin="anonymous"></script>
     
    <script src="../script/zokubird.js"></script>
</body>
</html>