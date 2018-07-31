<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
        <center>
            <h1>Add Library MetaData</h1>
        </center>
        <table class="table">
            <tr>
                <th><?= $data['NAME']?></th>
                <td>
                    <th>Add Feild</th>
                </td>
                <td><input type ="text" id="ADD_PROP" /></td>
                <td><button ID="add_btn">Add</button></td>
                
            <tr>
         </table>   
         <table id="data" class="table">
                <tr>
                    <th>Name</th>
                    <th></th>
                </tR>
         </table>
    </form>
</div>
<script>
    $(document).ready(function(){
        $("#add_btn").click(function(){
            $.ajax({
                url : "add_prop",
                type : "post",
                dataType : "json",
                data : {"NAME":$("#ADD_PROP").val(), "LIB_ID":<?= $data['ID']?>},
                success : function(data){
                    if(data.status == 1)
                    {
                        alert("success");
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
</script>