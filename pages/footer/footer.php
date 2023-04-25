<style>
    /* ---------- Footer ---------- */
    .footer-list {
    margin-top: 1em;
    margin-bottom: 1em;
    padding: 0;

    font-size: 0.8em;
    list-style: none;
    }

    .footer-list li {
    margin: 0em 0.8em 0.5em 0em;
    color: var(--grey-1);
    }

    .footer-list li a {
    text-decoration: none;
    color: var(--grey-1);
    }

    .footer-list li a:hover {
    color: var(--white-4);
    transition: 0.2s;
    }

    .footer-list li a img {
    width: 2em;
    height: 2em;
    }

    .footer-color {
    background-color: var(--footer);
    }

    @media screen and (max-width:770px){
            #fantom_div{
            margin-bottom:0em;
        }   
        .footer_copyright li{
            margin-right:0!important;
        }
        .disapear_foot{
            display:none;
        }
        .no_disapear_foot{
            margin-bottom:1em;
        }
    }


</style>

<footer class="container-fluid pt-5 footer-color">
    <!-- footer-upper -->
    <div class="row border-bottom pb-3 ps-4 d-flex justify-content:center">
        <div class="col-0 col-md-1" id="fantom_div"></div>
        <div class="d-block mb-5 col-8 col-md-4 col-xl-6">
            <img style="width:10em" src="/pages/footer/img/Flutters-White.svg">
        </div>
        <div class="col-10 col-md-2 col-xl-1 me-4 disapear_foot">
            <h5 class="text-white">Navigation</h5>
            <ul class="footer-list d-flex d-md-block">
                <li><a href="/">Accueil</a></li>
                <li><a href="/pages/films/films">Films</a></li>
                <li><a href="">A propos</a></li>
            </ul>
        </div>
        <div class="col-10 col-md-2 col-xl-1 disapear_foot">
            <h5 class="text-white">Films</h5>
            <ul class="footer-list d-flex d-md-block">
                <li><a href="/pages/films/films">A l'affiche</a></li>
                <li><a href="/pages/films/films">Tous les films</a></li>
            </ul>
        </div>
        <div class="col-12 col-md-2 col-xl-2 no_disapear_foot">
            <h5 class="text-white">Contact</h5>
            <ul class="footer-list d-block" id="footer_contact">
                <li><a href="mailto:flutters.contact@gmail.com">flutters.contact@gmail.com</a></li>
                <li><a href="">28 Boulevard de la Misère, Paris 15ème</a></li>
                <li><a href="">05 85 76 21 03</a></li>
            </ul>
        </div>
        <div class="col-0 col-xl-1"></div>
    </div>
    <!-- footer-lower -->
    <div class="row pt-3 pb-4">
        <div class="col-1"></div>
        <div class="col-12 col-xl-7">
            <ul class="d-flex footer-list footer_copyright d-flex w-lg-100 justify-content-xl-start justify-content-center flex-column align-items-center flex-md-row ">
                <li class="me-4">Copyright © 2023 Flutters</li>
                <li class="me-4"><a href="">Politique de confidentialité</a></li>
                <li class="me-4"><a href="">Conditions d'utilisation</a></li>
                <li class="me-4"><a href="">Mentions légales</a></li>
            </ul>
        </div>
        <div class="d-none d-xl-block col-2"></div>
        <div class="col-12 col-xl-2 d-flex w-lg-100 justify-content-center" ;>
            <ul class="d-flex footer-list">
                <li><a href=""><img class="on_click_action" src="/pages/footer/img/Instagram.png"></a></li>
                <li><a href=""><img class="on_click_action" src="/pages/footer/img/Tiktok.png"></a></li>
                <li><a href=""><img class="on_click_action" src="/pages/footer/img/Twitter.png"></a></li>
                <li><a href=""><img class="on_click_action" src="/pages/footer/img/Youtube.png"></a></li>
            </ul>
        </div>
    </div>
</footer>