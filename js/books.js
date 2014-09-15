jQuery(document).ready(function(){
    
    if(jQuery('.b_title').length>0){
        jQuery('.b_title').click(function(){
            jQuery(this).parents('tr').next().toggle(1000);
             jQuery(this).parents('tr').next().next().toggle(1000);
        })
    }
    if(jQuery('.pick_date').length>0){
        jQuery('.pick_date').datepicker({ dateFormat: "dd-mm-yy" });
    }
     
    if(jQuery('.remove').length>0){
        
        jQuery('.remove').click(function(){
            return confirm('Are you sure?');
        });
    }
   
});


