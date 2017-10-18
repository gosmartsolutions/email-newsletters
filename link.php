<?php

require 'application/Common.php';
$recordTracking = new Tracking();

$uid = n($_GET['uid']); //user id who clicked link or opened email
$tid = n($_GET['tid']); //email template id
$url = e($_GET['url']); //url user clicked
$type = e($_GET['type']); //link or open

if (!empty($type) {
    if ($type === "link" && !empty($url)) {
        $recordTracking->addLinkClick($type, $uid, $tid, $url);
        header("Location: " . $url);
    } else {
        $recordTracking->addOpen($type, $uid, $tid);
        header("Location: ".SCRIPT_URL."assets/images/transimage.gif");
    }
}
