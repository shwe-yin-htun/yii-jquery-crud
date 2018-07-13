$(document).ready(function(){
    $('#create-country').click(function(){
            $('#country-modal').modal();
    });

    $('#save').click(function(){
        var obj={
            _csrf : $('#token').val(),
            'name' : $('#name').val(),
            'code' : $('#code').val(),
            'description' : $('#des').val()
        };

      
        $.ajax({
            url: $('#create-route').val(),
            type : 'post',
            data : obj,
            success: function(data) { 
                console.log(data); 
            },
            error : function(err){
                console.log(err);
            }          
        });
    });
 });