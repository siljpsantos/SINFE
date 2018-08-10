<?php
for($i=0;$i<20;$i++){
    $data = date('m/Y',strtotime( "-$i month" ) );
    $mes_app .= "<option>$data</option>";
    
    echo "<script>alert('oi');</script>";
    
    if($data==="11/2016"){
        break;
    }
}