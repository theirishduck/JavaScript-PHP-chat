<?php
namespace Chat;
use mysqli;

class Server {
  private $db;
  
  /* set private variables */
  public function __construct() {
    $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  }
  
  /* Refresh room list */
  public function RefreshRooms() {
    $res = array();
    
    $stmt = $this->db->prepare('SELECT id, name FROM c_rooms');
    $stmt->execute();
    $stmt->bind_result($id, $name);
      
    while ( $stmt->fetch() ) {
      $res[$id] = $name;
    }
     
    $stmt->close();
     
    echo json_encode($res);
    exit;
  }
  
  /* get the latest messages */
  public function RefreshMessages() {
    $res = array();
    $stmt = $this->db->prepare('SELECT id, nickname, message, created FROM c_messages WHERE room_id = ? ORDER BY created DESC LIMIT 10');
    
    if ( ! $stmt->bind_param('i', $_POST['room']) )
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    
    if ( ! $stmt->execute() )
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      
    $stmt->bind_result($id, $nickname, $message, $created);
    
    while ( $stmt->fetch() ) {
      $res[$id] = $nickname.'<span class="when">('.date('H:i', $created).')</span>: '.$message;
    }
    
    $stmt->close();
    
    echo json_encode($res);
  }
   
}