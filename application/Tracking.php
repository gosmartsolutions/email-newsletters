<?php

class Tracking
{
    //@var instance of database class itself
    private $db = null;

    function __construct()
    {
        //Connect to database
        $this->db = Database::getInstance();
    }

    public function getIP()
    {
        $ip = getenv('REMOTE_ADDR');
        $host = gethostbyaddr($ip);
        return array('ip' => $ip, 'host' => $host);
    }

    public function addLinkClick($type, $uid, $tid, $url)
    {
        $ipInfo = $this->getIP();
        $this->db->insert('email_tracking', array(
			"type" => $type,
			"user_id" => $uid,
			"template_id" => $tid,
            "url" => $url,
			"ip" => $ipInfo['ip'],
			"host" => $ipInfo['host'],
			"date_added" => date("Y-m-d H:i:s")
		));
    }

    public function addOpen($type, $uid, $tid)
    {
        $ipInfo = $this->getIP();
        $this->db->insert('email_tracking', array(
            "type" => $type,
            "user_id" => $uid,
            "template_id" => $tid,
            "ip" => $ipInfo['ip'],
            "host" => $ipInfo['host'],
            "date_added" => date("Y-m-d H:i:s")
        ));
    }
}
