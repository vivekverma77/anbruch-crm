<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DataTable With ServerSide</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col-12">
                <center>
                  <select id="select">
                    <option value="">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </center>

                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>   
                            <th>Phone</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Country</th>
                            <!-- <th>Last Modified By</th>
                            <th>Last Modified</th> -->
<!--                             <th class="all" nowrap>Lead Status</th> 
 -->                         <!--    <th class="all" nowrap>Opener</th> 
                            <th class="all" nowrap>Closer</th> 
                            <th class="none">Notes</th> -->

                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>                
                </div>
            </div>
        </div>
          <div id="spinner" align='center'><img style='position:absolute;height:64px;width:64px; top:50%;left:50%;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      </body>
    </html>
    <script type="text/javascript">
      $(document).ready(function(e){

        // console.log(Intl.DateTimeFormat().resolvedOptions().timeZone);

          var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this

       //  load_datatable();

  // function load_datatable(job_id =''){ 
        var dataTable = $('#datatable').DataTable({
             "pageLength" : 10,
             "serverSide": true,

             "order": [[0, "asc" ]],
             "ajax":{
                  data: function(data){
                          var name = $('#select').val();
                          data.monthly_target = name;
                       },  
                  beforeSend: function () {
                        $("#spinner").show();
                   },
                   complete: function(){
                        $("#spinner").hide();
                    },
                  url :  base_url+'Datatable/test',
                  type : 'POST'
                    },
          }); // End of DataTable
     //  }

 $('#select').change(function(){
       dataTable.draw();
    });


 }); // End D
    </script>