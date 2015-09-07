<?php
include('AWSSDKforPHP/sdk.class.php');

function amazonSesEmail($to, $subject, $message)
{
    $amazonSes = new AmazonSES(array(
        'key' => 'AKIAIUBQUFTDXXNOUODQ',
        'secret' => '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'
    ));
 
    $response = $amazonSes->send_email('noreply@sportslion.com',
        array('raghunadh2006ster@outlook.com' => array($to)),
        array(
            'Subject.Data' => 'HIII',
            'Body.Text.Data' => 'Tesct mail',
        )
    );
    if (!$response->isOK())
    {
        // handle error
    }
}
?>
