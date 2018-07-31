<?
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
        <center>
            <h1>Add Libraries</h1>
        </center>
        <?= form_open_multipart('add_files')?>
            <table class="table">
                <tr>
                    <th>File Name</th>
                    <td><input type="text" name="FILE_NAME" required/></td>
                    <th>Library</th>
                    <td>
                        <select name="LIBRARY">
                            <?= options("library" , 'ID' , 'NAME');?>
                        </select>
                    </td>
                    <td>
                        <input type="file" name="file" required/>
                    </td>
                </tr>

            </table>
        </form>    
</div>