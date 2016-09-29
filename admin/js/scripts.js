tinymce.init({ selector:'textarea' });
var div_box = "<div id='load-screen'><div id='loading'></div></div>";


// Checking in/out checkboxes on 'VIEW ALL POSTS' Page. 
$(document).ready(function(){

    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });
   
    $("body").prepend(div_box);
    
    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove();
    });
    
// End of document ready
});


function loadUsersOnline() {
    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });
}

setInterval(function(){
    loadUsersOnline();
},500);

