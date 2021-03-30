$(document).ready(function() {

console.log('Document get ready passt!');

$('#registry').submit(function(event) {
    event.preventDefault(); //wird keine neue Seite aufgerufen

    $.ajax({  //Formulardaten schicken
            type : 'post',
            data : $(this).serialize(),
            url : 'add_user.php',
            success : function(phpArray) {
                console.log(JSON.parse(phpArray)); //Array aus string ->add_user

                phpArray = JSON.parse(phpArray);  //gespeichert in Variable

                if(confirm(phpArray['msg'])) //wenn geändert, wird es gleich neu geladen
                location.reload();
            },
            error : function(errmsg) {
                console.log(errmsg);
            }
    });








})