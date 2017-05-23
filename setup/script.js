    function getXMLHttpRequestObject() {
        var xmlobj;
        try {
            //Native support: Gecko,Opera,IE7,Safari etc
            xmlobj = new XMLHttpRequest();
        } catch(e) {
            try {
                //ActiveX support: IE6
                xmlobj = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                try {
                    //ActiveX support: IE5.5,IE5
                    xmlobj = new ActiveXObject("Microsoft.XMLHTTP");
                } catch(e) {
                    //Ajax not supported
                    xmlobj = null;
                    return false;
                }
            }
        }
        return xmlobj;
    }

    //Request url content
    function requestContent(url) {
        xmlHttpRequest.open("GET", url, true);
        xmlHttpRequest.onreadystatechange = statusListener;
        xmlHttpRequest.send(null);
    }

    function statusListener() {
        if (xmlHttpRequest.readyState == 4) {
            if (xmlHttpRequest.status == 200) {
                document.getElementById('modrewcont').innerHTML = '<span class="yes">Available</span';
                var today = new Date();
                var the_cookie_date = new Date(today.getTime() + (1000 * 60 * 60));
                var the_cookie = "modrew=true";
                var the_cookie = the_cookie + ";expires=" + the_cookie_date;
                document.cookie = the_cookie;
            } else {
                document.getElementById('modrewcont').innerHTML = '<span class="no">Unavailable</span>';
                var today = new Date();
                var the_cookie_date = new Date(today.getTime() + (1000 * 60 * 60));
                var the_cookie = "modrew=false";
                var the_cookie = the_cookie + ";expires=" + the_cookie_date;
                document.cookie = the_cookie;
            }
        }
    }

    xmlHttpRequest = getXMLHttpRequestObject();
    document.onload = requestContent("modrewrite.test?nocache=" + new Date().getTime());