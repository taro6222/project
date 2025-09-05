<?php /* Tplus 1.1.3-p2 2025-08-18 19:31:21 D:\Work\tplus\test\html\lab.html 000000634 */ ?>



<div><?=$V['fooo'][3] /*{"line":4,"code":"[=fooo{3}]"}*/?>
 [=aaa)] <?=$V['fooo'][3] /*{"line":4,"code":"[=fooo[3]]"}*/?>
  </div>

[= Widget.Calender.MONTH.march.double()]


<?=$this->assign(["a"=>1,"b"=>2]) /*{"line":9,"code":"[=this.assign({\"a\":1,\"b\":2})]"}*/?>
<?=$this->assign("c",3) /*{"line":10,"code":"[=this.assign(\"c\",3)]"}*/?>

<?=$this->assign(123,456) /*{"line":12,"code":"[=this.assign(123,456)]"}*/?>

<?=$this->get("no-such2.html",'abc',"qq") /*{"line":14,"code":"[=this.get(\"no-such2.html\", 'abc', \"qq\")]"}*/?>
