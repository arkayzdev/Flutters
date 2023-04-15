<style>
    #nav_body {
    font-family: "Open Sans", sans-serif;
    font-weight: 700;
    font-size: 1.1em;
    }

    /* Colors root*/
    :root {
    --white-1: #ffffff;
    --white-2: #f9f9f9;
    --white-3: #f2f3f4;
    --white-4: #ecedee;
    --red: #e32828;
    --grey-1: #3c434b;
    --grey-2: #282a2d;
    --black: #000000;
    --footer: #101114;
    }

    /* ----- navbar ----- */
    .nav_body {
        position: absolute;
        width:100%;
    }

    .modal-open {
    padding-right:0px!important;
    }

    /* --- nav_list --- */
    #nav_link {
    list-style: none;
    }
    #nav_link a {
    color: white;
    list-style: none;
    margin: 0.3em 0.8em 0 0.3em;
    font-size: 1.2em;
    font-weight: 600;

    }

    #nav_link a:hover {
    color: #e32828;
    }

    /* --- nav_modal--- */
    #modal-content {
    background-color: transparent;
    }

    #nav_modal_burger {
    background: transparent;
    border: none;

    background-color: #e32828;

    width: 2.4em;
    height: 2.4em;

    margin: 0em 1em 0em 0em;

    border-radius: 0.5em;
    }
    #nav_modal_burger img {
    width: 2em;
    }

    #nav_modal_btn {
    align-self: flex-end;
    background: transparent;
    color: white;
    border: none;
    }
    #nav_modal_btn img {
    width: 2em;
    }

    #nav_link_modal {
    list-style: none;
    }
    #nav_link_modal a {
    color: white;
    list-style: none;
    margin: 0.5em 0.8em 0.5em 0.3em;
    font-size: 1.3em;
    font-weight: 600;
    }
    #nav_link_modal a:hover {
    color: #e32828;
    }

    #nav_modal_divider {
    border-top: 3px solid white;
    margin-top: 1em;
    padding-top: 1em;
    }

    .modal-backdrop {
    background-color: black;
    opacity: 0.8!important;
    }

    @media screen and (max-width: 1248px) {
    #nav_link {
        display: none !important;
    }
    #nav_profile {
        display: none !important;
    }
    #nav_modal_burger {
        display: flex !important;
        justify-content: center;
        align-items: center;

        margin: 0em 1em 0em 1em;
    }
    }
</style>

<!-- Navbar -->
<nav class="d-flex flex-row mt-4 justify-content-between nav_body">
    <div class="d-flex">
        <!-- Flutters Brand -->
        <a class="d-none d-lg-block" href="/"><img class="nav_logo ms-4" style="width:10em;" src="/pages/nav/img/header-logo.svg"></a>
        <!-- nav list -->
        <ul class="d-flex" id="nav_link">
            <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="/">Films</a></li>
            <li class="nav-item"><a class="nav-link" href="/">Événements</a></li>
            <li class="nav-item"><a class="nav-link" href="/">À propos</a></li>
        </ul>
    </div>
    <div class="d-flex">
        <!-- Button trigger modal -->
        <button type="button" id="nav_modal_burger" class="d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <img src="/pages/nav/img/nav_modal_burger.svg"> 
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modal-content" style="border:none">
                    <div class="modal-body d-flex flex-column mt-5">
                        <button type="button" id="nav_modal_btn" data-bs-dismiss="modal" aria-label="Close"><img src="/pages/nav/img/white_cross.svg"></button>
                        <ul class="d-flex flex-column align-items-center" id="nav_link_modal">
                            <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                            <li class="nav-item"><a class="nav-link" href="/">Films</a></li>
                            <li class="nav-item"><a class="nav-link" href="/">À propos</a></li>
                            <?php 
                                if (!isset($_SESSION['email'])){
                                    echo '
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/pages/login/sign_in/sign_in.php">Se connecter</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/pages/login/sign_up/sign_up.php">Inscription</a></li> 
                                    ';
                                } elseif (isset($_SESSION['email']) && $_SESSION['user_type']=="Normal"){
                                    echo '
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="#">Profil</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Mes réservations</a></li>
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/deconnexion.php">Deconnexion</a></li>
                                    ';

                                } elseif(isset($_SESSION['email']) && $_SESSION['user_type']=="Admin"){            
                                    echo '
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="#">Profil</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/deconnexion.php">Deconnexion</a></li>
                                    ';
                                };
                            ?>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>