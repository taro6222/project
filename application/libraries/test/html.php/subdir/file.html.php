<?php /* Tplus 1.1.3-p2 2025-02-02 05:20:28 D:\Work\tplus\test\html\subdir\file.html 000000686 */ ?>
sub template in sub directory <br/>

<?php $L1=[1,2];if (is_array($L1) and !empty($L1)) {$L1s=count($L1);$L1i=-1;foreach($L1 as $L1k=>$L1v) { ++$L1i; /*{"line":476,"code":"[@ {1, 2}]"}*/?>
<?php $L2=[3,4,5];if (is_array($L2) and !empty($L2)) {$L2s=count($L2);$L2i=-1;foreach($L2 as $L2k=>$L2v) { ++$L2i; /*{"line":477,"code":"[@ {3, 4, 5}]"}*/?>
	   <?=$L1v /*{"line":478,"code":"[=.v]"}*/?>
 x <?=$L2v /*{"line":478,"code":"[=..v]"}*/?>
 = <?=$L1v*$L2v /*{"line":478,"code":"[=.v *..v]"}*/?>
 <br/>
<?php }} /*{"line":479,"code":"[/]"}*/?>
<?php }} /*{"line":480,"code":"[/]"}*/?>



