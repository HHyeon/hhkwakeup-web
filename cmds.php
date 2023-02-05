<?php

$jsonresult = array();

if(isset($_GET["p"]))
{
    $param=$_GET["p"];

    if($param == "check")
    {
        $pingcheck='ping -c 1 -W 1 192.168.0.100 && echo TRUE || echo FALSE';
        $output = exec($pingcheck);

        if($output == "TRUE")
            $jsonresult["check"] = TRUE;
        else
            $jsonresult["check"] = FALSE;

        $jsonresult["ret"]=TRUE;
    }
    else if($param == "wake")
    {
        $hhkwakeup='./wake_root';
        $output = exec($hhkwakeup);
        
        if($output == "waking-up")
            $jsonresult["wake"] = TRUE;
        else
            $jsonresult["wake"] = FALSE;

        $jsonresult["ret"]=TRUE;
    }
    else if($param == "hddwake")
    {
        $output = exec('./hddwake > /dev/null 2>&1 &');

        $jsonresult["ret"]=TRUE;
    }
    else if($param == "hds_sda")
    {
        $output = exec('./hds_sda');
        $jsonresult["hds_sda"] = $output;
        
        $jsonresult["ret"]=TRUE;
    }
    else if($param == "hds_sdb")
    {
        $output = exec("./hds_sdb");
        $jsonresult['hds_sdb'] = $output;
        
        $jsonresult["ret"]=TRUE;
    }
    else
    {
        $jsonresult["ret"]=FALSE;
    }
}
else
{
    $jsonresult["ret"]=FALSE;
}

echo json_encode($jsonresult);

?>
