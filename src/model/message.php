<?php
// query sql: 
 
// CREATE TABLE IF NOT EXISTS messages(
//  `id` int AUTO_INCREMENT,
//  `senderId` int NOT NULL,
//  `receiverId` int NOT NULL,
//  `text` varchar(140),
//  `creationDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
//  `read` tinyint(1),
//  PRIMARY KEY (id),
//  FOREIGN KEY (senderId) REFERENCES users(id),
//  FOREIGN KEY (receiverId) REFERENCES users(id)
//  );

class message extends activeRecord {
    
    private $sendreId;
    private $receiverId;
    private $text;
    private $creationDate;
    private $read;
    
    public function getId() {
        return $this->id;}   
    
    public function getSenderId() {
        return $this->sendreId;}
        
    public function getReceiverId() {
        return $this->receiverId;}    

    public function getText() {
        return $this->text;}

    public function getCreationDate() {
        return $this->creationDate;}
        
    public function getRead() {
        return $this->read;}    
    
    public function setSenderId($senderId) {
        $this->sendreId = $senderId;}
        
    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;}    

    public function setText($text) {
        $this->text = $text;}

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;}
        
    public function setRead($read) {
        $this->read = $read;}    

    public function __construct() {
        parent::__construct();
        $this->id = -1;
        $this->sendreId = null;
        $this->receiverId = null;
        $this->text = '';
        $this->creationDate = null;
        $this->read = null;
    }

    public function save(){
        self::connect();
        if (self::$db->conn != null) {
            if ($this->id == -1) {
                $sql = "INSERT INTO messages (senderId, receiverid, text, creationDate,"
                        . " read) values (:senderId, :receiverId, :text, :creationDate :read)";
                $stmt = self::$db->conn->prepare($sql);
                $result = $stmt->execute([
                    'senderId' => $this->senderId,
                    'receiverid' => $this->receiverid,
                    'text' => $this->text,
                    'creationDate' => $this->creationDate,
                    'read' => $this->read,
                ]);

                if ($result == true) {
                    $this->id = self::$db->conn->lastInsertId();
                    return true;
                } else {
                    echo self::$db->conn->error;
                }
            } else {
                $sql = "UPDATE messages SET senderId = :senderId, receiverId= :receiverId"
                        . " text = :text, creationDate = :creationDate read=:read WHERE id = :id";
                $stmt = self::$db->conn->prepare($sql);
                $result = $stmt->execute([
                    'senderId' => $this->senderId,
                    'receiverid' => $this->receiverid,
                    'text' => $this->text,
                    'creationDate' => $this->creationDate,
                    'read' => $this->read,
                ]);

                if ($result == true) {
                    return true;
                }
            }
        } else {
            echo "Brak polaczenia\n";
        }
        return false;
    }
    
    static public function loadById($id){
        self::connect();
        $sql = "SELECT * FROM messages WHERE id=:id";
        $stmt = self::$db->conn->prepare($sql);
        $result = $stmt->execute([ 'id' => $id ]);
        if ($result && $stmt->rowCount() >= 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedMessage = new messages();
            $loadedMessage->id = $row['id'];
            $loadedMessage->senderId = $row['senderId'];
            $loadedMessage->receiverid = $row['receiverid'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->creationDate = $row['creationDate'];
            $loadedMessage->read = $row['read'];
            return $loadedMessage;
        }
        return null;
    } 
    
    static public function loadAll(){
        self::connect();
        $sql = "SELECT * FROM messages ORDER BY creationDate DESC";
        $result = self::$db->conn->query($sql);
        $returnTable = [];
        if ($result !== false && $result->rowCount() > 0) {
            foreach ($result as $row){
                $loadedMessage = new messages();
                $loadedMessage->id = $row['id'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverid = $row['receiverid'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->creationDate = $row['creationDate'];
                $loadedMessage->read = $row['read'];
                $returnTable[] = $loadedUser;
            }
        }
        return $returnTable;
    }
    
    public static function loadAllByUserId($id, $sr = 0) {
        self::connect();
        if ($sr = 0 ) {
            $sql = "SELECT * FROM messages WHERE senderId=:id ORDER BY creationDate DESC";
        }else {
            $sql = "SELECT * FROM messages WHERE receiverId=:id ORDER BY creationDate DESC";
        }
        $stmt = self::$db->conn->prepare($sql);
        $result = $stmt->execute([ 'id' => $id ]);
        $returnTable = [];
        if ($result !== false && $stmt->rowCount() > 0) {
            foreach ($stmt as $row){
                $loadedMessage = new messages();
                $loadedMessage->id = $row['id'];
                $loadedMessage->senderId = $row['senderId'];
                $loadedMessage->receiverid = $row['receiverid'];
                $loadedMessage->text = $row['text'];
                $loadedMessage->creationDate = $row['creationDate'];
                $loadedMessage->read = $row['read'];
                $returnTable[] = $loadedTweet;
            }
        }
        return $returnTable;
    }
    
    public function delete(){
        self::connect();
        if($this->id != -1){
            $sql = "DELETE FROM messages WHERE id=:id";
            $stmt = self::$db->conn->prepare($sql);
            $result = $stmt->execute([ 'id' => $this->id]);
            if ( $result == true ){
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}