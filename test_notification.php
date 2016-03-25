<?php
$message = "Test of Cron Jon".rand();
						$notification = 1;
						$payload = '{
						                 "aps" :
						                 
						                        {  "alert" : "'.$message.'",
						                           "badge" : '.$notification.',
						                           "sound" : "default"
						                        }
						            }';
						$ctx = stream_context_create();
						stream_context_set_option($ctx,'ssl','local_cert','finalsportslionproduction.pem');
						stream_context_set_option($ctx,'ssl','passphrase','');
						$fp = stream_socket_client('ssl://gateway.push.apple.com:2195',$err,$errstr,60,STREAM_CLIENT_CONNECT,$ctx);
						if(!$fp)
						{
						    print "Failed to connect $err $errstrn";
						    return;
						}
						else
						{
						   print "Notification sent";
						}
						   $deviceToken = 5554a82afe5156af0a19a3c1039f780bc6af4fed468a269db93c149c822c218a;
						   $msg = chr (0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
						   print "sending message :" . $payload . "n";
						   fwrite($fp, $msg);
						   
						   ?>
