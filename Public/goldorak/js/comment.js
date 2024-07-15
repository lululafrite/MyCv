/**************************************************************************** */
// Event if button save of form is clicked
/**************************************************************************** */

document.addEventListener('DOMContentLoaded', function() {

    const commentActions = document.querySelectorAll('.comment-action');

    commentActions.forEach(function(actionButton){

        actionButton.addEventListener('click', function(event) {

            const id = this.getAttribute('data-comment-id');
            const btn = this.getAttribute('data-action');
            
            console.log('function id + action : ');
            console.log(btn);

            sendDataOfComment(btn,id);

        });
    });
});

/*********************************************************************************** */
// Function of sending data to the server with Fetch
/*********************************************************************************** */

function sendDataOfComment(button, id = ''){

    let formData = new FormData();

    formData.append(button, button);
    formData.append('csrfComment', document.querySelector('input[name="csrfComment"]').value);
    formData.append('txt_comment_id', id);

    if(button === 'bt_save_comment'){
        
        formData.append('txt_comment_pseudo', document.querySelector('input[name="txt_comment_pseudo"]').value);
        formData.append('selectedRating', document.querySelector('input[name="selectedRating"]').value);
        formData.append('txt_comment_comment', document.querySelector('textarea[name="txt_comment_comment"]').value);

    }

    if(button === 'bt_save_comment' && validateInput('txt_comment_comment')){

        sendDataToServer('', formData)
        .then(response => {

            document.getElementById('txt_comment_comment').value = '';
            alert("Le message a été transmi au modérateur pour validation avant publication.");

        })
        .catch(error => {
    
            if(button === 'bt_save_comment'){
    
                document.getElementById('txt_comment_comment').value = '';
                alert("Il c'est produit une erreur, le message n'a pas été transmis.");
    
            }
    
            console.error('Erreur :', error);
    
        });

    }else if(button === 'bt_comment_validate'){
        
        sendDataToServer('', formData)
        .then(response => {

            if(document.getElementById('stateComment_' + id).value != 'Etat : Supprimé'){

                document.getElementById('stateComment_' + id).value = 'Etat : Validé';

                let element = document.getElementById('stateComment_' + id);
                element.classList.remove('bg-info','bg-success','bg-danger','bg-warning');
                element.classList.add('bg-success');
            }

        })
        .catch(error => {
    
            console.error('Erreur :', error);
    
        });

    }else if(button === 'bt_comment_refuse'){
        
        sendDataToServer('', formData)
        .then(response => {

            if(document.getElementById('stateComment_' + id).value != 'Etat : Supprimé'){
                
                document.getElementById('stateComment_' + id).value = 'Etat : Refusé';

                let element = document.getElementById('stateComment_' + id);
                element.classList.remove('bg-info','bg-success','bg-danger','bg-warning');
                element.classList.add('bg-warning');
            }

        })
        .catch(error => {
    
            console.error('Erreur :', error);
    
        });
        
    }else if(button === 'bt_comment_delete'){

        sendDataToServer('', formData)
        .then(response => {

            document.getElementById('stateComment_' + id).value = 'Etat : Supprimé';

            let element = document.getElementById('stateComment_' + id);
            element.classList.remove('bg-info','bg-success','bg-danger','bg-warning');
            element.classList.add('bg-danger');

            let valeurSession = document.getElementById('txt_local').value;

            if (valeurSession === "1"){

                window.location.href = "http://goldorak/index.php?page=home";

            }else{

                window.location.href = "https://www.follaco.fr/goldorak/public/index.php?page=home";

            }
            return;

        })
        .catch(error => {
    
            console.error('Erreur :', error);
    
        });

    }
}

/**************************************************************************** */
// checking input and Changing background if the content is empty
/**************************************************************************** */

function validateInput(input){

    const myInput = document.getElementById(input);

    let isError = false;
    
    if(verifInputEmpty(input)){

        isError = true;
        
    }

    if(isError){
        console.log('validateInput' + input + ' = false');
        myInput.style.background = '#FFB4B4';
        return false;

    }else{
        console.log('validateInput' + input + ' = true');
        myInput.style.background = '#ffffff';
        return true;
    }
}

function verifInputEmpty(input){
    
    const myInput = document.getElementById(input);
    
    if(myInput.value.trim() === ''){
        
        return true;

    }else{
        
        return false;

    }

}