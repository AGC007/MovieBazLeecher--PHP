<?php

#~~ Developer : AGC007

#~~~~~~~ Var Set ~~~~~~~#
define('Account_Key' ,'c2FoYXJfbTYzQHlhaG9vLmNvbTpkYXJ0YW5pYW4=');
define('Account_Cookie' ,'PHPSESSID=2frjcc03irpgrldbpqapple5j6');
#~~~~~~~ Var Set ~~~~~~~#

#--------------- Get Url  ---------------#
if(isset($_REQUEST['link']))
{
  $Link = $_REQUEST['link'];
  $Link_Url = $_REQUEST['url'];
  $Full_Url = $Link."&url=".$Link_Url;

  MovieBazLeecher_v2(Account_Key,Account_Cookie,$Full_Url);
}
#--------------- Get Url ---------------#

#--------------- MovieBaz Leecher ---------------#
function MovieBazLeecher_v2($Account_Key , $Account_Cooike , $Movie_Url)
{
    #``````````` HEADER ```````````#

    $HEADER = array(
        'authorization: Basic '.$Account_Key,
        'cookie: '.$Account_Cooike,
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36 Edg/127.0.0.0',
    );

    #``````````` HEADER ```````````#

    #--------------- Get Request ---------------#

    $REQ_MOVIE_DATA = curl_init();

    curl_setopt($REQ_MOVIE_DATA, CURLOPT_URL, $Movie_Url);
    curl_setopt($REQ_MOVIE_DATA, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($REQ_MOVIE_DATA, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($REQ_MOVIE_DATA, CURLOPT_FOLLOWLOCATION, false);
    //curl_setopt($REQ_MOVIE_DATA, CURLOPT_POSTFIELDS, "{}");
    //curl_setopt($REQ_MOVIE_DATA, CURLOPT_HEADER, true);
    curl_setopt($REQ_MOVIE_DATA, CURLOPT_HTTPHEADER, $HEADER);
    curl_setopt($REQ_MOVIE_DATA, CURLOPT_TIMEOUT, 30);

    echo $RES_MOVIE_DATA_RES = curl_exec($REQ_MOVIE_DATA);

    #--------------- Get Request ---------------#

    if(!strstr($RES_MOVIE_DATA_RES, 'login')) // Check Subscribe
    {
        #--------------- Get_Data_Movie ---------------#
        $MOVIE_DOWN_LINK =  curl_getinfo($REQ_MOVIE_DATA, CURLINFO_REDIRECT_URL);

        #~~~~ Movie Json ~~~~#

        echo(json_encode(array(
            'code' => http_response_code(),
            'message' => 'success' ,
            'developer' => 'AGC007',
                'dl' => array(
                    'DownloadLink' => $MOVIE_DOWN_LINK ,
                ),
             'Developer' => "AGC007"
                )));

        #~~~~ Movie Json ~~~~#
    }
    else {
        echo(json_encode(array(
            'message' => 'Account Login Error' ,
            'developer' => 'AGC007',
        )));
    }
}

#~~ Developer : AGC007

#--------------- MovieBaz Leecher ---------------#
?>