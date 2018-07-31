<?
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <?= form_open('Welcome/add_lib')?>
        <center>
            <h1>Add Libraries</h1>
        </center>
        <table class="table">
            <tr>
                <th>Name</th>
                <td>
                    <input type ="text" name = "NAME" required/></br>
                    <?php if($this->session->has_userdata('DIR_EXIST')): 
                            echo "Already Exist!";
                          elseif($this->session->has_userdata('DIR_CREATED')):
                            echo "Library Created !";
                          endif;      
                    ?>
                </td>
                <td><button>Add</button></td>
            <tr>
        </table>
    </form>
</div>