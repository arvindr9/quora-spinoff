$(function() {
    var options = {"width": $(window).width()*.8, "height": $(window).height()*.8, "modal": true}
   $(".new-question > button, button.askButton").click(function() {
     $("#new-question-dialog").dialog(options);  
   });
   
    $(".answer-question > button, button.writeButton").click(function() {
        $("#answer-question-dialog").dialog(options);
    });
    
    /*$("#new-question-dialog form, #answer-question-dialog form").submit(function(e) {
        return true;
        e.preventDefault();
        $.post("/api.php", $(this).serialize()).done(function() {
            alert("DONE!!!");
        }).fail(function() {
            alert("FAIL!");
        });
        return false;
    });*/
    
    $("#answer-question-dialog form").submit(function(e) {
       $(this).find("input[name=content]").val($(this).find("#answerContent").html());
       return true;
    });
    
    
    var $loading = $('#loadingDiv').hide();
    $(document)
      .ajaxStart(function () {
        $loading.show();
      })
      .ajaxStop(function () {
        $loading.hide();
      });
})