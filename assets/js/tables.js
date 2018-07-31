$(document).ready(function(){
   $('#data').DataTable();
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


    $("#add_btn").click(function(){
        $.ajax({
            url : "add_prop",
            type : "post",
            dataType : "json",
            data : {"NAME":$("#ADD_PROP").val(), "LIB_ID":13},
            success : function(data){
                if(data.status == 1)
                {
                    alert("successs");
                    var dataToAppend = "<tr>"
                                           +"<td>"+ $("#ADD_PROP").val()  +"</td>" 
                                           +"<td>" + "<button class = 'remove_btn' id = '"+ data.ID+"'>"+ "X" +"</button>"
                                      +"</tr>"
                    $("#data").append(dataToAppend);
                }
            }
        });
    });
});
// $(document).ready(function(){
    
// });

