<!DOCTYPE html>
<html lang=it><head>
<title>Download</title></head>
<body>

    <?php 

    function show1($arr,$patient=0,$cns=0,$eyes=0,$kidneys=0,$liver=0,$mti=0,$polydactyly=0,$tongue=0) {
        //table table-striped   
        $print = '<table class="table table-striped" border=1 cellpadding=3 style="width:25cm; margin-left: 1cm; margin-right: 1cm; margin-top: 1cm">'; 
        $print .= "<tr>";
        if ($patient)
            $print .= "<th>NG</th> <th>insertion_date</th> <th>family</th> <th>sex</th> <th>consang</th> <th>cns</th>
            <th>eyes</th> <th>kidneys</th> <th>liver</th> <th>polydactyly</th> <th>tongue</th> <th>heart</th>
            <th>dysmorphic</th> <th>mti</th> <th>notes</th> <th>diagnosis</th>";
            
        if ($cns)
            $print .= "<th bgcolor='#00FF00'>ng_cns</th> <th>insertion_date_cns</th> <th>breath</th> <th>id</th> <th>hypotonia</th> 
            <th>ataxia</th> <th>apraxia</th> <th>nystagmus</th>";
        
        if ($eyes)
            $print .= "<th>ng_eyes</th> <th>insertion_date_eyes</th> <th>leber_amaurosis</th> <th>retinopathy</th> 
            <th>coloboma</th>";
            
        if ($kidneys)
            $print .= "<th>ng_kidneys</th> <th>insertion_date_kidneys</th> <th>renal_failure</th> <th>nph</th> 
            <th>cystis</th> <th>eco_blood_alterations</th>";
            
        if ($liver)
            $print .= "<th>ng_liver</th> <th>insertion_date_liver</th> <th>eco_blood_alterations_liver</th> <th>hf</th>";   
            
        if ($mti)
            $print .= "<th>ng_mti</th> <th>insertion_date_mti</th> <th>em_cele</th> <th>hydroceph</th> 
            <th>dw</th> <th>cc_hypopl</th>";  
            
        if ($polydactyly)
            $print .= "<th>ng_polydactyly</th> <th>insertion_date_polydactyly</th> <th>postaxial</th> <th>mesa_preaxial</th>";  
            
        if ($tongue)
            $print .= "<th>ng_tongue</th> <th>insertion_date_tongue</th> <th>cleft_lip_palat</th>";  
            
        $print .= "</tr> ";
        for($i=0;$i<count($arr);$i++) {
            $print .= "<tr>";
            $row = $arr[$i];
            for($j=0;$j<count($row)/2;$j++) {
                $print .= "<td>".$arr[$i][$j] . "</td> "; 
            }
            $print .= "</tr>";
        }
        $print .= "</table>"; 
        return $print;
    }

    function show($arr) {
        $print = '<table class="table table-striped" border=1 cellpadding=3 style="width:25cm; margin-left: 1cm; margin-right: 1cm; margin-top: 1cm">'; 
        $print .= "<tr>";
        $print .= "<th>FAMILY</th> <th>NG</th> <th>INSERTION DATE</th> <th> </th> <th>sex</th> <th>consang</th> 
        <th bgcolor='#8DB4E2'>CNS</th> <th bgcolor='#8DB4E2'>breath</th> <th bgcolor='#8DB4E2'>id</th> <th bgcolor='#8DB4E2'>hypotonia</th>
        <th bgcolor='#8DB4E2'>ataxia</th> <th bgcolor='#8DB4E2'>apraxia</th> <th bgcolor='#8DB4E2'>nystagmus</th> <th bgcolor='#DA9694'>EYES</th> 
        <th bgcolor='#DA9694'>leber amaurosis</th> <th bgcolor='#DA9694'>retinopathy</th> <th bgcolor='#DA9694'>coloboma</th>
        <th bgcolor='#B1A0C7'>KIDNEYS</th> <th bgcolor='#B1A0C7'>renal failure</th> <th bgcolor='#B1A0C7'>nph</th>
        <th bgcolor='#B1A0C7'>cystis</th> <th bgcolor='#B1A0C7'>eco/blood alterations</th> <th bgcolor='#C4D79B'>LIVER</th>
        <th bgcolor='#C4D79B'>eco/blood alterations</th> <th bgcolor='#C4D79B'>hf</th> <th bgcolor='#FABF8F'>POLYDACTYLY</th>
        <th bgcolor='#FABF8F'>postaxial</th> <th bgcolor='#FABF8F'>mesa-preaxial</th> <th bgcolor='#C4BD97'>TONGUE</th>
        <th bgcolor='#C4BD97'>cleft lip/palate</th> <th bgcolor='#31869B'>HEART</th> <th bgcolor='#92D050'>DYSMORPHIC FEATURES</th>
        <th bgcolor='#FFFF00'>MTI</th> <th bgcolor='#FFFF00'>e/m cele</th> <th bgcolor='#FFFF00'>hydropeph</th>
        <th bgcolor='#FFFF00'>dw</th> <th bgcolor='#FFFF00'>cc hypopl</th> <th>Notes</th> <th>Diagnosis</th>";
        $print .= "</tr> ";
        
        for($i=0;$i<count($arr);$i++) {
            $print .= "<tr>";
            $print .= "<td>".$arr[$i][2] . "</td> ";
            $print .= "<td>".$arr[$i][0] . "</td> ";
            $print .= "<td>".$arr[$i][1] . "</td> ";
            $print .= "<td> </td> ";
            $print .= "<td>".$arr[$i][3] . "</td> ";
            $print .= "<td>".$arr[$i][4] . "</td> ";
            $print .= "<td>".$arr[$i][5] . "</td> ";
            $print .= "<td>".$arr[$i][18] . "</td> ";
            $print .= "<td>".$arr[$i][19] . "</td> ";
            $print .= "<td>".$arr[$i][20] . "</td> ";
            $print .= "<td>".$arr[$i][21] . "</td> ";
            $print .= "<td>".$arr[$i][22] . "</td> ";
            $print .= "<td>".$arr[$i][23] . "</td> ";
            $print .= "<td>".$arr[$i][6] . "</td> ";
            $print .= "<td>".$arr[$i][26] . "</td> ";
            $print .= "<td>".$arr[$i][27] . "</td> ";
            $print .= "<td>".$arr[$i][28] . "</td> ";
            $print .= "<td>".$arr[$i][7] . "</td> ";
            $print .= "<td>".$arr[$i][31] . "</td> ";
            $print .= "<td>".$arr[$i][32] . "</td> ";
            $print .= "<td>".$arr[$i][33] . "</td> ";
            $print .= "<td>".$arr[$i][34] . "</td> ";
            $print .= "<td>".$arr[$i][8] . "</td> ";
            $print .= "<td>".$arr[$i][37] . "</td> ";
            $print .= "<td>".$arr[$i][38] . "</td> ";
            $print .= "<td>".$arr[$i][9] . "</td> ";
            $print .= "<td>".$arr[$i][47] . "</td> ";
            $print .= "<td>".$arr[$i][48] . "</td> ";
            $print .= "<td>".$arr[$i][10] . "</td> ";
            $print .= "<td>".$arr[$i][51] . "</td> ";
            $print .= "<td>".$arr[$i][11] . "</td> ";
            $print .= "<td>".$arr[$i][12] . "</td> ";
            $print .= "<td>".$arr[$i][13] . "</td> ";
            $print .= "<td>".$arr[$i][41] . "</td> ";
            $print .= "<td>".$arr[$i][42] . "</td> ";
            $print .= "<td>".$arr[$i][43] . "</td> ";
            $print .= "<td>".$arr[$i][44] . "</td> ";
            $print .= "<td>".$arr[$i][14] . "</td> ";
            $print .= "<td>".$arr[$i][15] . "</td> ";
            $print .= "</tr>";
        }
        $print .= "</table>"; 
        return $print;
    }
    
    ob_start();
    session_start();
    if(isset($_SESSION['result'])) {
        $result = $_SESSION['result'];   
        echo show($result);     
        $filename="dati.xls";
        header ("Content-Type: application/vnd.ms-excel");
        header ("Content-Disposition: inline; filename=$filename");
        
    }
    ?>

</body>
</html>
