<?php
namespace Chat;
use mysqli;

class Client {
  private $token;
  private $db;
  
  /* set private variables */
  public function __construct() {
    $this->token = md5(session_id());
    $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    $this->Init();
  }
  
  /* initialize client */
  private function Init() {
    // user already in database?
    $stmt = $this->db->prepare('SELECT COUNT(token) as token FROM c_people WHERE token = ?');
    $stmt->bind_param('s', $this->token);
    $stmt->execute();
    
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();
    
    // add new user
    if ( $result == 0 ) {
      $name = 'person';
      $time = time();
      
      if ( ! ($stmt = $this->db->prepare('INSERT INTO c_people(token, name, last_activity) VALUES (?, ?, ?)')) ) {
        echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
      }
      
      if ( ! $stmt->bind_param('ssi', $this->token, $name, $time) ) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      }
      
      if ( ! $stmt->execute() ) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      }
      
      $stmt->close();
    }
  }
  
  /* get user's token */
  public function GetToken() {
    echo json_encode( array('token' => $this->token) );
    exit;
  }
  
  /* Send new message in room */
  public function SendMessage() {
    $stmt = $this->db->prepare('INSERT INTO c_messages(token, room_id, message, nickname, created) VALUES (?, ?, ?, ?, ?)');
    if ( ! $stmt->bind_param('sissi', $this->token, $_POST['room'], $_POST['message'], $_POST['nick'], time()) )
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    if ( ! $stmt->execute() )
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    
    echo json_encode(array('status' => 1));
    $stmt->close();
    exit;
  }
  
}