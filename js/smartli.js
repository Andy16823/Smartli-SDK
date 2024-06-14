class UserCredentials {

    // Constructor to initialize user credentials
    constructor(appId, appSecret) {
        this.appId = appId;
        this.appSecret = appSecret;
    }

    // Method to get the application ID
    getAppId() {
        return this.appId;
    }

    // Method to get the application secret
    getAppSecret() {
        return this.appSecret;
    }

}


class Smartli {

    // Constructor to initialize Smartli API instance with user credentials
    constructor(userCredentials) {
        this.userCredentials = userCredentials;
        this.api_url = "https://smartli.me/api-system/v2/index.php?r=";
    }

    // Method to convert string to hexadecimal
    bin2Hex(str) {
        var arr1 = [];

        for (var n = 0, l = str.length; n < l; n++) {
            var hex = Number(str.charCodeAt(n)).toString(16);
            arr1.push(hex);
        }
        return arr1.join('');
    }

    // Method to create full API endpoint
    createEndpoint(request) {
        return this.api_url + request;
    }

    // Method to send HTTP request to Smartli API
    async sendRequest(url, data) {
        const urlEncodedData = new URLSearchParams(data).toString();
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: urlEncodedData,
        });

        const responseText = await response.text();
        return responseText;
    }

    // Method to get shortened URLs
    async getUrls() {
        const data = {
            app_id: this.userCredentials.getAppId(),
            app_secret: this.userCredentials.getAppSecret()
        };

        const result = await this.sendRequest(this.createEndpoint("get_urls"), data);
        const parsedResult = JSON.parse(result);

        if(parsedResult.success === true) {
            return parsedResult.data;
        }
        else {
            console.error(parsedResult.message);
            return false;
        }
    }

    // Method to create a shortened URL
    async createUrl(url) {
        const data = {
            app_id: this.userCredentials.getAppId(),
            app_secret: this.userCredentials.getAppSecret(),
            url: this.bin2Hex(url)
        };

        const result = await this.sendRequest(this.createEndpoint("create_url"), data);
        const parsedResult = JSON.parse(result);

        if(parsedResult.success === true) {
            return parsedResult.data;
        }
        else {
            console.error(parsedResult.message);
            return false;
        }
    }

    // Method to edit a shortened URL
    async editUrl(urlId, url) {
        const data = {
            app_id: this.userCredentials.getAppId(),
            app_secret: this.userCredentials.getAppSecret(),
            url_id: urlId,
            redirection_url: this.bin2Hex(url)
        };

        const result = await this.sendRequest(this.createEndpoint("edit_url"), data);
        const parsedResult = JSON.parse(result);

        if(parsedResult.success === true) {
            return true;
        }
        else {
            console.error(parsedResult.message);
            return false;
        }
    }

    // Method to delete a shortened URL
    async deleteUrl(urlId) {
        const data = {
            app_id: this.userCredentials.getAppId(),
            app_secret: this.userCredentials.getAppSecret(),
            url_id: urlId
        };

        const result = await this.sendRequest(this.createEndpoint("delete_url"), data);
        const parsedResult = JSON.parse(result);

        if(parsedResult.success === true) {
            return true;
        }
        else {
            console.error(parsedResult.message);
            return false;
        }
    }
}