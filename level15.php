<?php

// Really PHP.

$flag = "Test_flag";
$code = 'return 25;} function shouldNotExist(){ echo "I_exist\n";}//';
$f = create_function('$flag',$code);
// $f("Hello");
shouldNotExist();
