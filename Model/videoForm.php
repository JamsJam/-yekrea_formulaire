<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
    <body>
        <form action="">

            <!-- <div class="service__formVideo--visualiser"> -->
                <div class="service__formVideo--container">
                    <div class="service__formVideo--etape1">

                        <fieldset>
                            <legend>Quel type de vidéo souhaiteriez-vous ?</legend>
                            <div class="service__formVideo--fieldsetContainer">

                                <div>
                                    <input type="checkbox" id="pub" name="videoForm" value="1">
                                    <label for="pub">Spot publicitaire (Vidéo commercial avec scenario)</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="videoAnim" name="videoForm" value="videoAnimation">
                                    <label for="Video">Vidéo animation(Textes et Photos)</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="videoTxT" name="videoForm" value="animationTxt">
                                    <label for="videoTxT">Vidéo explicative animation (personnage animés + textes)</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="videoVx" name="videoForm" value="animationVx">
                                    <label for="videoVx">Vidéo explicative animation (personnage animés + Voix off)</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="demonstration" name="videoForm" value="demonstration">
                                    <label for="demonstration">Vidéo démonstration produit(Presenter les options et avantages du produit)</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="reportageCorp" name="videoForm" value="reportageCorp">
                                    <label for="reportage">Vidéo reportage d'entreprise (mettre en avant l'ethique de votre entreprise, les valeurs)</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="reportage" name="videoForm" value="reportage">
                                    <label for="reportage">Vidéo reportage</label>
                                </div>
                                
                                <div>
                                    <input type="checkbox" id="tutorial" name="videoForm" value="tutorial">
                                    <label for="tutorial">Vidéo tutorielle</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="service__formVideo--etape2">
                        
                        <div>
                            <fieldset id="service__formVideo--time">
                                <legend >Elle doit durer combien de temps ?</legend>
                                
                                <div>
                                    <input type="radio" name="videoForm-time" id="t-30">
                                    <label for="t-30">30 secondes</label>
                                </div>
                                
                                <div>
                                    <input type="radio" name="videoForm-time" id="t-60">
                                    <label for="t-60">1 minutes</label>
                                </div>
                                
                                <div>
                                    <input type="radio" name="videoForm-time" id="t-120">
                                    <label for="t-120">2 mminutes</label>
                                </div>
                                
                                <div>
                                    <input type="radio" name="videoForm-time" id="t-plus">
                                    <label for="t-plus">plus de 2 minutes</label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="service__formVideo--formFlex2">
                            <label for="formVideo-date">C'est prévu pour quelle(s) jour(s) ?</label>
                            <input type="date" name="" id="formVideo-date">
                        </div>
                        
                        <div class="service__formVideo--formFlex2">
                            <label for="">Si plus d'une journée précisez</label>
                            <input type="text" name="" id="">
                        </div>
                        
                        <div class="service__formVideo--formFlex2">
                            <label for="">Pour quelle occasion ?</label>
                            <input type="text" name="" id="">
                        </div>
                        
                        <div>
                            
                            <fieldset>

                                <legend>Un(e) MakeUp Artist pour vous sublimer ?</legend>

                                <div>
                                    <input type="radio" name="videoForm-makeUp" id="radio-oui">
                                    <label for="radio-oui">oui</label>
                                </div>

                                <div>
                                    <input type="radio" name="videoForm-makeUp" id="radio-non">
                                    <label for="radio-non">non</label>
                                </div>

                            </fieldset>
                        </div>
                    </div>
                    <div>

                        
                        </div>

                    </div>
                </div>
            <!-- </div> -->

        </form>


    </body>
</html>