<?php

class Email
{
    //@var instance of database class itself
    private $db = null;

    function __construct()
    {
        //Connect to database
        $this->db = Database::getInstance();
    }

    public function getTemplates($email_type)
    {
        //Gets email templates
	$query = "SELECT * FROM email_templates WHERE email_type = :email_type AND active = 1 AND schedule_date < NOW()";
	$result = $this->db->select($query, array('email_type' => $email_type));
	return $result;
    }

    public function getEmails($tid, $send_limit)
    {
        //Get all emails not opted out and who this template has not been sent to yet
        if ($tid > 0 && $send_limit > 0) {			
            $query = "SELECT user_id, first_name, last_name, email FROM users " .
		     "WHERE opt_out = 0 AND users.user_id NOT IN ".
		     "(SELECT user_id FROM sent_emails ".
                     "WHERE template_id = :tid) ".
		     "ORDER BY user_id ASC LIMIT :send_limit";
	    $result = $this->db->select($query, array('tid' => $tid,'send_limit' => $send_limit));

            if (!empty($result)) {
                return $result;
            } else {
                $this->changeActive($tid); //All emails have been sent so update the template as no longer active
                return null;
            }
        }
    }

    public function addSentEmails($add_data, $tid)
    {
        //$add_data is a comma list of list ids built out in the for each email loop.
        $ids = explode(',',$add_data);
        $sql = "INSERT INTO sent_emails (user_id, template_id, date_sent) VALUES ";
        $insertQuery = array();
        $insertData = array();
        foreach ($ids as $id) {
            $insertQuery[] = '(?, ?, ?)';
            $insertData[] = $id;
            $insertData[] = $tid;
            $insertData[] = date("Y-m-d H:i:s");
        }
        if (!empty($insertQuery)) {
            $sql .= implode(', ', $insertQuery);
            $stmt = $this->db->prepare($sql);
            $stmt->execute($insertData);
        }
    }

    public function changeActive($tid)
    {
        //Set active = 0 for newsletters that have been sent to all email addresses
        $update_details = array("active" => 0);
        $this->db->update("email_templates", $update_details, "unique_id = :tid", array("tid" => $tid));
    }

    public function addBatchRecord($email_type, $sent_count, $server, $start_time, $template_id)
    {
	$this->db->insert('sent_jobs', array(
		"job_type" => $email_type,
		"sent_emails" => $sent_count,
		"server" => $server,
		"template_id" => $template_id,
		"start_time" => $start_time,
		"end_time" => date("Y-m-d H:i:s")
	));
     }

}
