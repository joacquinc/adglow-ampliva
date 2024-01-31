<?php

$ACCESS_TOKEN = "e0e5b85beda8ec987a8d15caa0ba93338d5e0879";
$PATH = "/open_api/v1.3/campaign/get/";
$DB_HOST = "localhost";
$DB_NAME = "ampliva";
$DB_USER = "root";
$DB_PASSWORD = "";

// Function to build URL
function build_url($path)
{
    return "https://business-api.tiktok.com" . $path;
}

// Function to perform API GET request
function get($json_str)
{
    global $ACCESS_TOKEN, $PATH;
    $curl = curl_init();

    $args = json_decode($json_str, true);

    foreach ($args as $key => $value) {
        $args[$key] = is_string($value) ? $value : json_encode($value);
    }

    $url = build_url($PATH) . "?" . http_build_query($args);

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Access-Token: " . $ACCESS_TOKEN,
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        echo "cURL Error: " . curl_error($curl);
    }

    curl_close($curl);
    return $response;
}

// Database connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Increase maximum execution time
set_time_limit(300); // Set the limit to 300 seconds (5 minutes) or adjust as needed

$advertiser_ids = [
            "6834409355886985221",
    "6849315508555087877",
    "6855115968469794821",
    "6855998728214413317",
    "6865493068829687814",
    "6866988619744149509",
    "6891851999818547202",
    "6899711862489759745",
    "6921968764523118593",
    "6921971383404609537",
    "6921973211005517825",
    "6948640903934263297",
    "6955344755718930433",
    "6963504465068474369",
    "6969887628275515394",
    "6972385657234653186",
    "6977674807533944833",
    "6977675476609286146",
    "6980089673263644674",
    "6982010369468301314",
    "6986443961264603137",
    "6987185004195414017",
    "6987185991266091010",
    "6987523793535156226",
    "6990146905661521921",
    "6990147223451336705",
    "6990523369682681858",
    "6992719890658377729",
    "6995312267273207810",
    "6997632780842631169",
    "6999610922658463746",
    "7010623804711895041",
    "7013963033839943681",
    "7015453362212618241",
    "7015454271508381698",
    "7020975993493979137",
    "7020976493895368705",
    "7028090197522808834",
    "7035959633575411714",
    "7049610589609443329",
    "7049610932166688770",
    "7055235417767002113",
    "7057709884808183810",
    "7076302172597649409",
    "7076302662957907969",
    "7077791855630499842",
    "7078912857911394305",
    "7079209589891153922",
    "7080069641871032321",
    "7080072901411520514",
    "7080411099706802177",
    "7084109354709893121",
    "7085336649198059522",
    "7085337830997671938",
    "7088965663192088578",
    "7089004542557159426",
    "7091943990882336770",
    "7094169757398155265",
    "7094170430071767041",
    "7095963940332650498",
    "7101227066019889154",
    "7101227461702189058",
    "7101227749418876930",
    "7102290703102820354",
    "7106009616730865665",
    "7107424029128130561",
    "7112394071921983490",
    "7114577174220357634",
    "7114872987479719938",
    "7114880585046310914",
    "7114881106662440961",
    "7117153924267737090",
    "7117154271711264769",
    "7119882908717858818",
    "7121649978883194882",
    "7121650390008938498",
    "7124182479140945921",
    "7124251908117757953",
    "7125244648691400705",
    "7125245333671608322",
    "7130439741522149378",
    "7130547634820988930",
    "7133010698686283777",
    "7133499509518188545",
    "7134613765445763073",
    "7138704102707429377",
    "7138704875164139522",
    "7141198123937824769",
    "7143434709983412225",
    "7144974873771704322",
    "7149017290556702722",
    "7149020451266707458",
    "7150526096042115074",
    "7151679469432995842",
    "7154589403405352962",
    "7155377199288221697",
    "7156890971496562690",
    "7157984924203532289",
    "7158289773789052930",
    "7163890837858959361",
    "7164603320202559489",
    "7164674333485350913",
    "7166090113032830977",
    "7166090429493018625",
    "7168741783130750978",
    "7186558895341453314",
    "7191332135624687617",
    "7192848516450959361",
    "7195441303302356993",
    "7198538656439730178",
    "7199963777645789186",
    "7199992194751676418",
    "7200976610646917122",
    "7202087555578232833",
    "7203551883024187394",
    "7204764123123515393",
    "7207330221467418626",
    "7207613275817738242",
    "7208779672614617090",
    "7211352274541608962",
    "7213291655745552386",
    "7215153101240598529",
    "7215902697768239105",
    "7218418414975467522",
    "7224038992960946177",
    "7229551331088941058",
    "7231800836798545922",
    "7232178468518166529",
    "7232179286982000641",
    "7233678993206050817",
    "7234345718918430721",
    "7234470375009173506",
    "7239291462414827522",
    "7239294943506923521",
    "7244817679532670977",
    "7244839349701984257",
    "7246227094827565057",
    "7252926135942643713",
    "7255512032466698241",
    "7255514085469585409",
    "7259268109167640577",
    "7259271339717050370",
    "7260040523224727554",
    "7260040949877817345",
    "7260397564304932865",
    "7260397960142340097",
    "7263404722445451265",
    "7263405236172095490",
    "7267095559675117570",
    "7267095840961904642",
    "7267880319603245058",
    "7267880643965566978",
    "7268277361781571586",
    "7268277885604036610",
    "7268278442838212609",
    "7270387634680135682",
    "7273675331794124802",
    "7273678602850336770",
    "7273680052313833474",
    "7273682200288149506",
    "7273807145152905217",
    "7277408630692184066",
    "7277409165222395906",
    "7277409524636631042",
    "7277454425466159105",
    "7278983508327104513",
    "7278985939106447362",
    "7280043642713096194",
    "7286421681472684033",
    "7286791099124039681",
    "7286796300941541377",
    "7287913906121801729",
    "7288175743643942914",
    "7291893404777152514",
    "7299759245908705282",
    "7304611795837272065",
    "7312741294135312385",
    "7315253705350283265",
    "7325273582643183617"
];

