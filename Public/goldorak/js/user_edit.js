/*********************************************************************************** */
// Function of sending data to the server with Fetch
/*********************************************************************************** */

function sendDataOfUserEdit(button){

    let formData = new FormData();

    formData.append(button, document.querySelector('input[name="' + button + '"]').value);

    formData.append('csrfUSer', document.querySelector('input[name="csrfUSer"]').value);

    formData.append('txt_userEdit_id', document.querySelector('input[name="txt_userEdit_id"]').value);
    formData.append('txt_userEdit_name', document.querySelector('input[name="txt_userEdit_name"]').value);
    formData.append('txt_userEdit_surname', document.querySelector('input[name="txt_userEdit_surname"]').value);
    formData.append('txt_userEdit_pseudo', document.querySelector('input[name="txt_userEdit_pseudo"]').value);
    formData.append('txt_userEdit_email', document.querySelector('input[name="txt_userEdit_email"]').value);
    formData.append('txt_userEdit_phone', document.querySelector('input[name="txt_userEdit_phone"]').value);
    formData.append('list_userEdit_type', document.querySelector('input[name="list_userEdit_type"]').value);
    formData.append('txt_userEdit_avatar', document.querySelector('input[name="txt_userEdit_avatar"]').value);
    formData.append('list_userEdit_subscription', document.querySelector('input[name="list_userEdit_subscription"]').value);
    formData.append('txt_userEdit_password', document.querySelector('input[name="txt_userEdit_password"]').value);

    // Envoyer les données au serveur
    if (button ==='bt_userEdit_save' || button ==='bt_userEdit_new'){

        sendDataToServer('index.php?page=userEdit', formData) // Function in file fetch.js
        .then(response => {

            if (button ==='bt_userEdit_save'){

                const messageAlerte = 'Enregistrement effectué avec succès!';

                document.getElementById('message1').innerText = messageAlerte;
                document.getElementById('message2').innerText = messageAlerte;

            }else if(button ==='bt_userEdit_new'){

                document.getElementById('txt_userEdit_id').value = '';
                document.getElementById('list_userEdit_subscription').value = 'Vénusia';
                document.getElementById('txt_userEdit_name').value = '';
                document.getElementById('txt_userEdit_surname').value = '';
                document.getElementById('txt_userEdit_pseudo').value = '';
                document.getElementById('txt_userEdit_email').value = '';
                document.getElementById('txt_userEdit_phone').value = '';
                document.getElementById('list_userEdit_type').value = 'Member';
                document.getElementById('txt_userEdit_avatar').value = 'avatar_membre_white.webp';
                document.getElementById('txt_userEdit_password').value = '';
                document.getElementById('txt_userEdit_confirm').value = '';

                document.getElementById('message1').innerText = '';
                document.getElementById('message2').innerText = '';
        
            }
            
        })
        .catch(error => {

            const messageAlerte1 = 'Une erreur s\'est produite lors de l\'enregistrement.';

            document.getElementById('message1').innerText = messageAlerte1;
            document.getElementById('message2').innerText = messageAlerte1;

            console.error('Erreur :', error);

        });

    }else if (button ==='bt_userEdit_delete'){

        sendDataToServer('index.php?page=userEdit', formData) // Function in file fetch.js
        .then(response => {

            var sessionLocal = document.getElementById('sessionValue').getAttribute('data-local');

            if(sessionLocal === "1"){

                window.location.href = "http://goldorak/index.php?page=user";

            }else{

                window.location.href = "https://www.follaco.fr/goldorak/public/index.php?page=user";

            }
            
        })
        .catch(error => {

            const messageAlerte1 = 'Une erreur s\'est produite lors de l\'enregistrement.';

            document.getElementById('message1').innerText = messageAlerte1;
            document.getElementById('message2').innerText = messageAlerte1;

            console.error('Erreur :', error);

        });
    }

}

/**************************************************************************** */
// initalized zone message (save and content error)
/**************************************************************************** */

initMessageSave('txt_userEdit_id');
initMessageSave('txt_userEdit_name');
initMessageSave('txt_userEdit_surname');
initMessageSave('txt_userEdit_pseudo');
initMessageSave('txt_userEdit_email');
initMessageSave('txt_userEdit_phone');
initMessageSave('list_userEdit_type');
initMessageSave('txt_userEdit_avatar');
initMessageSave('list_userEdit_subscription');
initMessageSave('txt_userEdit_password');
initMessageSave('txt_userEdit_confirm');

