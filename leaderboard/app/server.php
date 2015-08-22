Last login: Thu Jul 23 12:36:48 on ttys000
You have new mail.
raghunadhs-MacBook-Pro:~ raghunadhalokam$ cd desktop
raghunadhs-MacBook-Pro:desktop raghunadhalokam$ ssh -i sportslionaws.pem ubuntu@52.24.178.241
Welcome to Ubuntu 14.04.2 LTS (GNU/Linux 3.13.0-48-generic x86_64)

 * Documentation:  https://help.ubuntu.com/

  System information as of Thu Jul 23 07:06:30 UTC 2015

  System load:  0.0               Processes:           114
  Usage of /:   11.7% of 7.74GB   Users logged in:     1
  Memory usage: 13%               IP address for eth0: 172.31.47.155
  Swap usage:   0%

  Graph this data and manage this system at:
    https://landscape.canonical.com/

  Get cloud support with Ubuntu Advantage Cloud Guest:
    http://www.ubuntu.com/business/services/cloud

106 packages can be updated.
59 updates are security updates.


Last login: Thu Jul 23 07:06:31 2015 from 106.51.130.126
ubuntu@ip-172-31-47-155:~$ cd public_html/
ubuntu@ip-172-31-47-155:~/public_html$ cd Chat-Using-WebSocket-and-PHP-Socket/
ubuntu@ip-172-31-47-155:~/public_html/Chat-Using-WebSocket-and-PHP-Socket$ sudo vim server.php

<?php
$host = '52.24.178.241'; //host
$port = '9000'; //port
$null = NULL; //null var

//Create TCP/IP sream socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//reuseable port
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);

//bind socket to specified host
socket_bind($socket, 0, $port);

//listen to port
socket_listen($socket);

//create & add listning socket to the list
$clients = array($socket);

//start endless loop, so that our script doesn't stop
while (true) {
        //manage multipal connections
        $changed = $clients;
        //returns the socket resources in $changed array
        socket_select($changed, $null, $null, 0, 10);

        //check for new socket
        if (in_array($socket, $changed)) {
                $socket_new = socket_accept($socket); //accpet new socket
                $clients[] = $socket_new; //add socket to client array

                $header = socket_read($socket_new, 1024); //read data sent by the socket
                perform_handshaking($header, $socket_new, $host, $port); //perform websocket handshake

                socket_getpeername($socket_new, $ip); //get ip address of connected socket
                $response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' connected'))); //prepare json data
                send_message($response); //notify all users about new connection
-- INSERT --                                                                                                           1,1           Top
