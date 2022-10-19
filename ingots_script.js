$(document).ready(function(){
    
    // Add Class
    $('.edit').click(function(){
        $(this).addClass('editMode');
    
    });

    // Save data
    $(".edit").focusout(function(){
        $(this).removeClass("editMode");
 
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];

        var value = $(this).text();
     
        $.ajax({
            url: 'update_ingots.php',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                if(response == 1){ 
                    console.log('Save successfully'); 
                    
                }else{ 
                    console.log("Not saved."); 
                    
                }             
            }
        });
                
    });

});