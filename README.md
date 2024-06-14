# Smartli-SDK

SDKs for the smartli.me API

## PHP SDK

To use the PHP SDK, follow these steps:

1. Add the PHP files to your project.
2. Use the SDK as shown in the example below:

```php
// Include the Smartli API SDK
include_once "smartli.php";

// Create user credentials and a new instance of the SDK API
$userData = new UserCredentials("smartli.api.XXX.XXXXXXXXXXXXXX", "XXXXXXXXXXXXXXXXXXXXXXXXXXX");
$smartli = new Smartli($userData);

// Retrieve URLs
$result = $smartli->getUrls();
```