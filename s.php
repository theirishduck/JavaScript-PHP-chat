<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require 'config.php';
require 'php/client.php';
require 'php/server.php';

$token = md5(session_id());
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// incorrect DB credentials
if ($db->connect_error) {
  die('Connect Error (' . $db->connect_errno . ') '. $db->connect_error);
}

$client = new Chat\Client();
$server = new Chat\Server();

if ( array_key_exists('action', $_POST) ) {
  
  switch ( $_POST['action'] ) {
    /* user connecting */
    case 'connect':
      $client->GetToken();
    break;
    /* get room list */
    case 'refresh_rooms':
      $server->RefreshRooms();
    break;
    /* new message */
    case 'send_message':
      $client->SendMessage();
    break;
    /* list messages from room */
    case 'refresh_messages':
      $server->RefreshMessages();
    break;
  }
  
}