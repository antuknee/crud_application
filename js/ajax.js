//ADDING NEW PRODUCT
$(document).ready(function () { 
    $('#user_form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
    
        $.ajax({
            type:'POST',
            url: '../backend/save.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                // console.log("success");
                // console.log(data);
                $('#addEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));
 });



//GETTING DATA TO EDIT MODAL
 $(document).ready(function () { 
    $(document).on('click','.update',function(e) {
    var id=$(this).attr("data-id");
    var product_e=$(this).attr("data-product");
    var unit_e=$(this).attr("data-unit");
    var price_e=$(this).attr("data-price");
    var date_e=$(this).attr("data-date");
    var available_e=$(this).attr("data-avail");
   // var image_e=$(this).attr("data-image");
    
    $('#id_u').val(id);
    $('#product_u').val(product_e);
    $('#unit_u').val(unit_e);
    $('#price_u').val(price_e);
    $('#date_u').val(date_e);
    $('#available_inv_u').val(available_e);
    //$('#image_u').val(image_e);
    });
});
//EDIT MODAL
 $(document).ready(function () { 
    $('#update_form').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: '../backend/save.php',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                // console.log("success");
                // console.log(data);
               $('#editEmployeeModal').modal('hide');
                location.reload();
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));
 });

//DELETE
$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
    
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "../backend/save.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success: function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                $("#"+dataResult).remove();
        
        }
    });
});
 //DELETE MULTIPLE
$(document).on("click", "#delete_multiple", function() {    
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if(user.length <=0) {
        alert("Please select records."); 
    } 
    else { 
        WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "../backend/save.php",
                cache:false,
                data:{
                    type: 4,						
                    id : selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i=0; i < ids.length; i++ ) {	
                        $("#"+ids[i]).remove(); 
                    }	
                } 
            }); 
        }  
    } 
});

// CHECK BOX
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});


