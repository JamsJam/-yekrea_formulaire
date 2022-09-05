<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Client</title>
</head>

<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        
    }
    .title{
        margin: 20px 0;
        text-align: center;
    }
    .containerForm{
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .formulaire{
        line-height: 50px;
        
        border: 1px solid red;
        align-items: center;
        
        
    }
    
    input[type=text]{
        
        padding: 5px;

        height: 25px;
        width: 200px;

        border: 1px solid #D9D9D9;
        background-color: #D9D9D9;
        border-radius: 30px;

        margin-right: 10px;
        
    }
    .bouton{
        padding: 10px;

        border: 1px solid #E30414;
        border-radius: 20px;

        background-color: #E30414;
        
        color: white;
        font-weight: bold;
    
        cursor: pointer;
    }

</style>

<body>

    <h1 class="title">Informations Client</h1>

    <div class="containerForm">
        <div class="formulaire">
            <form action=" " method="POST">

                <label for="lastName">Nom :</label>
                <input type="text" name="nom" required><br>

                <label for="Name">Prénom :</label>
                <input type="text" name="prenom" required><br>

                <label for="society">Société :</label>
                <input type="text" name="prix" required><br>

                <label for="tel">Numero de téléphone :</label>
                <input type="text" name="tel" required><br>

                <label for="email">Adresse-mail:</label>
                <input type="text" name="mail" required><br>

                <label for="socialMedia">Site web ou Réseaux sociaux:</label>
                <input type="text" name="site" required><br>
            </form>
            <button class="bouton buttonNext">Etape suivante</button>
        </div>
    </div>
</body>

</html>