function getXMLHTTPRequest() {
    var request = false;
    try {
        request = new XMLHttpRequest();
    } catch (error) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (error) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (error) {
                request = false;
            }
        }
    }
    return request;
}
