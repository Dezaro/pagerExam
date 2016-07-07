<html>
  <head>
    <style>
      ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline;
      }
      li {
        margin: 4px;
        display: inline;
      }
      table {
        margin: 4px;
        border: 1px solid black;
      }
      tr {
        margin: 4px;
        border: 1px solid black;
      }
      th {
        margin: 4px;
        border: 1px solid black;
      }
      td {
        margin: 4px;
        border: 1px solid black;
      }
    </style>
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
