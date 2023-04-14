<head>
    <style>
        #nav_body{
            font-family: 'Open Sans', sans-serif;
            font-weight:700;
            font-size: 1.1em;
        }
        /* ---------- navbar ---------- */

        /* --- navbar-toggler --- */
        .navbar-toggler{
            margin-top:0.5em;
            background-color:#F2F3F4;
            border: 2px solid #E32828;
            color: #E32828;
        }

        /* --- left side list --- */
        #navbar_link .nav-link{color:grey; margin-right:0.8em;}
        #navbar_link .nav-link:hover{color:white;}

        /* --- nav_acc_burger --- */
        #nav_acc_burger .nav-link{color:#E32828;opacity:0.9;}
        #nav_acc_burger .nav-link:hover{color:white;}

        /* --- nav_searchbar --- */
        #nav_searchbar {
            margin: 1em 0em 1em 1em;
            width: auto;
            height: 2em;

            background-color: var(--grey-2);
            opacity: 0.7;

            border-radius: 10em;
        }
        #nav_searchbar>input {
            width: 19em;
            border: none;

            background-color: var(--grey-2);
            opacity: 0.7;

            border-radius: 10em;
        }
        #nav_searchbar>input:focus {
            width: 19em;

            color: var(--white-1);
            opacity: 1;

            border: none;
            box-shadow: none;
        }
        #nav_searchbar ::placeholder {
            color: var(--white-1);
            opacity: 1;
        }
        #nav_searchbar>button {
            background-color: transparent;
            opacity: 1;

            position: relative;
            top: -0.1em;
            right: -0.5em;

            border: none;
            border-radius: 10em;
            box-shadow: none;
        }

        /* --- nav_acc --- */
        .nav_acc {
            padding: 0.2em 0em 0.2em 0;
            margin-right: 1.5em;
            width: auto;

            border-left: 0.5px solid;
            border-left-color: white;
        }
        .nav_acc ul {
            margin: 0;
            padding: 0;
        }
        .nav_acc ul a{
            transition:0.5s;
        }
        .nav_acc ul a:hover{
            opacity:0.5;
        }
        #nav_login_sign_in {
            padding: 0.3em 1.5em 0.3em 1.5em;

            background-color: #E32828;
            color: white;
            text-decoration: none;

            border-radius: 0.5em;
        }
        #nav_login_sign_up {
            padding: 0.3em 1.5em 0.3em 1.5em;
            color: white;
            text-decoration: none;
            border-radius: 0.5em;
            text-shadow: 1px 2px 10px #000000;
        }

        /* --- nav_acc_avatar --- */
        #navbarDropdown img{
            width:3.5em;
            height:3.5em;
            border-radius:30px;
        }

        .dropdown-menu{
            background-color:#F2F3F4;
            border:none;
        }

        .dropdown-menu li a{
            font-size:1em;
            font-weight:600;

            color:black;
        }

        .dropdown-divider{
            border-color:black;
        }

        .dropdown-menu :last-child a{
            color:#E32828;
            opacity:0.9;
        }

        .dropdown-menu li a:hover{
            background-color:transparent;
            font-size:1em;
            font-weight:700;

            color:white;
        }
    </style>
</head>
<!-- Navbar -->
<nav id="nav_body" class="d-flex flex-row navbar navbar-expand-xxl navbar-light" style="width:95%; position:absolute;">
    <div class="container-fluid col-12 col-xxl-11 me-0 ms-0">
        <!-- Flutters Brand -->
        <a class="navbar-brand" href="/"><img class="nav_logo ms-4" style="width:7em;" src="/pages/nav/img/header-logo.svg"></a>

        <!-- Burger Menu Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#flutters_navbar" aria-controls="flutters_navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- main -->
        <div class="collapse navbar-collapse" id="flutters_navbar">
            <!-- left side list -->
            <ul class="navbar-nav me-auto ms-4 mb-2 mb-xxl-0 mt-2" id="navbar_link">
                <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Films</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Événements</a></li>
                <li class="nav-item"><a class="nav-link" href="/">À propos</a></li>
            </ul>
        </div>
    </div>
</div> 
</nav>