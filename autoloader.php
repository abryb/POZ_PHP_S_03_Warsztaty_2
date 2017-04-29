<?php
// Autoloader napędzany palcami
require_once('src/interface/activeRecord.php');
require_once('src/util/db.php');
require_once('src/abstract/activeRecord.php');
require_once('src/model/user.php');
require_once('src/model/tweet.php');
require_once('src/model/comment.php');
require_once('src/model/message.php');




// Miałem problemy z autoloaderem w tej formie, popracuję potem nad tym
//foreach (glob("/src/model/*.php") as $filename) {
//    require_once($filename);
//}