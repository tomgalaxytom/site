

<?php
//index.php
//include autoloader

require_once 'autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();



//$document->loadHtml($html);
//$page = file_get_contents("cat.html");

//$document->loadHtml($page);

// $connect = mysqli_connect("localhost", "root", "", "dompdf");

// $query = "select * from customers";
// $result = mysqli_query($connect, $query);

$output = '
 <style>
 .tableClass td, .tableClass th  {
     border:1px solid black;
     border-collapse: collapse;
   }

 .tableClass   {
     border:1px solid black;
     border-collapse: collapse;
   }


// table th , td{
//     border:1px solid black;
//     border-collapse: collapse;

// }

body{
             font-family: Arial, Helvetica, sans-serif;    
            font-size:10 ;       
        }


  td {
    text-align: center;
     padding: 6px;
  }
.header-class{
    border:1px solid black;
    height:auto;
    padding-left:5px;
    padding-top:10px;
    padding-bottom:10px;
}

div p{
   padding-left:50px;
}
.headerClass{
color:red;
}
.fontSizeClass{
   font-size:10 ;
}



</style>


<div class="header-class">
   <img src="http://localhost/rd/dompdf/HEADER.png" style="width:100%;height:90px">
</div><br>

<!-- <div style=" text-align:left;line-height: 2;" class="fontSizeClass"><b>Title : </b></div>  -->

<div style=" text-align:center;line-height: 2;" class="fontSizeClass">Combined Graduate Level Examination, 2019 - Conduct of Documentation Verification -regarding</div>
<br>


<table  style="width:100%" class= "tableClass">
  
   <tr>
      <td style = "width:33%;padding:15px"><b>Candidate\'s Name </b></td>
      <td style = "width:33%;padding:15px">Chakkara Varshita</td>
      <td style = "width:33%;padding:15px" rowspan = "2"><img src="http://localhost/rd/dompdf/photo/10000504107P.jpeg" width="150" height="150"></td>
   </tr>
    <tr>
      <td style = "width:33%;padding:15px"><b>Roll Number</b></td>
      <td style = "width:33%;padding:15px">800005664422</td>
   </tr>
   <tr>
      <td style = "width:33%;padding:15px"><b>Category</b></td>
      <td style = "width:33%;padding:15px">SC</td>
      <td style = "width:33%;padding:15px" ><img src="http://localhost/rd/dompdf/sign/10000828254S.jpeg" width="130" height="50"></td>
   </tr>
  
   
</table>

<br>
























<!-- Post Preference  --->
<table  style="width:100%" class= "tableClass">
   <tr style="height:300px !important">
      <td  style="text-align: left;line-height: 2;" width="36%" ><b>Post No(s) or Preference : </b>  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.</td>
   </tr>
</table>
<!-- Post Preference --->

<br>

<table  style="width:100%" class= "tableClass">
   <tr>
      <th width="20%">Date of Document Verification</th>
      <th width="10%">Batch Number </th>
      <th width="10%">Reporting Time</th>
      <th width="60%">Venue</th>
   </tr>
   <tr>
      <td>02-09-2021</td>
      <td>Shift -I</td>
      <td>9.00 AM</td>
      <td style="line-height: 2;"> Staff Selection Commision (Southern Region),<br>
            II Floor, EVK Sampath Building ,College Road,<br>
            Chennai - 600034

      </td>
   </tr>
   
   
</table>
<br>

';




//echo $output;

$document->loadHtml($output);
$document->set_option('isRemoteEnabled',true);

//set page size and orientation

$document->setPaper('A4', 'portait');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview


?>

