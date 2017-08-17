$(function() {
    var options = {"width": $(window).width()*.8, "modal": true}
   $(".new-question > button").click(function() {
       console.log("a");
     $("#new-question-dialog").dialog(options);  
   });
   
    $(".answer-question > button").click(function() {
        $("#answer-question-dialog").dialog(options);
    });
    
    $("#new-question-dialog form, #answer-question-dialog form").submit(function(e) {
        return true;
        e.preventDefault();
        $.post("/api.php", $(this).serialize()).done(function() {
            alert("DONE!!!");
        }).fail(function() {
            alert("FAIL!");
        })
        return false;
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