Last login: Thu Jul 23 12:38:22 on ttys000
You have new mail.
raghunadhs-MacBook-Pro:~ raghunadhalokam$ cd desktop
raghunadhs-MacBook-Pro:desktop raghunadhalokam$ ssh -i sportslionaws.pem ubuntu@52.24.178.241
Welcome to Ubuntu 14.04.2 LTS (GNU/Linux 3.13.0-48-generic x86_64)

 * Documentation:  https://help.ubuntu.com/

  System information as of Thu Jul 23 07:08:10 UTC 2015

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


Last login: Thu Jul 23 07:08:10 2015 from 106.51.130.126
ubuntu@ip-172-31-47-155:~$ cd /..
ubuntu@ip-172-31-47-155:/$ ls
bin   dev  home        lib    lost+found  mnt  proc  run   srv  tmp  var
boot  etc  initrd.img  lib64  media       opt  root  sbin  sys  usr  vmlinuz
ubuntu@ip-172-31-47-155:/$ cd var/www/html
ubuntu@ip-172-31-47-155:/var/www/html$ ls
amazon_codes  client1.php
ubuntu@ip-172-31-47-155:/var/www/html$ sudo vim client1.php

<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<style type="text/css">
<!--
.chat_wrapper {
        width: 500px;
        margin-right: auto;
        margin-left: auto;
        background: #CCCCCC;
        border: 1px solid #999999;
        padding: 10px;
        font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
}
.chat_wrapper .message_box {
        background: #FFFFFF;
        height: 150px;
        overflow: auto;
        padding: 10px;
        border: 1px solid #999999;
}
.chat_wrapper .panel input{
-- INSERT --                                                  1,1           Top
