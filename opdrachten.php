<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>rekenen</h1>
    <form name="bereken" action="opdrachten.php" method="post">
        <div> getal 1: <input name="getal1" type="text" required></div>
        <div> getal 2: <input name="getal2" type="text" required></div>
        <div> getal 3: <input name="getal3" type="text" required></div>

        <div>
        <input name="submit" type="submit"/> <input type="reset"/>
        </div>
    </form>




    <?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if(isset($_POST['submit'])){
        $getal1 = $_POST['getal1'];
        $getal2 = $_POST['getal2'];
        $getal3 = $_POST['getal3'];

        $som = $getal1 + $getal2 + $getal3;
        
    }




    ?>
</body>

</html>