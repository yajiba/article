jQuery(function($) {
    $('#article-table').DataTable();
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
    });
   // this is the id of the form
    $("#addform").on('submit',(function(e) {
    e.preventDefault();
      
    $.ajax({
        type: "POST",
        url: 'route.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
            var response = JSON.parse(data);
            if(response['status'] == 'success') {
                alert(response['message']);
                document.location.reload();
            }else {
                alert(response['message']);
            }
           
        }
    });
    
    }));

    $("#updateform").on('submit',(function(e) {
        e.preventDefault();
       
        $.ajax({
            type: "POST",
            url: 'route.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data)
            {
                
                var response = JSON.parse(data);
                if(response['status'] == 'success') {
                    alert(response['message']);
                    document.location.reload();
                }else {
                    alert(response['message']);
                }
               
            }
        });
        }));

        $("#mailform").on('submit',(function(e) {
            e.preventDefault();
            $('#mailarticle').val('Sending...')
            $.ajax({
                type: "POST",
                url: 'route.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#mailarticle').val('Send');
                    var response = JSON.parse(data);
                    if(response['status'] == 'success') {
                        alert(response['message']);
                        document.location.reload();
                    }else {
                        alert(response['message']);
                    }
                   
                }
            });
            }));

        $(".deletearticle").click(function(e) {
            if (confirm("Are you sure you want to delete this article?")) {
                $.ajax({        
                    url: 'route.php',
                    type: 'post',             
                    data: {'id' : $(this).attr('id')},
                    success: function(data){
                       var response = JSON.parse(data);
                        if(response['status'] == 'success') {
                            alert(response['message']);
                            document.location.reload();
                        }else {
                            alert(response['message']);
                        }
                    }  
                });
            }
            
           
        });

        
});