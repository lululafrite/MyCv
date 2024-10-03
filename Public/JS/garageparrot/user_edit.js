//Permet de remplir les input avec une valeur quelquonque. Utile si l'on a cliqué sur le bouton nouveau et que l'on veut annuler. 

    function retour() {        
        setInputValue('txt_userEdit_name', '_');
        setInputValue('txt_userEdit_surname', '_');
        setInputValue('txt_userEdit_pseudo', '_');
        setInputValue('txt_userEdit_email', 'user@gmail.com');
        setInputValue('txt_userEdit_phone', '00 00 00 00 00');
        setInputValue('list_userEdit_type', 'User');
        setInputValue('txt_userEdit_password', 'Abc123/*-');
        setInputValue('txt_userEdit_confirm', 'Abc123/*-');

        return;
    }
    function setInputValue(inputId, value) {
        const monInput = document.getElementById(inputId);
        if (monInput) {
            monInput.value = value;
        }
    }

    //Initialise les couleurs input list
    document.addEventListener('DOMContentLoaded', function() {
        var myInput = document.getElementById('list_userEdit_type');
        myInput.style.backgroundColor = '#DADADA';
    });

    //vérifier si la valeur saisie existe dans la liste de choix
    function validateInput(input , datalist, myLabel, myMessage){
        
        var myInput = document.getElementById(input);
        var errorMessage = document.getElementById(myLabel);
        var isError = false;
        
        if(datalist!=''){
            
            var myDatalist = document.getElementById(datalist);

            var isValid = Array.from(myDatalist.options).some(function(option) {
                return option.value === myInput.value;
            });

            if(!isValid){isError = true;}

        }else if(myInput.value.trim() === ''){
            
            isError = true;

        }else if(input === 'txt_userEdit_password'){

            var passwordInput = document.getElementById(input).value;

            // Vérifier que la longueur est de 8 caractères
            if (passwordInput.length < 8) {
                //alert("Le mot de passe doit contenir au moins 8 caractères dont au moins 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial parmi les suivants (_-/*-@!)");
                isError=true;
            }else{
                isError=false;
            }

            //Vérifier au moins une majuscule, une minuscule, un chiffre, et un caractère spécial
            var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[_\-/*-@!])[\w\-/*-@!]{8,255}$/;
            
            if (!regex.test(passwordInput)) {
                //alert("Le mot de passe doit contenir au moins 8 caractères dont au moins 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial parmi les suivants (_-/*-@!)");
                isError=true;
            }
            
        }else if(input === 'txt_userEdit_confirm'){

            var password = document.getElementById('txt_userEdit_password').value;
            var passwordConfirm = document.getElementById(input).value;

            if(passwordConfirm === password){
                isError=false;
                console.log(isError);
            }
            else{
                isError=true;
                console.log(isError);
            }
        }

        if(isError){

            errorMessage.textContent = myMessage;
            errorMessage.style.color = 'red';
            myInput.style.background = '#FFB4B4';
            return false;

        }else{

            errorMessage.textContent = myMessage;
            errorMessage.style.color = '#000000';
            
            if(datalist!=''){
                myInput.style.background = '#DADADA';
            }else{
                myInput.style.background = '#ffffff';
            }

            return true;
        }
    }

    /*********************************************************************************************
    ****** Annuler la soumission du formulaire si une erreur subsiste dans l'un des champs *******
    *********************************************************************************************/

    document.getElementById('formUserEdit').addEventListener('submit', function (event) {

        var MessageName = "Saisissez le Nom (50 caractères maximum).";
        var MessageSurname = "Saisissez le Prénom (50 caractères maximum).";
        var MessagePseudo = "Saisissez le pseudonyme (20 caractères maximum).";
        var MessageEmail = "Saisissez l'adresse email (255 caractères maximum).";
        var MessagePhone = "Saisissez le N° de téléphone.";
        var MessageType = "Selectionnez le type d'utilisateur dans la liste de choix.";
        var MessagePassword = "Saisissez un mot de passe de 255 caractères maximum et 8 caractères minimun comprenant au moins : 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spéciale parmi les suivants /*-.!?@";
        
        var isError = false;
        
        if (!validateInput('txt_userEdit_name', '', 'labelMessageName', MessageName)){
            isError = true;
        }
        
        if (!validateInput('txt_userEdit_surname', '', 'labelMessageSurname', MessageSurname)){
            isError = true;
        }

        if (!validateInput('txt_userEdit_pseudo', '', 'labelMessagePseudo', MessagePseudo)) {
            isError = true;
        }

        if (!validateInput('txt_userEdit_email', '', 'labelMessageEmail', MessageEmail)) {
            isError = true;
        }

        if (!validateInput('txt_userEdit_phone', '', 'labelMessagePhone', MessagePhone)) {
            isError = true;
        }

        if (!validateInput('list_userEdit_type', 'datalist_userEdit_type', 'labelMessageType', MessageType)) {
            isError = true;
        }

        if (!validateInput('txt_userEdit_password', '', 'labelMessagePassword', MessagePassword)) {
            isError = true;
        }

        if (!validateInput('txt_userEdit_confirm', '', 'labelMessageConfirm', MessagePassword)) {
            isError = true;
        }

        var messageAlerte = 'Vous avez un ou plusieurs champs dont la valeur n\'est pas conforme. Veuillez vérifier et corriger le ou les champs concernés';
        
        if (isError === true){
            event.preventDefault();
            alert (messageAlerte)
            isError = false;
        }
    });