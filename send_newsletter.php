<?php

require 'application/Common.php';
require 'vendor/autoload.php';

$total_sent = 0;
$track_url = SCRIPT_URL.'link.php';
$start_time = date('Y-m-d H:i:s');
$server = e($_GET['server']);
if (empty($server)) {
    $server = DEFAULT_SERVER;
}
$send_limit = n($_GET['limit']);
if (empty($send_limit)) {
    $send_limit = DEFAULT_SEND_LIMIT;
}

// Instantiate the Mailgun SDK with API credentials.
use Mailgun\Mailgun;
$mg = new Mailgun(MAILGUN_KEY);

// Instantiate the Sendgrid SDK with API credentials.
$sendgrid = new SendGrid(SENDGRID_KEY);

$sendEmail = new Email();
$email_type = 'newsletter';
$emailTemplates = $sendEmail->getTemplates($email_type); //Get active email templates

foreach ($emailTemplates as $template):
    $tid = $template['unique_id'];
    $email_subject = e($template['email_subject']);
    $html_body = $template['html_body'];
    $text_body = e($template['text_body']);
    $from_name = e($template['from_name']);
    $from_email = e($template['from_email']);
    $bounce_email = e($template['bounce_email']);
    $template_sent = 0;

    // Get list of user emails to send to
    $userEmails = $sendEmail->getEmails($tid, $send_limit);
    $add_data = '';

    foreach ($userEmails as $emails):
        $user_id = $emails['user_id'];

        // Builds out list ids for inserting records into sent_emails table in 1 query
        $add_data .= $user_id.',';

        $first_name = e($emails['first_name']);
        $user_email = e($emails['email']);

        // Find all links in the html template and replace them with tracking urls
        $find_href = 'href="';
        $replace_href = 'href="'.$track_url.'?type=link&uid={uid}&tid={tid}&url=';
        $html_email = str_replace($find_href, $replace_href, $html_body);

        // Open tracking image that uses mod_rewrite in .htaccess to reroute to link.php for recording the open
        $open_bug = '<img src="'.SCRIPT_URL.$user_id.'_'.$tid.'_open.gif">';

        // Replace tags in template
        $html_email = str_replace('{first_name}',ucfirst($first_name), $html_email);
        $html_email = str_replace('{uid}',$user_id, $html_email);
        $html_email = str_replace('{tid}',$tid, $html_email);
        $html_email = str_replace('{open_bug}',$open_bug, $html_email);

        $text_email = str_replace('{first_name}',ucfirst($first_name), $text_body);
        $text_email = str_replace('{uid}',$user_id, $text_email);
        $text_email = str_replace('{tid}',tid, $text_email);

        // If user email is NOT valid this sets send email info to admin so they can clean it from list
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL) === true) {
            $html_email = 'Invalid user email '.$user_email.' ['.$user_id.']. Please fix or archive this from your list';
            $text_email = 'Invalid user email '.$user_email.' ['.$user_id.']. Please fix or archive this from your list';
            $first_name = ADMIN_EMAIL_NAME;
            $member_email = ADMIN_EMAIL;
        }

        // Compose and send message to mailgun api
        if ($server === "mailgun") {
            $mg->sendMessage(DOMAIN_NAME, array(
                'from' => $from_name . ' <' . $from_email . '>',
                'to' => $first_name . ' <' . $user_email . '>',
                'subject' => $email_subject,
                'html' => $html_email,
                'text' => $text_email,
                'o:tracking' => true, //set to false to disable mailgun link re-writing and open tracking.
                'o:tag' => array('email id: ' . $tid, 'uid: ' . $user_id) //Add additional tags to the email header
            ));
        }

        // Compose and send message to sendgrid api
        if ($server === "sendgrid") {
	    $sg_email = new SendGrid\Email();
            $sg_email
                ->setFromName($from_name)
                ->setFrom($from_email)
                ->addTo($user_email)
                ->setSubject($email_subject)
                ->setText($text_email)
                ->setHtml($html_email);

            try {
                $sendgrid->send($sg_email);
            } catch (\SendGrid\Exception $e) {
                echo $e->getCode();
                foreach ($e->getErrors() as $er) {
                    echo $er;
                }
            }
	    unset($sg_email);
            $sg_email = '';
        }

        echo 'Sent to: '.$user_id.'<hr>'; //Writes out a list of ids to screen so you can view progress

        $template_sent++; // Gets total sent for just the current drip template. It is cleared back to 0 in template loop
        $total_sent++; // Keeps running total of emails sent for all active templates

    endforeach;

    // Add sent records to sent_emails table
    if (!empty($add_data)) {
        $add_data = rtrim($add_data, ','); //remove trailing comma from last record
        $sendEmail->addSentEmails($add_data, $tid);
    }

    // Add sent batch info to sent_jobs table for recording sent email batches
    if($template_sent > 0) {
        $sendEmail->addBatchRecord($email_type, $template_sent, $server, $start_time, $tid);
    }
    echo '<hr />'.$email_subject.' ['.$tid.'] Sent: '.$template_sent;

endforeach; // End $templates loop

echo '<hr />Total Sent: '.$total_sent;
