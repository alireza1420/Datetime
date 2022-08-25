<?php 

function currencyExchange($Currency1,$Currency2){
    if($Currency1!=null && $Currency2!=null){
$req_url = 'https://api.exchangerate.host/convert?from={$Currency1}&to={$Currency2}';
$response_json = file_get_contents($req_url);

$data=json_decode($response_json);

echo $data->info->rate;
    }
    
}

?>