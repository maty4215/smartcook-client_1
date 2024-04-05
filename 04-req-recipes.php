<?php
require_once("SmartCookClient.php");
 
$request_data = [
    "attributes" => ["id", "name", "author"],
    "filter" => [
        "author" => ["Fárek Matěj"],
    ]
];
 
try {
    $client = new SmartCookClient();
    $client->setRequestData($request_data);
    $client->sendRequest("recipes");
    
    if (method_exists($client, 'getResponseData')) {
        $response = $client->getResponseData();
 
        if (isset($response['data'])) {
            $data = $response['data'];
            foreach ($data as $recipe) {
                echo "<ul>";
                echo "<li>" . $recipe['id'] . "</li>";
                echo "<li>" . $recipe['name'] . "</li>";
                echo "<li>" . $recipe['author'] . "</li>";
                echo "</ul>";
            }
        } else {
            echo "Key 'data' is not foudn in answer.";
        }
    } else {
        echo "Method getResponseData() is not existing in class SmartCookClient.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}