$page_size = 100000;

// Iterate through advertiser IDs
foreach ($advertiser_ids as $advertiser_id) {
    // Ensure page_size is within the allowed range
    $page_size = min(max($page_size, 1), 1000);

    $my_args = sprintf(
        '{"advertiser_id": "%s", "page_size": "%s"}',
        $advertiser_id,
        $page_size
    );

    $response = get($my_args);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if data is available
    if ($data === null) {
        echo "Error decoding JSON response for Advertiser ID: $advertiser_id. Response: " . $response . "<br>";
        continue; // Skip to the next advertiser ID
    }

    if (!isset($data['data']['list'])) {
        echo "No data available for Advertiser ID: $advertiser_id. Response: " . print_r($data, true) . "<br>";
        continue; // Skip to the next advertiser ID
    }

    $campaigns = $data['data']['list'];

    // Iterate through campaigns
    foreach ($campaigns as $campaign) {
        $app_promotion_type = isset($campaign['app_promotion_type']) ? $campaign['app_promotion_type'] : '';
        $rf_campaign_type = isset($campaign['rf_campaign_type']) ? $campaign['rf_campaign_type'] : '';

        $campaign_id = $campaign['campaign_id'];

        // Check if the record already exists
        $checkSql = "SELECT * FROM campaigns WHERE campaign_id = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $campaign_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === FALSE) {
            echo "Error checking existing record: " . $stmt->error . "<br>";
        } elseif ($result->num_rows > 0) {
            echo "Record with campaign_id '$campaign_id' already exists. Skipping...<br>";
        } else {
            // Record doesn't exist, proceed with insertion
            $insertSql = "INSERT INTO campaigns (advertiser_id, campaign_id, campaign_name, objective_type, budget, operation_status, objective, secondary_status, create_time, modify_time, app_promotion_type, is_search_campaign, is_smart_performance_campaign, campaign_type, rf_campaign_type, roas_bid, budget_mode)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param(
                "sssssssssssssssss",
                $advertiser_id,
                $campaign_id,
                $campaign['campaign_name'],
                $campaign['objective_type'],
                $campaign['budget'],
                $campaign['operation_status'],
                $campaign['objective'],
                $campaign['secondary_status'],
                $campaign['create_time'],
                $campaign['modify_time'],
                $app_promotion_type,
                $campaign['is_search_campaign'],
                $campaign['is_smart_performance_campaign'],
                $campaign['campaign_type'],
                $rf_campaign_type,
                $campaign['roas_bid'],
                $campaign['budget_mode']
            );

            if ($stmt->execute()) {
                echo "Record inserted successfully.<br>";
            } else {
                echo "Error inserting record: " . $stmt->error . "<br>";
            }
        }
    }
}

// Close database connection
$conn->close();

?>
