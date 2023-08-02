<?php 
function error($pCode = 500, $pMessage = 'An unknown Error occured.', $pException = null) {
    global $config;
    // log error
    $errorMessage = date('Y-m-d H:i:s') . ' ' . trim($pMessage);
    if(null !== $pException) {
        $errorMessage .= PHP_EOL . '     Exception: ' . $pException->getMessage();
    }
    // send response
    if(!headers_sent()) {
        $responseCodes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Authorization Required',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Time-out',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Large',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'No code',
            426 => 'Upgrade Required',
            500 => 'Internal Server Error',
            501 => 'Method Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Temporarily Unavailable',
            504 => 'Gateway Time-out',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            510 => 'Not Extended'
        );

        if(!isset($responseCodes[$pCode])) {
            $responseCodes = 500;
        }

        header('HTTP/1.1 500 ' . $responseCodes[$pCode]);
    }
    echo '<h1>DIWA Error ' . $pCode . ' (' . $responseCodes[$pCode] . ')</h1>';
    echo '<p>' . $pMessage . '</p>';


    exit;
}
function addJWTHeaderToRequest() {
    if (isset($_COOKIE['jwt_token'])) {
        $jwt_token = $_COOKIE['jwt_token'];
        header("Authorization: Bearer " . $jwt_token);
    } else {
        // Kullanıcı oturum açmamışsa veya JWT tokenı yoksa, giriş sayfasına yönlendirme yapabilirsiniz.
        header("Location: login");
        exit;
    }
}

?>