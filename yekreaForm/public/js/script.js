function fixe_roleAdmin() {
    //quand je click sur la checkbox admin.......
    // variable representant les checkbox des different role
    let roleUser        = document.querySelector("#user_roles_0")
    let roleCommercial  = document.querySelector("#user_roles_1")
    let roleAdmin       = document.querySelector("#user_roles_2")
    // si la checkbox admin n'est pas cochée
    if (roleAdmin.checked) {
        //je verifie si   n'est pas coché
        if(!roleCommercial.checked){
            //je le coche
            roleCommercial.click()
        }
        //je verifie si user  n'est pas coché
        if(!roleUser.checked){
            //je le coche
            roleUser.click()
        }
        //je desactive user et Commercial
        roleCommercial.setAttribute('disabled','true')
        roleUser.setAttribute('disabled','true')
    } else {
        //je reactive  Commercial
        roleCommercial.removeAttribute('disabled')
    }
}


function fixe_roleCommercial() {
    //quand je click sur la checkbox commercial
    // variable representant les checkbox des different role
    let roleUser        = document.querySelector("#user_roles_0")
    let roleCommercial  = document.querySelector("#user_roles_1")
    // si commercial n'est pas cochée
    if (roleCommercial.checked) {
        //je verifie si  user  n'est pas coché
        if(!roleUser.checked){

            //je coche
            roleUser.click()
        }
        //je desactive user
        roleUser.setAttribute('disabled','true')
    } else {
        //je reactive user
        roleUser.removeAttribute('disabled')
    }
}
    

//  *************** Client new/ edit

// Recupere les differentes valeur du champs Reseau sociaux
function choiceReseaux(){
    checkbox.forEach(box => {
                    
        let inputText = box.nextElementSibling
        // si le la checkbox est coché ,
        if(box.checked)
        {
            inputText.removeAttribute('disabled')
            inputText.removeAttribute('style')
            
            // je mets un evenement sur l'element suivent (input:text)
            inputText.addEventListener('input',()=>{
                textReseau = []
                // pour chaque checkbox,
                checkbox.forEach(element => {
                    arrayBox = []
                    //si la box est check
                    if(element.checked){
                        //je recupere l'id de la checkbox
                        let id = element.getAttribute('id')
                        //je recupere la valeur de l'input:text
                        let values = element.nextElementSibling.value
                        // Condition sur la valeur de l'input pour recuperer, au cas ou, un input vide
                        if(values){
                    
                            arrayBox = [id +':'+ values]
                            textReseau.push(arrayBox)
                            console.log(textReseau)
                        
                        }
                    }
                    // remplissage de l'input qui sera envoyer en bdd par l'ensemble des valeur des input donc la checkbox est coché
                    document.querySelector('#client_Reseaux').value = textReseau.join(' ,')
                });
            })
        }
    })
    console.log(textReseau.join(' ,'))
}

// Fonction qui recupere Tout les user avec le role client via une requette api
// Suprime toute les options du selecte et enfin repeuple le select avec les option correspondant a la recherche effectuer
async function fetchClient(){
    const response = await fetch("http://localhost:8000/client/api/fetch/client",{method: 'GET'})
    if (!response.ok) 
    {
        const message = `Il y a eu une erreur: ${response.status}`;
        console.log(message);
    }
    else
    {
        allClient =  await response.json();
        options.forEach(option => {
            console.log(option)
            option.remove()
        })
        allClient.forEach(option => {
            optionArray = []
            // indexOf() retourne l'index dans une chaine de caractere de l'element donné en argument. 
            // Si l'element est absent de la chaine de caractère, indexOf() retourne -1
            if (option['nom'].toLowerCase().indexOf(searchValue.toLowerCase()) != -1){
                // console.log('true')
                let optionValue = option['id']
                let optionHTML = option['nom']
                optionArray = [optionValue, optionHTML]
                resultArray.push(optionArray)
                
            }
        });
    };
    if (resultArray.length > 0) {
        resultArray.forEach(element => {
            let newOption = document.createElement('option')
            newOption.setAttribute('value', element[0])
            newOption.textContent = element[1]
            userForm.appendChild(newOption)
        });
    } else {
        let newOption = document.createElement('option')
            newOption.textContent = 'Aucun resultat'
            userForm.appendChild(newOption)
    }
}



