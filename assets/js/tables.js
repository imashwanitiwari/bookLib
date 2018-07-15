$(document).ready(function(){
   $('#table').DataTable({

                
        "ajax":
        {
         "url":"dashboard/get_jobs",
         "type":"post"
        
       },
       
       "columns": [
        { "data": "SR" },
        { "data": "JOB_TITLE" },
        { "data" : "NAME" },
        { "data" : "USERNAME" },
        { "data" : "ACTION"}
        
    
                ]





    });
    var path =  window.location.pathname.split('/');
    var len = path.length-1;
    $('#tablea').DataTable({

                
        "ajax":
        {
         "url":"../get_inbox/"+path[len],
         "type":"post"
        
       },
       
       "columns": [
        { "data": "SR" },
        { "data": "NAME" },
        { "data" : "MSG" },
        { "data" : "TIME" },
        { "data" : "ACTION" }
        
    
                ]





    });
    var len2 = path.length-2;
    $(".fa-send").click(function(){
        var msg = $(".msg").val();
        if(msg !="")
        {
        $.ajax({
            url:"../../insert_chat/"+path[len]+"/"+path[len2],
            type:"post",
            data:{"msg":msg},
            success:function(data){
                $(".container1").append("<div class = 'is-reply-1'>"+msg+"</div><br clear='all' />");
                $(".msg").val("");
            }
        });
    }
    });
});