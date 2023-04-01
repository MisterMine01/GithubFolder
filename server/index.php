<?php

include_once __DIR__ . "/core/loader.php";

use pcjs\core\PCJsApi;

$api = new PCJsApi();
$q = new pcjs\core\Query($_GET, $_POST);
$r = $api->load_entry($q);

if ($r->getHeader() == null) {
    header("Content-Type: application/json");
} else {
    foreach ($r->getHeader() as $header) {
        header($header);
    }
}
echo $r->getContent();