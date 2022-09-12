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
    

