$(document).ready(function () {

            console.log('ich bin korrekt');

            //Blogeintrag löschen:
            $('.delete').click(function() {

        
                console.log('Eintrag löschen');
        
                let entry = $(this).parent();
                //let self = $(this); wird später ev nochmals gebraucht, daher in Variable speichern
                let noteId = $(this).parent().attr('data-id');  
                //.parent: eine Ebene hinaufnavigieren ->im HTML schauen (div ist eine Ebene)
                let myData = {'noteId' : noteId}; 
                // wir bauen ein Objekt um mit Ajax weg zu schicken //$_POST['note_Id']
        
                console.log(noteId);
        
                $.ajax({
                    type : 'post',  //man schickt über ajax mit post ab
                    data : myData,
                    url : 'delete_notes.php',
                    success : function(phpData) {  //Parameter der mitgegeben wird
                        console.log(phpData);
                        if(phpData.trim() == 'true')
                        entry.remove();
        
                    },
                    error : function(errorMsg) {
                        console.log(errorMsg);  //error .. Msg ist frei wählbar
                    }
        
                });
        
            });
        
            $('#addForm').submit(function(event) {  //wenn das Formular abgeschickt wird
                event.preventDefault(); //reload wird verhindert -> event.
        
                console.log('Eintrag wegschicken');
        
                let formData = $(this).serialize();  //alle Einträge aus dem Formular holen
        
                addEntry(formData);
                
            });
            //wir nehmen den Blogpost und verändern diesen -bearbeiten-
            $('.edit').click(function(){
        
                //Eintrag der gerade bearbeitet wird, wird gehighlitet
                if($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active');
                    $('#addForm textarea').val('');
                    $('#addForm input[name="noteId"]').val('');
                    $('#addForm input[type="submit"]').val('hinzufügen');
         
                }else {
                    $('.note').removeClass('active');    //nur ein Eintrag rot markiert
                    $(this).parent().addClass('active');  //active-Klasse wird gesetzt
         
                    let text = $(this).parent().find('.note_text').text();
                    console.log(text);
                    $('#addForm textarea').val(text);
         
                    let noteId = $(this).parent().attr('data-id');   //wir holen die id und speichern diese
                    $('#addForm input[name="noteId"]').val(noteId);  //er sprint dorthin wo noteId im index
         
                    $('#addForm input[type="submit"]').val('Nachricht updaten');
                }
                
        
            });


            function addEntry(formData) {
                $.ajax({
                    type: 'post',
                    data: formData,
                    url: 'add_notes.php',
                    success: function(phpData) {
                        console.log(phpData);
        
                        if(phpData.trim() == 'true') {
                            location.reload();  //die Seite wird automatisch reloaded ... 
                        }
                        },
                    error : function(errorMsg) {
                            console.log(errorMsg);  //error .. Msg ist frei wählbar
                        }
                    
                });
            }

            //Usermanagement
            $('#registry').submit(function (event) {
                event.preventDefault(); //wird keine neue Seite aufgerufen

                $.ajax({ //Formulardaten schicken
                    type: 'post',
                    data: $(this).serialize(),
                    url: 'add_user.php',
                    success: function (phpArray) {
                        console.log(JSON.parse(phpArray)); //Array aus string ->add_user

                        phpArray = JSON.parse(phpArray); //gespeichert in Variable

                        if (confirm(phpArray['msg'])) //wenn geändert, wird es gleich neu geladen
                            location.reload();
                    },
                    error: function (errmsg) {
                        console.log(errmsg);
                    }
                });

            });

            //add team
            $('#registry').submit(function (event) {
                event.preventDefault(); //wird keine neue Seite aufgerufen

                $.ajax({ //Formulardaten schicken
                    type: 'post',
                    data: $(this).serialize(),
                    url: 'add_team.php',
                    success: function (phpArray) {
                        console.log(JSON.parse(phpArray)); //Array aus string ->add_user

                        phpArray = JSON.parse(phpArray); //gespeichert in Variable

                        if (confirm(phpArray['msg'])) //wenn geändert, wird es gleich neu geladen
                            location.reload();
                    },
                    error: function (errmsg) {
                        console.log(errmsg);
                    }
                });
            });
                //Delete USER
                $('#delete_user').submit(function (e) {
                    e.preventDefault();

                    $.ajax({ //Daten schicken
                        type: 'post',
                        data: $(this).serialize(),
                        url: 'delete_user.php',
                        success: function (phpArray) {
                            console.log(JSON.parse(phpArray)); //Array aus string ->add_user

                            phpArray = JSON.parse(phpArray); //gespeichert in Variable

                            if (confirm(phpArray['msg']))
                                location.reload();
                        },
                        error: function (errmsg) {
                            console.log(errmsg);
                        }
                    });
                });

                //popup

                $('#change_user_icon').click(function () {
                    $('#pop_up').removeClass('active');
                });

                $('#close_pop_up').click(function () {
                    $('#pop_up').removeClass('active');
                });

                $('remind').click(function () {
                    let note_arr;
                    let note_id = $(this).parent().data('id'); // .attr('data-id);
                    console.log(note_id);

                    //wenn Notiz schon enthalten, dann ..... ansonsten tu es hinein:
                    if (localStorage.getItem('remindlist')) {
                        note_arr = JSON.parse(localStorage.getItem('remindlist')); //retourparsen von String to Array -> JSON.parse
                        let note_found = false;

                        for (let i = 0; i < note_arr.lenght; i++) {
                            if (note_id == note_arr[i]) {
                                note_found = true;
                                break;
                            }
                        }

                        if (!note_found) {
                            note_arr.push(note_id); //wenn nicht gefunden, dann push
                            localStorage.setItem('remindlist', JSON.stringify(note_arr)); //localStorage speichert in Strings, daher wieder in String umwandeln    
                            $(this).parent().find('.note_headline').append('<span class="remind_star">*</span>');

                        }

                    } else {
                        note_arr = [note_id];
                        localStorage.setItem('remindlist', JSON.stringify(note_arr)); //Array wird String -> JSON.parse JSON.stringify
                        $(this).parent().find('.note_headline').append('<span class="remind_star">*</span>');

                    }
                    //wenn man klickt
                    $('#reminder_ankor').attr('href', 'remind.php?remindlist=' + JSON.stringify(note_arr));
                    //find - man kann nach unten in der Hierarchie ->child ...
                });

                $('#reminder_ankor').attr('href', 'remind.php?remindlist=' + localStorage.getItem('remindlist'));

                if ($('#notes').length) { //wenn Notizen gemerkt sind, dann bekommen sie Stern
                    let remindlist = JSON.parse(localStorage.getItem('remindlist'));

                    for (let j = 0; j < remindlist.lenght; j++) {

                        $('[data-id="' + remindlist[j] + '"]').find('.note_headline').append('<span class="remind_star">*</span>');
                    }
                }

            
        });