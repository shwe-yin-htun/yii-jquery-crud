$(document).ready(function(){
    fetch();
    $('#create-customer').click(function(){
        $('.modal-title').html('Create Customer');
        $('#customer-modal').modal();
    });

    $('#save').click(function(){
        var obj={
            'username' : $('#username').val(),
            'email' : $('#email').val(),
            'password' : $('#password').val()
        };

        $.ajax({
            url: $('#create-route').val(),
            type : 'post',
            dataType:'json',
            data : obj,
            success: function(response) { 
                if(response.result){
                    var count= $('.grid-view table > tbody > tr').length ;
                        count= parseInt(count) + 1;
                    var tr ="<tr data-key='"+response.id+"'><td>"+count+"</td>"+
                            "<td>"+response.data.username+"</td>"+
                            "<td><a href='"+response.data.email+"'>"+response.data.email+"</a></td>"+
                            "<td>"+response.data.password+"</td>"+
                            "<td><button id='view' title='customer-view' data-id='"+response.id+"'><span class='glyphicon glyphicon-eye-open'></span></button>"+
                            "<button id='edit' title='customer-edit' data-id='"+response.id+"'><span class='glyphicon glyphicon-pencil'></span></button>"+
                            "<button id='delete' title='customer-delete' data-id='"+response.id+"'><span class='glyphicon glyphicon-trash'></span></button>"+
                            "</td></tr>";
                    $('#customer-modal').modal('hide');
                    $('.grid-view table > tbody').append(tr);
                    fetch();
                }else{
                    if(response.errors.username!=undefined && response.errors.username!='' && response.errors.username!=null){
                         $('#name_err').html(response.errors.username);
                    }
                    if(response.errors.email!=undefined && response.errors.email!='' && response.errors.email!=null){
                        $('#email_err').html(response.errors.email);
                   }
                   if(response.errors.password!=undefined && response.errors.password!='' && response.errors.password!=null){
                    $('#pwd_err').html(response.errors.password);
                   }
                }
            },
        });
    });
 });

 function fetch(){
     $('.grid-view table > tbody > tr').each(function(){
          $(this).find('td button#view').click(function(){    // for viewing details
             $.ajax({
                  type : 'get',
                  url :  $('#view-route').val()+'&id='+$(this).attr('data-id'),
                  dataType : 'json',
                  success : function(response){
                       console.log(response);
                  }
             })
             $('.modal-title').html('Customer Details');
             $('#customer-modal').modal();
          });

          $(this).find('td button#edit').click(function(){   // for editing
            $('.modal-title').html('Edit Customer');
            $('#customer-modal').modal();
          });

          $(this).find('td button#delete').click(function(){   // for deleting
            $('.modal-title').html('Delete Customer');
            $('#customer-modal').modal();
          });
     })
 }