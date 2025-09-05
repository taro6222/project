<?php /* Tplus 1.1.3 2025-08-16 15:01:25 D:\Work\tplus\test\html\error1.html 000000387 */ ?>
<html>
    <head>
        <title>
            Runtime Error Display
        </title>
    </head>
<body>
    
<?=$V['unassignedVar'] /*{"line":9,"code":"[= unassignedVar]"}*/?>

<?=$V['unassignedObject']->someMethod() /*{"line":11,"code":"[= unassignedObject.someMethod()]"}*/?>

</body>
</html>