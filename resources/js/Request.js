function sendRequest(endpoint, data) {

    return new Promise(function (resolve, reject) {
        let request = new XMLHttpRequest();
        request.open("POST","http://localhost/Opportunity/api/v1"+endpoint, true);
        request.setRequestHeader("Content-Type", "application/json");
        //request.responseType = 'json';
        request.onload = function () {
            if (request.status >= 200 && request.status < 300) {
                if (isJson(request.response)) {
                    let response = JSON.parse(request.response);
                    resolve(response);
                }
                else {
                    console.error(request.response);
                }
            }
            else {
                reject({
                    error: request.error
                });
            }
        };
        request.onerror = function () {
            reject({
                error: request.error
            });
        };
        request.send(JSON.stringify(data));
    });

    function isJson(str) {
        try {
            JSON.parse(str);
        }
        catch (e) {
            return false;
        }
        return true;
    }
}