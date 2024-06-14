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

## JS SDK

To use the js SDK, follow these stepps:

1. Add the JS file to your project.
2. Use the SDK as shown in the example below:

```js
// Create the user credentinals for the api and the sdk class
const userCredentials = new UserCredentials("smartli.api.XXX.XXXXXXXXXXX", "XXXXXXXXXXXXXXXXXXXXXXXXXXX");
const smartli = new Smartli(userCredentials);

// Get your URLs
async function fetchData() {
    let urls = await smartli.getUrls();
    const keys = Object.keys(urls);

    for(var i in keys) {
        var keyName = keys[i];
        var key = urls[keyName];
        console.log(keyName);
    }
}
fetchData();

// Create url
async function fetchData() {
    let result = await smartli.createUrl("https://smartli.me");
    console.log(result);
}
fetchData();

// Edit URL
async function fetchData() {
    let result = await smartli.editUrl(7293, "https://smartli.me");
    console.log(result);
}
fetchData();

// Delete URL
async function fetchData() {
    let result = await smartli.deleteUrl(7293);
    console.log(result);
}
fetchData();
```