$(document).ready(function(){
    fetch();
    $('#create-customer').click(function(){
        clear();
        $('#save').attr('data-id','');
        $('.modal-title').html('Create Customer');
        $('#customer-modal').modal();
    });

    $('#save').click(function(){
        var id = $(this).attr('data-id');
        var url = (id =='' || id==null) ?  $('#create-route').val() : $('#update-route').val()+'&id='+id;
        var obj={
            'username' : $('#username').val(),
            'email' : $('#email').val(),
            'password' : $('#password').val()
        };

        $.ajax({
            url: url,
            type : 'post',
            dataType:'json',
            data : obj,
            success: function(response) { 
                if(response.result){
                    $('#customer-modal').modal('hide');
                    if(response.method=='create'){   // for adding new customer
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
                        $('.grid-view table > tbody').append(tr);
                        fetch();
                    }else{  // for updating customer
                        console.log(response);
                        var tr = $("tr[data-key='"+response.data.id+"']");
                        tr.find('td:eq(1)').text(response.data.username);
                        tr.find('td:eq(2) a').text(response.data.email);
                        tr.find('td:eq(3)').text(response.data.password);
                    }
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
          $(this).find('td button#edit').click(function(){    // for viewing details
             clear();
             var id =parseInt( $(this).attr('data-id') );
             $('#save').attr('data-id',id);
             $.ajax({
                  type : 'get',
                  url :  $('#view-route').val()+'/'+id,
                  dataType : 'json',
                  success : function(response){
                       if(response.result){
                           $('#username').val(response.data.username);
                           $('#email').val(response.data.email);
                           $('#password').val(response.data.password);
                       }
                  }
             })
             $('.modal-title').html('Edit Customer');
             $('#customer-modal').modal();
          });

          $(this).find('td button#view').click(function(){   // for editing
            clear();
            $('.modal-title').html('Customer Details');
            $('#customer-modal').modal();
          });

          $(this).find('td button#delete').click(function(){   // for deleting
               var tr = $(this);
               if(confirm('Are you sure to delete ?')){
                    $.ajax({
                        type : 'post',
                        url :  $('#delete-route').val()+'/'+$(this).attr('data-id'),
                        dataType : 'json',
                        success : function(response){
                            if(response.result){
                                tr.closest('tr').remove();
                            }else{
                                alert('Something went wrong !');
                            }
                        }
                   })
               }
          });
     })
 }

 function clear(){
     $('#username').val('');
     $('#email').val('');
     $('#password').val('');
     $('#name_err').html('');
     $('#email_err').html('');
     $('#pwd_err').html('');
 }