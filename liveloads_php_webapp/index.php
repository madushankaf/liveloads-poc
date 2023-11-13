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

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="column">
          
            <label for="ship_notice_date">Ship Notice Date:</label>
            <input type="text" id="ship_notice_date" name="ship_notice_date"><br><br>
            <label for="ship_notice_time">Ship Notice Time:</label>
            <input type="text" id="ship_notice_time" name="ship_notice_time"><br><br>
            <label for="ship_notice_timezone">Ship Notice Timezone:</label>
            <input type="text" id="ship_notice_timezone" name="ship_notice_timezone"><br><br>
            <label for="hierarchical_id">Hierarchical ID:</label>
            <input type="text" id="hierarchical_id" name="hierarchical_id"><br><br>
            <label for="hierarchical_parent_id">Hierarchical Parent ID:</label>
            <input type="text" id="hierarchical_parent_id" name="hierarchical_parent_id"><br><br>
            <label for="hierarchical_level_code">Hierarchical Level Code:</label>
            <input type="text" id="hierarchical_level_code" name="hierarchical_level_code"><br><br>
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id"><br><br>
            <label for="product_description">Product Description:</label>
            <input type="text" id="product_description" name="product_description"><br><br>
            <label for="product_type">Product Type:</label>
            <input type="text" id="product_type" name="product_type"><br><br>
            <label for="product_code">Product Code:</label>
            <input type="text" id="product_code" name="product_code"><br><br>
        </div>
        <div class="column">
            <label for="quantity_shipped">Quantity Shipped:</label>
            <input type="text" id="quantity_shipped" name="quantity_shipped"><br><br>
            <label for="packaging_info">Packaging Info:</label>
            <input type="text" id="packaging_info" name="packaging_info"><br><br>
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight"><br><br>
            <label for="weight_unit">Weight Unit:</label>
            <input type="text" id="weight_unit" name="weight_unit"><br><br>
            <label for="item_description">Item Description:</label>
            <input type="text" id="item_description" name="item_description"><br><br>
            <label for="characteristic_code">Characteristic Code:</label>
            <input type="text" id="characteristic_code" name="characteristic_code"><br><br>
            <label for="additional_info">Additional Info:</label>
            <input type="text" id="additional_info" name="additional_info"><br><br>
            <label for="info_qualifier">Info Qualifier:</label>
            <input type="text" id="info_qualifier" name="info_qualifier"><br><br>
            <label for="entity_identifier_code">Entity Identifier Code:</label>
            <input type="text" id="entity_identifier_code" name="entity_identifier_code"><br><br>
            <label for="name">Entity Identifier Name:</label>
            <input type="text" id="name" name="name"><br><br>
            <label for="identification_code">Identification Code:</label>
            <input type="text" id="identification_code" name="identification_code"><br><br>
            <label for="identification_qualifier">Identification Qualifier:</label>
            <input type="text" id="identification_qualifier" name="identification_qualifier"><br><br>
            <label for="number_of_line_items">Number of Line Items:</label>
            <input type="text" id="number_of_line_items" name="number_of_line_items"><br><br>
            <label for="hash_total">Hash Total:</label>
            <input type="text" id="hash_total" name="hash_total"><br><br>
            <label for="weight_total">Weight Total:</label>
            <input type="text" id="weight_total" name="weight_total"><br><br>
            <label for="hash_total">Weight Unit:</label>
            <input type="text" id="weight_unit" name="weight_unit"><br><br>
            <label for="number_of_included_segments">Number of Included Segments:</label>
            <input type="text" id="number_of_included_segments" name="number_of_included_segments"><br><br>
            <label for="transaction_set_control_number">Transaction Set Control Number:</label>
            <input type="text" id="transaction_set_control_number" name="transaction_set_control_number"><br><br>
        </div>
        <input type="submit" value="Submit">

    </form>
    <?php } ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
        $fields = ""; // Declare the $fields variable
        $fields .= "ST*856*0001*005010X12~";
        $fields .= "BSN*".$_POST["ship_notice_date"] . "*";
        $fields .= $_POST["ship_notice_time"] . "*";
        $fields .= $_POST["ship_notice_timezone"] . "~";
        $fields .= "HL*".$_POST["hierarchical_id"] . "*";
        $fields .= $_POST["hierarchical_parent_id"] . "*";
        $fields .= $_POST["hierarchical_level_code"] . "~";
        $fields .= "LIN*".$_POST["product_id"] . "*";
        $fields .= $_POST["product_description"] . "*";
        $fields .= $_POST["product_type"] . "*";
        $fields .= $_POST["product_code"] . "~";
        $fields .= "SN1*".$_POST["quantity_shipped"] . "*";
        $fields .= $_POST["packaging_info"] . "*";
        $fields .= $_POST["weight"] . "*";
        $fields .= $_POST["weight_unit"] . "~";
        $fields .= "PID*".$_POST["item_description"] . "*";
        $fields .= $_POST["characteristic_code"] . "*";
        $fields .= $_POST["additional_info"] . "*";
        $fields .= $_POST["info_qualifier"] . "~";
        $fields .= "N1*".$_POST["entity_identifier_code"] . "*";
        $fields .= $_POST["name"] . "*";
        $fields .= $_POST["identification_code"] . "*";
        $fields .= $_POST["identification_qualifier"] . "~";
        $fields .= $_POST["number_of_line_items"] . "*";
        $fields .= "CTT*".$_POST["hash_total"] . "*";
        $fields .= $_POST["hash_total"] . "*";
        $fields .= $_POST["weight_total"] . "*";
        $fields .= $_POST["weight_unit"] . "~";
        $fields .= "SE*".$_POST["number_of_included_segments"] . "*";
        $fields .= $_POST["transaction_set_control_number"] . "~";

        echo $fields;
    } ?>
</body>
</html>