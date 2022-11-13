$(function(){

    var activeNote = 0;
    var editMode = false;

    $.ajax({
        url: "loadNotes.php",
        success: function(data){
            $("#notes").html(data);
            clickOnNote();
            clickonDel();
        },
        error:function(){
            $("#alertContent").text("There was an error ajaxing");
                $("#alert").fadeIn();
        }
    })


    $('#addNote').click(function(){
        $.ajax({
            url: "createNotes.php",
            success: function(data){
              console.log(data);
              if(/^-?\d+$/.test(data) === false){
                $("#alertContent").text("There was an error inserting");
                $("#alert").fadeIn();
              }else{
                activeNote = data;
                $("textarea").val("");
                showHide(["#notePad","#allNote"],["#addNote","#editNote","#doneNote","#notes"]);
                $("textarea").focus();
              }
            },
            error:function(){
                $("#alertContent").text("There was an error ajaxing");
                $("#alert").fadeIn();
            }
        });
    });

    $("textarea").keyup(function(){
        console.log("key up");
        $.ajax({
            url: "updatenotes.php",
            type: "POST",
            data: {note: $(this).val(), id:activeNote },
            success: function(datareturned){
                console.log(datareturned);
                if(datareturned=='error'){
                    $("#alertContent").text("There was an error updating");
                    $("#alert").fadeIn(); 
                }
            },
            error:function(){
                $("#alertContent").text("There was an error ajaxing");
                    $("#alert").fadeIn();
            }
        })
    });


    $('#allNote').click(function(){
        $.ajax({
            url: "loadNotes.php",
            success: function(data){
                $("#notes").html(data);
                showHide(["#addNote","#editNote","#notes"],["#notePad","#allNote"])
                clickOnNote();
                clickonDel();
            },
            error:function(){
                $("#alertContent").text("There was an error ajaxing");
                    $("#alert").fadeIn();
            }
        })
    });

    $('#editNote').click(function(){
        editMode = true;
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        showHide(["#doneNote",".delete"],[this]);
    })

    $('#doneNote').click(function(){
        editMode = false;
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
        showHide(["#editNote"],[this,".delete"]);
    })




    function clickOnNote(){
        $(".noteheader").click(function(){
            if(!editMode){
                activeNote = $(this).attr("id");
                console.log(activeNote);
                $("textarea").val($(this).find(".text").text());
                showHide(["#notePad","#allNote"],["#addNote","#editNote","#doneNote","#notes"]);
                $("textarea").focus();
            }
        })
    }


    function clickonDel(){
        $(".delete").click(function(){
            var deleteButton = $(this);
            $.ajax({
                url: "deleteNotes.php",
                type: "POST",
                data: {id: deleteButton.next().attr("id")},
                success: function(datareturned){
                    console.log(datareturned);
                    if(datareturned=='error'){
                        $("#alertContent").text("There was an error updating");
                        $("#alert").fadeIn(); 
                    }else{
                        deleteButton.parent().remove();
                    }
                },
                error:function(){
                    $("#alertContent").text("There was an error ajaxing");
                        $("#alert").fadeIn();
                }
            })
        })
    }
    

   function showHide(array1, array2){
    for(i=0;i<array1.length;i++){
        $(array1[i]).show();
    }
    for(i=0;i<array2.length;i++){
        $(array2[i]).hide();
    }
   }

    
});