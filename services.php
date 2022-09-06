<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        
    }
    .services__title{
        margin: 20px 0;
        text-align: center;
    }
    .services__containerForm{
        display: flex;
        justify-content: center;
        align-items: center;

    }
    fieldset{
        border: none;
    }
    .services__containerForm--formulaire{

        width: 800px;
        margin: 30px 0;

        line-height: 50px;
        }
    .bouton{
        padding: 10px;

        border: 1px solid #E30414;
        border-radius: 20px;

        background-color: #E30414;
        box-shadow: 2px 2px 5px grey;
        
        color: white;
        font-weight: bold;
    
        cursor: pointer;
    }

    #btn{
        display: flex;

        justify-content: space-between;
        margin: 20px 50px;
    }
    @media screen and (max-width: 800px){
        .services__containerForm--formulaire{
            display: flex;
            flex-direction: column;
            
            line-height: 40px;
            margin: 20px 0;
            width: 340px;
        }
        #btn{
            margin: 20px auto;
            
            width: 340px;

            justify-content: space-around;
            
        }
    }
    @media screen and (max-width: 900px){
        .services__containerForm--formulaire{
            padding-left: 50px;
        }
    }
</style>
<body>
    <h1 class="title services__title">Quels services souhaitez-vous?</h1>

    <div class="services__containerForm">
        <div class="services__containerForm--formulaire">
            <form action=" " method="POST">
                <fieldset>
                    <input id="cmgt" type="checkbox" name="cm" required>
                    <label for="cmgt">CM - Community Management</label><br>

                    <input id="content" type="checkbox" name="contenu" required>
                    <label for="content">CM/Contenu - Community Management et Création de contenu (Photo/Vidéo/Reel/Visuel)</label><br>

                    <input id="photo" type="checkbox" name="pic" required>
                    <label for="photo">PH - Photographie</label><br>

                    <input id="ifgp" type="checkbox" name="pr" required>
                    <label for="ifgp">PR - Infographie</label><br>

                    <input id="crea" type="checkbox" name="web" required>
                    <label for="crea">WE - Création Site Web</label><br>
                </fieldset>

            </form>
            <div id="btn">
                <button class="bouton buttonPrev">Page précédente</button>
                <button class="bouton buttonNext">Étape suivante</button>
            </div>
        </div> 
    </div>
</body>
</html>