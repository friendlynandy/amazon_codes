<?php
include('AWSSDKforPHP/sdk.class.php');


amazonSesEmail('raghunadh2006ster@me.com','bka','sadfsaf');

function amazonSesEmail($to, $subject, $message)
{
    $amazonSes = new AmazonSES(array(
        'key' => 'AKIAIUBQUFTDXXNOUODQ',
        'secret' => '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'
    ));
 
    $response = $amazonSes->send_email('noreply@sportslion.com',
        array('ToAddresses' => array($to)),
        array(
            'Subject.Data' => $subject,
            'Body.Text.Data' => $message,
        )
    );
    if (!$response->isOK())
    {
       echo "error";
    }
   echo success;
}
?>
