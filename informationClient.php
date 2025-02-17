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
    .infoClient__title{
        margin: 20px 0;
        text-align: center;
    }
    .infoClient__containerForm{
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .infoClient__containerForm--formulaire{

        width: 800px;
        margin: 30px 0;
        
        text-align: end;

        line-height: 50px;
    }
    
    input[type=text]{

        padding: 5px;

        height: 25px;
        width: 35vw;
        min-width: 300px;

        background-color: #D9D9D9;
        box-shadow: 1px 1px 5px grey;

        border: 1px solid #D9D9D9;
        border-radius: 30px;

        margin-right: 86px;

    }
    .bouton{
        padding: 10px;

        border: 1px solid #E5191E;
        border-radius: 20px;

        background-color: #E5191E;
        box-shadow: 2px 2px 5px grey;
        
        color: white;
        font-weight: bold;
    
        cursor: pointer;
    }
    .buttonNext{
        margin: 30px 86px 0 0;
    }
    @media screen and (max-width: 800px){
        .infoClient__containerForm--formulaire{
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            line-height: 35px;
            margin: 20px 0;
            width: 340px;
        }
        input[type=text]{
            margin: auto;
            display: inline-block;
        }
        .bouton{
            margin: 20px auto;
        }
    }
    @media screen and (max-width: 900px){
        .infoClient__containerForm--formulaire{
            padding-right: 90px;
        }
    }
</style>

<body>

    <h1 class="title infoClient__title">Informations Client</h1>

    <div class="infoClient__containerForm">
        <div class="infoClient__containerForm--formulaire">
            <form action=" " method="POST">

                <label for="lastName">Nom :</label>
                <input id="lastName" type="text" name="nom" required><br>

                <label for="name">Prénom :</label>
                <input id="name"type="text" name="prenom" required><br>

                <label for="society">Société :</label>
                <input id="society"type="text" name="ste" required><br>

                <label for="cell">Numero de téléphone :</label>
                <input id="cell" type="text" name="tel" required><br>

                <label for="email">Adresse-mail:</label>
                <input id="email" type="text" name="mail" required><br>

                <label for="socialMedia">Site web ou Réseaux sociaux:</label>
                <input id="socialMedia" type="text" name="site" required>
            </form>
            <button class="bouton buttonNext">Étape suivante</button>
        </div>
        
    </div>
</body>

</html>