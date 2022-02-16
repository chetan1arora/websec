<?php
$a = "echo file_get_contents?|> level15.php";
$b =  str_replace (
                ['<?', '?>', '"', "'", '$', '&', '|', '{', '}', ';', '#', ':', '#', ']', '[', ',', '%', '(', ')'],
                '',
                $a
            );

// echo eval($a);
echo $b;
echo eval($b);
