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
    .client__title{
        margin: 20px 0;
        text-align: center;
    }
    .client__containerForm{
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .client__containerForm--formulaire{

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
        .client__containerForm--formulaire{
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

</style>

<body>

    <h1 class="title client__title">Client</h1>

    <div class="client__containerForm">
        <div class="client__containerForm--formulaire">
            <form action=" " method="POST">

                <label for="sty">Société :</label>
                <input id="sty" type="text" name="society" required><br>

                <label for="amail">Adresse-mail:</label>
                <input id="amail"type="text" name="email" required><br>

            </form>
            <button class="bouton buttonNext">Étape suivante</button>
        </div>
        
    </div>
</body>

</html>