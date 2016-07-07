<!DOCTYPE html>
<html>
  <head>
    <title>Pagination Exam</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/viscompExam/" />
    <link type="text/css" rel="stylesheet" href="style.css">
  </head>
  <body>
  <center>
    <form action=''>
      <input type='hidden' name='page' value='<?= $_GET['page'] ?>'>
      Брой елементи: <input type='text' name='elementsPerPage'>
      <input type='submit' value='Покажи'>
    </form>
    <?php
    require_once '/Pager.php';
    $pager = new Pager(124);
    //    $pager = new Pager();
    $pager->draw();
    ?>
  </center>
</body>
</html>
