<?php

if($_GET["Link"] && strpos($_GET["url"] , "mkv"))
{
    $MovieServer = $_GET["Link"][-1];
    $MovieLink = $_GET["url"];
    GetDownloadLink($MovieServer , $MovieLink);
}

function GetDownloadLink($MovieServer , $MovieLink)
{

    #~~~~~~~~~~ Account info  ~~~~~~~~~~#

    $Username = "--- Account Username ---";
    $Password = "--- Account Password ---";
    $Account_Base_64 = base64_encode($Username.":".$Password);
    $Check_Movie_Link = "https://mvbz.net/%d8%af%d8%a7%d9%86%d9%84%d9%88%d8%af-%d8%b3%d8%b1%db%8c%d8%a7%d9%84-hayatimin-nesesi/";

    #~~~~~~~~~~ Account info  ~~~~~~~~~~#

    #~~~~~~~~~~ Get New Address ~~~~~~~~~~#

    $REQ_MoviBaz_Home = curl_init();

    $Headers_Home_REQ = array(
        'Cookie: login='.$Username.'; cocat1=; cocat3=; cocat4=; cocat5=; cocat6=; cocat7=; cocat8=',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Edg/116.0.1938.81'
    );

    curl_setopt($REQ_MoviBaz_Home, CURLOPT_URL, $Check_Movie_Link);
    curl_setopt($REQ_MoviBaz_Home, CURLOPT_HTTPHEADER, $Headers_Home_REQ);
    curl_setopt($REQ_MoviBaz_Home, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($REQ_MoviBaz_Home, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($REQ_MoviBaz_Home, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

    $Resopone_REQ_Home = curl_exec($REQ_MoviBaz_Home);

    preg_match('"a href=\"https://(.*?)/download.php"' , $Resopone_REQ_Home , $Download_HostName_REG);

    #~~~~~~~~~~ Get New Address ~~~~~~~~~~#

    #~~~~~~~~~ New Address  ~~~~~~~~~~#

    $Download_HostName =  $Download_HostName_REG[1];
    $MovieLink = "https://".$Download_HostName."/download.php?server=".$MovieServer."&url=".$MovieLink;

    #~~~~~~~~~ New Address  ~~~~~~~~~~#

    #~~~~~~~~~~ Get Download Link ~~~~~~~~~~#

    $REQ_MoviBaz_Down = curl_init();

    $Headers_Down_REQ = array(
        'Authorization: Basic '.$Account_Base_64,
        'Cookie: PHPSESSID=g3f563a7l2t1cdkvepu90gmcui',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Edg/116.0.1938.81'
    );

    curl_setopt($REQ_MoviBaz_Down, CURLOPT_URL, $MovieLink);
    curl_setopt($REQ_MoviBaz_Down, CURLOPT_HTTPHEADER, $Headers_Down_REQ);
    curl_setopt($REQ_MoviBaz_Down, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($REQ_MoviBaz_Down, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($REQ_MoviBaz_Down, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($REQ_MoviBaz_Down, CURLOPT_HEADER, 1);

    $Resopone_REQ_Down = curl_exec($REQ_MoviBaz_Down);

    preg_match('/^location:*([^;]*)strict/mi' , $Resopone_REQ_Down , $Download_Link_Reg);
    $Download_Link = $Download_Link_Reg[1];

    preg_match('"http://dl(.*?)/"' , $Download_Link[1] , $Download_URL_Name_Reg);
    $Download_URL_Name = substr($Download_URL_Name_Reg[1] , 2);

    #~~~~~~~~~~ Get Download Link ~~~~~~~~~~#

    #~~~~~~~~~~ Download Link ~~~~~~~~~~#

    $DownLink = $Download_Link;
    #echo($DownLink);
    echo(json_encode(array('DownloadLink' => $DownLink , 'Developer' => "AGC007")));
    #~~~~~~~~~~ Download Link ~~~~~~~~~~#

#--------------------------------------------- M2 ---------------------------------------------------------#

    /*
      $DwnloadLink_D = ".mvbznet.link";

      $DownLink_Original = "http://dl" . $MovieServer .$DwnloadLink_D."/" . $MovieLink;

      if(file_exists($DownLink_Original) == false)
      {
        $DownLink_Original_2 = "http://dl" . "4" .$DwnloadLink_D."/" . $MovieLink;
        $Http_Res = http_response_code(file_get_contents($DownLink_Original_2, FALSE, NULL, 1, 1));

        if($Http_Res != 200)
        {
          $DownLink = $DownLink_Original_2;
          #echo($DownLink);
          echo(json_encode(array('DownloadLink' => $DownLink , 'Developer' => "AGC007")));
        }
        else
        {
          for ($i=0; $i < 10; $i++)
          {
            $DownLink_Original_3 = "http://dl" . $i .$DwnloadLink_D."/" . $MovieLink;
            $Http_Res_2 = http_response_code(file_get_contents($DownLink_Original_3, FALSE, NULL, 1, 1));

            if($Http_Res_2 != 200)
            {
              $DownLink = $DownLink_Original_3;
              #echo($DownLink);
              echo(json_encode(array('DownloadLink' => $DownLink , 'Developer' => "AGC007")));
              break;
            }
          }
        }
      }
      else
      {
        $DownLink = $DownLink_Original;
        #echo($DownLink);
        echo(json_encode(array('DownloadLink' => $DownLink , 'Developer' => "AGC007")));
      }
      */
}
//------------------- GetLink ---------------------//
?>
