tinymce.init({ selector:'textarea' });


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
    
});