<?php
include './includes/autoloader.inc.php';
include './includes/visitorLogic.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="./css/style.css">
<link rel="icon" href="./css/img/favicon.ico" sizes="16x16 32x32" type="image/png">

<title>Visma</title>
</head>
<body>
    <div class="logo">
    </div>
    <div id="form">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" >
        <label for="name">Name</label>
        <input type="text" value="<?=$_POST['name'] ?? ''?>"  name="name" id="name" placeholder="Enter Name">
        <div class='error'>
        <?=$errors['name'] ?? ''?>
        </div>
        <label for="email">Email</label>
        <input type="email" value="<?=$_POST['email'] ?? ''?>" id="email" name="email" placeholder="Enter Email">
        <div class='error'>
        <?=$errors['email'] ?? ''?>
        </div>
        <label for="phone">Phone</label>
        <small>(86xxxxxxx)</small>
        <input type="text" id="phone" value="<?=$_POST['name'] ?? ''?>" name="phone" placeholder="Enter phone">
        <div class='error'>
        <?=$errors['phone'] ?? ''?>
        </div>
        <label for="date">Date and time</label>
        <input type="datetime-local" id="date" name="datetime" >
<input type="submit" value="Add Visitor" name="submit">    </form>
    </div>
    <div class="error center">
           <small><?=$errorsEdit['email'] ?? ''?></small>
           <small><?=$errorsEdit['name'] ?? ''?></small>
           <small><?=$errorsEdit['phone'] ?? ''?></small>
        </div>
    <table id="table">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date time</th>
            <th>Action</th>
        </tr>
</table>
      <?php
foreach ($visitors->returnAllVisitor() as $visitor): ?>
        <div class="container">
        <form  method="post">
            <?=$visitor['id']?>
            <input type="text" name="name"  id="name" autocomplete="off"  value="<?=$visitor['name']?>">
            <input type="text" name="email" id="email" autocomplete="off" value="<?=$visitor['email']?>">
            <input type="text" name="phone"  id="phone" autocomplete="off" value="<?=$visitor['phone']?>">

            <input type="text" name="datetime" id="datetime" autocomplete="off"  value="<?=$visitor['date']?>">
            <input type="hidden" name="id" value="<?=$visitor['id']?>">
            <button  class="btn" name="edit">Edit </button>
            </form>
                <form action="" method="post">
                <input type="hidden" name="id" value="<?=$visitor['id']?>">
                <button  class="btn-red" name="delete">Delete </button>
                </form>

</div>
        <?php endforeach?>



</body>
</html>
