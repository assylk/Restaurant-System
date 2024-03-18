// cURL

<?php
$amount =$_GET['amount'];
$bill_id =$_GET['bill_id'];

$amount=$amount*1000;
$amount=strval($amount);

$curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://developers.flouci.com/api/generate_payment',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "app_token": "cd55ed54-57fe-4de4-ba0e-e06c64ab1ea2",
    "app_secret": "94139f74-4c49-4a00-8b5a-b59d40143f6f",
    "accept_card": "true",
    "amount":' . $amount . ',
    "success_link": "http://localhost/tasteit/adminSide/posBackend/creditCard.php?bill_id=' . $bill_id . '",
    "fail_link": "http://localhost/shop/shop.php",
    "session_timeout_secs": 1200,
    "developer_tracking_id": "a813ff17-9c04-4260-a3f7-750fcaebf7d7"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true); // true to convert it to an associative array
$link= $data['result']['link'];;

header("location: $link");
?>