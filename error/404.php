<head>
    <title>Error 404</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<main>
    <div class="items">
        <div class="item">
            <img src="https://flutters.ovh/error/Error404.png" alt="">
        </div>        
        <div class="link-div">
            <button class="btn btn-danger" onclick="location.href='https://flutters.ovh'">Retourner à l'accueil</button>
            
        </div>
    </div>
    
</main>


<style>
    body {
        padding: 0;
        margin: 0;
        border: none;
    }


    .item {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    img {
        width:30%;
    }

 
    .items {
        display:flex;
        flex-direction: column;
    }

    a {
        display:flex;
        justify-content: center;
        text-decoration: none;
        color: black;
        
    }


    .link-div {
        display: flex;
        justify-content: center;
    }
    
    .link {
        background-color: red;
        padding: 1em;
    }
</style>
    