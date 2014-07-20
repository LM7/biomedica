<?php

class DeleteRecord {
    
    public static function Delete($NG, $insertion_date,$row=1) {
        
        $log = new Log();
        $log ->emptyAll();
    
        $success = 0;
        
        if($NG != null && is_numeric($NG)){ 
            $mysqli = new mysqli('localhost', 'root', '', 'clinical_data');
            
            if (mysqli_connect_errno()) {
                $log->write(mysqli_connect_error() . "<br />");
                die;
            }
            $mysqli->autocommit(true);
            
            $query= sprintf("DELETE FROM patient WHERE ng='".$NG."' AND insertion_date='".$insertion_date."'");
            $dati=$mysqli->query($query); 
            if($dati) {
                $success++;
            }
            else {
                $log->write( "fallimentoPatient riga: ".$row . "<br />");
            }
            if($success > 0) {
                $query= sprintf("DELETE FROM cns WHERE ng_cns='".$NG."' AND insertion_date_cns='".$insertion_date."'");                    
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoCNS riga: ".$row . "<br />");   
                    
                    
                $query= sprintf("DELETE FROM eyes WHERE ng_eyes='".$NG."' AND insertion_date_eyes='".$insertion_date."'");
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoEYES riga: ".$row . "<br />");      
                
                
                $query= sprintf("DELETE FROM kidneys WHERE ng_kidneys='".$NG."' AND insertion_date_kidneys='".$insertion_date."'");
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoKIDNEYS riga: ".$row . "<br />");   
                
                
                $query= sprintf("DELETE FROM liver WHERE ng_liver='".$NG."' AND insertion_date_liver='".$insertion_date."'");
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoLIVER riga: ".$row . "<br />"); 
                
                
                $query= sprintf("DELETE FROM polydactyly WHERE ng_polydactyly='".$NG."' AND insertion_date_polydactyly='".$insertion_date."'");
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoPOLYDACTYLY riga: ".$row . "<br />");   
                
                
                $query= sprintf("DELETE FROM tongue WHERE ng_tongue='".$NG."' AND insertion_date_tongue='".$insertion_date."'"); 
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoTONGUE riga: ".$row . "<br />");                
                
                
                $query= sprintf("DELETE FROM mti WHERE ng_mti='".$NG."' AND insertion_date_mti='".$insertion_date."'"); 
                $dati=$mysqli->query($query);
                if($dati)
                    $success++;
                else 
                    $log->write( "fallimentoMTI riga: ".$row . "<br />");
                                
            }
            $mysqli->close();           
        }
        
        else {
            $log->write( "fallimento NG e'vuoto o non e' un numero riga: ".$row . "<br />");
        }
        if($success == 8)
            return 1;
        else
            return 0;
        
    }

}

?>