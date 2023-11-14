<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiveLoads App</title>
</head>
<body>
<h1><?php echo "LiveLoads App"; ?></h1>
<?php if ($_SERVER["REQUEST_METHOD"] == "GET") { ?>

    <form method="POST" action="<?php echo $_SERVER[
        "PHP_SELF"
    ]; ?>" enctype="multipart/form-data">
    <!-- <div class="columns">
        <div class="column">
            <label for="ship_notice_date">Ship Notice Date:</label>
            <input type="text" id="ship_notice_date" name="ship_notice_date" value="2023-01-01"><br><br>
            
            <label for="ship_notice_time">Ship Notice Time:</label>
            <input type="text" id="ship_notice_time" name="ship_notice_time" value="12:00:00"><br><br>
            
            <label for="ship_notice_timezone">Ship Notice Timezone:</label>
            <input type="text" id="ship_notice_timezone" name="ship_notice_timezone" value="UTC-05:00"><br><br>
            
            <label for="hierarchical_id">Hierarchical ID:</label>
            <input type="text" id="hierarchical_id" name="hierarchical_id" value="123"><br><br>
            
            <label for="hierarchical_parent_id">Hierarchical Parent ID:</label>
            <input type="text" id="hierarchical_parent_id" name="hierarchical_parent_id" value="456"><br><br>
            
            <label for="hierarchical_level_code">Hierarchical Level Code:</label>
            <input type="text" id="hierarchical_level_code" name="hierarchical_level_code" value="A"><br><br>
            
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" value="789"><br><br>
            
            <label for="product_description">Product Description:</label>
            <input type="text" id="product_description" name="product_description" value="Sample Product"><br><br>
            
            <label for="product_type">Product Type:</label>
            <input type="text" id="product_type" name="product_type" value="Type-A"><br><br>
            
            <label for="product_code">Product Code:</label>
            <input type="text" id="product_code" name="product_code" value="P-123"><br><br>
        </div>

        <div class="column">
            <label for="quantity_shipped">Quantity Shipped:</label>
            <input type="text" id="quantity_shipped" name="quantity_shipped" value="100"><br><br>
            
            <label for="packaging_info">Packaging Info:</label>
            <input type="text" id="packaging_info" name="packaging_info" value="Box"><br><br>
            
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" value="10.5"><br><br>
            
            <label for="weight_unit">Weight Unit:</label>
            <input type="text" id="weight_unit" name="weight_unit" value="lbs"><br><br>
            
            <label for="item_description">Item Description:</label>
            <input type="text" id="item_description" name="item_description" value="Description"><br><br>
            
            <label for="characteristic_code">Characteristic Code:</label>
            <input type="text" id="characteristic_code" name="characteristic_code" value="X1"><br><br>
            
            <label for="additional_info">Additional Info:</label>
            <input type="text" id="additional_info" name="additional_info" value="Additional Information"><br><br>
            
            <label for="info_qualifier">Info Qualifier:</label>
            <input type="text" id="info_qualifier" name="info_qualifier" value="Q1"><br><br>
            
            <label for="entity_identifier_code">Entity Identifier Code:</label>
            <input type="text" id="entity_identifier_code" name="entity_identifier_code" value="E-123"><br><br>
            
            <label for="name">Entity Identifier Name:</label>
            <input type="text" id="name" name="name" value="Entity Name"><br><br>
        </div>

        <div class="column">
            <label for="identification_code">Identification Code:</label>
            <input type="text" id="identification_code" name="identification_code" value="ID-789"><br><br>
            
            <label for="identification_qualifier">Identification Qualifier:</label>
            <input type="text" id="identification_qualifier" name="identification_qualifier" value="Q-456"><br><br>
            
            <label for="number_of_line_items">Number of Line Items:</label>
            <input type="text" id="number_of_line_items" name="number_of_line_items" value="5"><br><br>
            
            <label for="hash_total">Hash Total:</label>
            <input type="text" id="hash_total" name="hash_total" value="ABC123"><br><br>
            
            <label for="weight_total">Weight Total:</label>
            <input type="text" id="weight_total" name="weight_total" value="50.2"><br><br>
            
            <label for="number_of_included_segments">Number of Included Segments:</label>
            <input type="text" id="number_of_included_segments" name="number_of_included_segments" value="3"><br><br>
            
            <label for="transaction_set_control_number">Transaction Set Control Number:</label>
            <input type="text" id="transaction_set_control_number" name="transaction_set_control_number" value="TS-789"><br><br>
        </div>
    </div>
    <input type="submit" value="Submit"> -->
    Upload an EDI file:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload EDI File" name="submit">
