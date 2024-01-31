<?php

$ACCESS_TOKEN = "e0e5b85beda8ec987a8d15caa0ba93338d5e0879";
$PATH = "/open_api/v1.3/report/integrated/get/";

function build_url($path)
{
    return "https://business-api.tiktok.com" . $path;
}

function get($json_str)
{
    global $ACCESS_TOKEN, $PATH;
    $curl = curl_init();

    $args = json_decode($json_str, true);

    foreach ($args as $key => $value) {
        $args[$key] = is_string($value) ? $value : json_encode($value);
    }

    $url = build_url($PATH) . "?" . http_build_query($args);

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Access-Token: " . $ACCESS_TOKEN,
            "Content-Type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Define your parameters for the Business Center report
$bc_id = "6834409355886985221"; // Replace with your actual Business Center ID
$report_type = "BC";
$data_level = "AUCTION_ADVERTISER";
$dimensions = array("stat_time_day", "gender"); // Adjust dimensions based on data_level
$metrics = array("spend", "impressions", "ctr"); // Include other metrics
$start_date = "2023-01-01"; // Set to your desired start date
$end_date = "2024-01-31";   // Set to your desired end date

// Args in JSON format
$my_args = sprintf(
    '{"bc_id": "%s", "report_type": "%s", "data_level": "%s", "dimensions": %s, "metrics": %s, "start_date": "%s", "end_date": "%s"}',
    $bc_id,
    $report_type,
    $data_level,
    json_encode($dimensions),
    json_encode($metrics),
    $start_date,
    $end_date
);

// Get and print the Business Center report
echo get($my_args);
?>
