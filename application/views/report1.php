<!DOCTYPE html>
<html lang="en">
 <head> 
  
  <style type="text/css"> 
  a { 
   padding-left: 5px; 
   padding-right: 5px; 
   margin-left: 5px; 
   margin-right: 5px; 
  } 
  ul.pagination.pagination-sm {
    display: inline-flex;
    list-style: none;
}


  </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd',timeFormat: 'HH:mm:ss' });
  } );
  </script>

    <script>
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd',timeFormat: 'HH:mm:ss' });
  } );
  </script>
 </head>
 <body>

   <form method='get' action="<?= base_url() ?>reports1/loadRecord" >

     From: <input type='text' name='fromDate' id="datepicker" value="<?php echo $fromDate;  ?>" >
     To:<input type='text' name='toDate' id="datepicker1" value="<?php echo $toDate;  ?>">
     <input type='submit'  value='Submit'>

   </form>


  <table border='1' style='border-collapse: collapse;'> 
   <tr> 
    <th>S.no</th> 
    <th>ID</th> 
    <th>Name</th> 
    <th>Email</th> 
    <th>Date</th> 

   </tr> 
   <?php  
    $sno = $row+1; 
    foreach($result as $data){ 
      echo "<tr>"; 
      echo "<td>".$sno."</td>"; 
      echo "<td>".$data['id']."</td>"; 
      echo "<td>".$data['name']."</td>"; 
      echo "<td>".$data['email']."</td>"; 
      echo "<td>".$data['booking_date']."</td>"; 
      echo "</tr>"; 
      $sno++; 
    } 

        if(count($result) == 0){
      echo "<tr>";
      echo "<td colspan='3'>No record found.</td>";
      echo "</tr>";
    }
    ?> 
  </table>
  <!-- Paginate --> 
  <div style='margin-top: 10px;'> 
  <?= $pagination; ?> 
  </div>
 </body>
</html>