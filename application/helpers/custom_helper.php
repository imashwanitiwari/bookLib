<?php
function options($table,$f1,$f2)
    {
        
        $CI =& get_instance();
        $q=$CI->db->select(array($f1,$f2))
                    ->get($table);
                    if($q->num_rows()>=1)
                    {
                        // return TRUE;
                       $data= $q->result_array();
                       
                       foreach($data as $option):
                            echo '<option value="'.$option[$f1].'">'.$option[$f2].'</option>';
            
                        endforeach;
        
                    }
    }