function initMessageSave(input){
    
    let inputElement = document.getElementById(input);

    if(inputElement){

            inputElement.addEventListener('input', function() {
        
            document.getElementById('message1').innerText = '';
            document.getElementById('message2').innerText = '';
        
        });
    }

}

/**************************************************************************** */
// Event if button save of form is clicked
/**************************************************************************** */

document.getElementById('bt_userEdit_save').addEventListener('click', function (event) {
    event.preventDefault();
    dataSaveFormUserEdit();
});

document.getElementById('bt_userEdit_save_1').addEventListener('click', function (event) {
    event.preventDefault();
    dataSaveFormUserEdit();
});

let button_Nav_new_user = document.getElementById('nav_new_user');
if(button_Nav_new_user){

    button_Nav_new_user.addEventListener('click', function (event) {
        
        var sessionLocal = document.getElementById('sessionValue').getAttribute('data-local');

        if(sessionLocal === "1"){

            window.location.href = "http://goldorak/index.php?page=userEdit";

        }else{

            window.location.href = "https://www.follaco.fr/goldorak/public/index.php?page=userEdit";

        }
        console.log('bouton : nav_new_user')
        event.preventDefault();
        sendDataOfUserEdit('bt_userEdit_new');
    });

}

let button_bt_userEdit_new = document.getElementById('bt_userEdit_new');
if(button_bt_userEdit_new){

    button_bt_userEdit_new.addEventListener('click', function (event){

        event.preventDefault();
        sendDataOfUserEdit('bt_userEdit_new');

    });

}

let button_bt_userEdit_new_1 = document.getElementById('bt_userEdit_new_1');
if(button_bt_userEdit_new_1){

    button_bt_userEdit_new_1.addEventListener('click', function (event){

        event.preventDefault();
        sendDataOfUserEdit('bt_userEdit_new');

    });

}

function dataSaveFormUserEdit(){

    let isError = false;

    if (!validateInput('txt_userEdit_name')) {
        isError = true;
    }
    if (!validateInput('txt_userEdit_surname')) {
        isError = true;
    }
    if (!validateInput('txt_userEdit_pseudo')) {
        isError = true;
    }
    if (!validateInput('txt_userEdit_email')) {
        isError = true;
    }
    if (!validateInput('txt_userEdit_phone')) {
        isError = true;
    }
    if (!validateInput('list_userEdit_type')) {
        isError = true;
    }
    if (!validateInput('txt_userEdit_avatar')) {
        isError = true;
    }
    if (!validateInput('list_userEdit_subscription')) {
        isError = true;
    }
    if (!validateInput('txt_userEdit_password')) {
        isError = true;
    }
    if (!verifPassword('txt_userEdit_password')){
        isError = true;
    }
    if (!compareValueInput('txt_userEdit_password', 'txt_userEdit_confirm')){
        isError = true;
    }

    const messageAlerte = 'Vous avez un ou plusieurs champs dont la valeur n\'est pas conforme. Veuillez Corriger le ou les champs concernés marqués d\'un fond rose.';
    
    if (isError === true){
        
        document.getElementById('message1').innerText = messageAlerte;
        document.getElementById('message2').innerText = messageAlerte;

        isError = false;

    }else{

        sendDataOfUserEdit('bt_userEdit_save');

    }

}

//Permet de remplir les input avec une valeur quelquonque. Utile si l'on a cliqué sur le bouton nouveau et que l'on veut annuler. 

function retour() {

    setInputValue('txt_userEdit_id', '1');
    setInputValue('list_userEdit_subscription', 'Vénusia');
    setInputValue('txt_userEdit_name', '_');
    setInputValue('txt_userEdit_surname', '_');
    setInputValue('txt_userEdit_pseudo', '_');
    setInputValue('txt_userEdit_email', '_@gmail.com');
    setInputValue('txt_userEdit_phone', '## ## ## ## ##');
    setInputValue('txt_userEdit_avatar', 'avatar_membre_white.webp');
    setInputValue('list_userEdit_type', 'Member');
    setInputValue('txt_userEdit_password', 'Abc123/*-');
    setInputValue('txt_userEdit_confirm', 'Abc123/*-');

    return;
}

//Initialise les couleurs input list

colorBgList('list_userEdit_subscription','#DADADA');
colorBgList('list_userEdit_type','#DADADA');

function colorBgList(input, color){

    //document.addEventListener('DOMContentLoaded', function() {

        let myInput = document.getElementById(input);
        if(myInput){
            myInput.style.backgroundColor = color;
        }

    //});

}