<?php

if($_GET["Link"] && strpos($_GET["url"] , "mkv"))
{ 
    $MovieLink = $_GET["url"];
    GetDownloadLink($MovieLink);
}

function GetDownloadLink($MovieLink)
{
    for($i=1;  $i<=10;  $i++)
    {
        $DownloadLink = "http://dl" . $i .".mvbz.bid/" . $MovieLink;
        $GetPageLink = curl_init();
        curl_setopt($GetPageLink, CURLOPT_URL, $DownloadLink);
        curl_setopt($GetPageLink, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($GetPageLink, CURLOPT_CUSTOMREQUEST, 'GET' );
        curl_setopt($GetPageLink, CURLOPT_USERAGENT, 'HTTP_USER_AGENT');
        curl_setopt($GetPageLink, CURLOPT_HEADER, 1);
        curl_setopt($GetPageLink, CURLOPT_TIMEOUT,1);
        $Source = curl_exec($GetPageLink);

        if(strpos($Source , "404") || strpos($Source , "403"))
        {

        }
        else
        { 
            echo(json_encode(array('DownloadLink' => $DownloadLink , 'Developer' => "AGC007"))); 
            break;
        }
    }
 }
?>