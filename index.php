<?php
include "head.php";
$noc = $conn->prepare("SELECT sessto from savetofolder  where hide='Yes' and  `sessid`='$_SESSION[naukrichosis]' and type='admin'");
$noc->execute();
while ($ssnoce = $noc->fetch(PDO::FETCH_ASSOC)) {
    $sesstidd .= $ssnoce['sessto'];
    $sesstidd .= ",";
}
$sesstidd = substr($sesstidd, 0, -1);
$exstid   = explode(",", $sesstidd);
$impstid  = implode("','", $exstid);
$val      = array_count_values($exstid);
$hid      = count($val);
$notadmin = $conn->prepare("SELECT count(*) as twototal,
                COUNT(CASE WHEN status='Active' and type!='admin'    THEN 1 END) AS notadmin, 
                COUNT(CASE WHEN  status='Active'  and type='admin' THEN 1 END) AS admin,
                COUNT(CASE WHEN status='Active'    THEN 1 END) AS allrowcount,  
        COUNT(CASE WHEN status='Active' and import='monster'   THEN 1 END) AS mon, 
        COUNT(CASE WHEN status='Active' and import='naukri'   THEN 1 END) AS naukr,  
                COUNT(CASE WHEN  status='Active' and DATE(created_date) = CURDATE() THEN 1 END) AS current_rowcount    FROM `resume`");
$notadmin->execute();
$sssdcqwdse       = $notadmin->fetch(PDO::FETCH_ASSOC);
$allrowcount      = $sssdcqwdse['allrowcount'];
$mon              = $sssdcqwdse['mon'];
$naukr            = $sssdcqwdse['naukr'];
$admin            = $sssdcqwdse['admin'];
$notadmin         = $allrowcount - $admin;
$hide             = $hid;
$nothide          = $allrowcount - $hid;
$current_rowcount = $sssdcqwdse['current_rowcount'];
?> 
