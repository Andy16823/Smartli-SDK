# Smartli-SDK
SDK's for the smartli.me api

## PHP SDK
To use the php sdk, you must first add the php files to your project. Then you can use the sdk as follows

'''php
// Include the smartli api sdk
include_once "smartli.php";

// Create the user credentials and an new instance from the sdk api
$userData = new userCredentials("smartli.api.XXX.XXXXXXXXXXXXXX", "XXXXXXXXXXXXXXXXXXXXXXXXXXX");
$smartli = new Smartli($userData);


$result = $smartli->getUrls();
'''