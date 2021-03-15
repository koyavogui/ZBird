
<section class="container">
    <section class="d-flex justify-content-center">
        <?php
            require "../../database/database.php";
            @session_start();
            $page  = $_SESSION['numPage'];
            $act = $db->prepare("SELECT * FROM activities WHERE page =$page ORDER BY create_at DESC");
            $act -> execute();
            $nbr = $act->rowCount();
            $act = $act->fetchAll(PDO::FETCH_OBJ);
            $db = null;

        ?>
        <h2>LES ACTIVITES (<?php echo $nbr; ?>)</h2>
    </section>
    <section class="mx-5 px-5 row d-flex justify-content-between">
        <a href="./" class="col-md-3 btn btn-warning   rounded-0">Toutes les Activités</a>
        <a href="#" class="col-md-3 btn btn-warning   rounded-0" id="admin">Administration</a>
        <a href="#" class="col-md-3 btn btn-warning  rounded-0" id="user">Utilisateur</a>
    </section>
    <section class="mt-3 mb-5 ">
        <table class="table table-striped border-dark table-sm">
            <thead class="bg-warning">
                <tr class="">
                <th scope="col">Auteur</th>
                <th scope="col">Actions</th>
                <th scope="col">Description</th>
                <th></th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($act as $a) {
            ?>
            <tr class="<?php if ($a->authorActivity === 'Utilisateur') {
                            echo 'userRow';
                        }else{
                            echo 'adminRow'; 
                        } ?>">
                <td>
                    <?php
                            echo $a->authorActivity; 
                    ?>
                </td>
                <td><?php echo $a->actionActivity ?></td>
                <td><?php echo $a->descActivity ?></td>
                <td></td>
                <td class=""><?php echo date_format(date_create($a->create_at), "d/m/y") ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
        <div class="row d-flex justify-content-center align-items-center">
            <nav aria-label="Page navigation example  ">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link text-warning" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item"><a class="bg-warning page-link text-white" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-warning" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-warning" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link text-warning" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
     </section>
</section>
