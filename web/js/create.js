$(document).ready(function(){
    $('#create-country').click(function(){
            $('#country-modal').modal();
    });

    $('#save').click(function(){
        var obj={
            'name' : $('#name').val(),
            'code' : $('#code').val(),
            'description' : $('#des').val()
        };

        console.log(obj);

        $.ajax({
            url: "<?= Yii::$app->request->baseUrl ?>/create",
            type : 'post',
            dataType:'json',
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