</form>


    <?php } ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        if (
            isset($_FILES["file"]) &&
            $_FILES["file"]["error"] == UPLOAD_ERR_OK
        ) {
            $uploadedFile = $_FILES["file"]["tmp_name"];

            // Read the content of the file
            $fileContent = file_get_contents($uploadedFile);
            echo "<div>";
            echo "<div>";
            echo "File Content - EDI String:\n";
            echo "</div>";
            echo $fileContent;
            echo "\n";
            echo "</div>";
    
            $clientId = getenv("CLIENT_ID");
            $clientSecret = getenv("CLIENT_SECRET");
            $credentials = base64_encode($clientId . ":" . $clientSecret);
            $postData = [
                "grant_type" => "client_credentials",
            ];
            $options = [
                "http" => [
                    "header" =>
                        "Content-type: application/x-www-form-urlencoded\r\n" .
                        "Authorization: Basic " .
                        $credentials .
                        "\r\n",
                    "method" => "POST",
                    "content" => http_build_query($postData),
                ],
            ];
            $context = stream_context_create($options);
            $accessToken = file_get_contents(
                "https://api.asgardeo.io/t/poc4liveloads/oauth2/token",
                false,
                $context
            );
            $accessToken = json_decode($accessToken)->access_token;
    
            // Use the $accessToken as needed
    
            $optionsForApi = [
                "http" => [
                    "header" =>
                        "text/plain\r\n" .
                        "Authorization: Bearer " .
                        $accessToken .
                        "\r\n",
                    "method" => "POST",
                    "content" => $fileContent,
                ],
            ];
            $contextForApiCall = stream_context_create($optionsForApi);
            $shippingNoticeSaved = file_get_contents(
                "https://8d25823b-969a-43a8-84ae-b71755f068b7-dev.e1-us-east-azure.choreoapis.dev/ftyz/liveloads-edi-proxy/endpoint-8090-8b1/v1/ShipNoticeManifest",
                false,
                $contextForApiCall
            );
    
            echo "<div>";
            echo "<div>";
            echo "Shipping Notice Saved:\n";
            echo "</div>";
            echo "<pre>" . json_encode($shippingNoticeSaved, JSON_PRETTY_PRINT) . "</pre>";
            echo "\n";
            echo "</div>";

        } else {
            echo "Error uploading file.";
        }
        // collect value of input field
        $fields = ""; // Declare the $fields variable
        // $fields .= "ST*856*0001*005010X12~";
        // $fields .= "BSN*".$_POST["ship_notice_date"] . "*";
        // $fields .= $_POST["ship_notice_time"] . "*";
        // $fields .= $_POST["ship_notice_timezone"] . "~";
        // $fields .= "HL*".$_POST["hierarchical_id"] . "*";
        // $fields .= $_POST["hierarchical_parent_id"] . "*";
        // $fields .= $_POST["hierarchical_level_code"] . "~";
        // $fields .= "LIN*".$_POST["product_id"] . "*";
        // $fields .= $_POST["product_description"] . "*";
        // $fields .= $_POST["product_type"] . "*";
        // $fields .= $_POST["product_code"] . "~";
        // $fields .= "SN1*".$_POST["quantity_shipped"] . "*";
        // $fields .= $_POST["packaging_info"] . "*";
        // $fields .= $_POST["weight"] . "*";
        // $fields .= $_POST["weight_unit"] . "~";
        // $fields .= "PID*".$_POST["item_description"] . "*";
        // $fields .= $_POST["characteristic_code"] . "*";
        // $fields .= $_POST["additional_info"] . "*";
        // $fields .= $_POST["info_qualifier"] . "~";
        // $fields .= "N1*".$_POST["entity_identifier_code"] . "*";
        // $fields .= $_POST["name"] . "*";
        // $fields .= $_POST["identification_code"] . "*";
        // $fields .= $_POST["identification_qualifier"] . "~";
        // $fields .= "CTT*".$_POST["number_of_line_items"] . "*";
        // $fields .= $_POST["hash_total"] . "*";
        // $fields .= $_POST["weight_total"] . "*";
        // $fields .= $_POST["weight_unit"] . "~";
        // $fields .= "SE*".$_POST["number_of_included_segments"] . "*";
        // $fields .= $_POST["transaction_set_control_number"] . "~";



        // Use the $accessToken as needed
    } ?>
</body>
</html>