

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
<div style="text-align:center;line-height: 1;font-size:10" class="fontSizeClass"><b>e-ADMISSION CERTIFICATE</b></div>
<div style=" text-align:center;line-height: 1;" class="fontSizeClass">Combined Graduate Level Examination, 2019 (Tier II)</div>
<div style=" text-align:center;line-height: 1;" class="fontSizeClass">Computer Based Examination</div><br>
<table class= "tableClass" style="width:100%">
   <tr style="height:200px">
      <td rowspan="2" width="50%" class="fontSizeClass">Barcode</td>
      <td  style="text-align: left" class="fontSizeClass"><b>Registration No: </b> 10023657895</td>
   </tr>
   <tr style="height:200px">
      <td style="text-align: left" class="fontSizeClass"><b>Skill Test Medium: </b> English</td>
   </tr>
</table>
<table  class= "tableClass" style="width:100%">
   <tr style="height:200px">
      <td  style="text-align: left" width="50%" class="fontSizeClass"><b>Roll Number: </b> 24041998</td>
      <td  style="text-align: left" class="fontSizeClass"><b>Scribe: </b> Male </td>
   </tr>
</table>



<table  class= "tableClass" style="width:100%">
   <tr style="padding:10px">
      <td  style="text-align: left" width="50%" class="fontSizeClass"><b>Paasword For Examination: </b> 24041998</td>
        <td  style="text-align: left" width="30%" class="fontSizeClass"><b>Date of Skill Test: </b> 24041998</td>
      <td  style="text-align: left" width="20%" class="fontSizeClass"><b>Gender: </b> Male </td>
   </tr>
</table>

<table  style="width:100%" class= "tableClass">
   <tr style="height:200px !important">
      <td  style="text-align: left" width="50%"><b>Reporting Time: </b> 8.30 AM </td>
      <td  style="text-align: left"><b>Entry Closing Time : </b> 9.30 AM </td>
   </tr>
</table>

<table style="width:100.5%;height:100px;margin-left:-2px !important"; class= "tableClass2">
   <tr>
      <td style="width:79%; vertical-align: text-top;text-align:left;border:1px solid black;border-collapse: collapse;">

      <div style="text-align:left;line-height: 2"><b>Candidate\'s Name</b></div>
      <div style=" text-align:left;line-height: 1">Jaya priya</div>

      <div style="text-align:left;line-height: 2"><b>New or Changed Name</b></div>
      <div style=" text-align:left;line-height: 1">priya priya</div>
      
         
      </td>
      <td style="width:21%;border:1px solid black;border-collapse: collapse;"><img src="http://localhost/rd/dompdf/photo/10000504107P.jpeg" width="100" height="100"></td>
   </tr>
</table>

<!-- DOB --->
<table  style="width:100%" class= "tableClass">
   <tr style="height:200px !important">
      <td  style="text-align: left" width="40%"><b>Date of Birth: </b> 24-08-1998 </td>
      <td  style="text-align: left" width="40%"><b>Category : </b> SC </td>
     
      <td  style="text-align: left" width="21.5%"><img src="http://localhost/rd/dompdf/sign/10000828254S.jpeg" width="130" height="50"></td>
   </tr>
</table>
<!-- DOB --->
<!-- Post Preference  --->
<table  style="width:100%" class= "tableClass">
   <tr style="height:200px !important">
      <td  style="text-align: left" width="36%"><b>Post No(s) or Preference : </b> 24-08-1998 </td>
   </tr>
</table>
<!-- Post Preference --->
<!-- Candidate \'s Address-->
<table  style="width:100%"; class= "tableClass">
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b> Candidate\'s Address :  </b> 
      </td>
   </tr>
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.
      </td>
   </tr>
</table>
<!-- Candidate\'s Address -->
<!-- Candidate \'s Address-->
<table  style="width:100%"; class= "tableClass">
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b> Examination Venue :  </b> 
      </td>
   </tr>
    <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b>  Venue 1 :  </b> 
      </td>
   </tr>
   
   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.
      </td>
   </tr>
    <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         <b>  Venue 2 :  </b> 
      </td>
   </tr>

   <tr>
      <td style="width:75%; vertical-align: text-top;text-align:left;border:0px solid black;border-collapse: collapse;">
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.
      </td>
   </tr>
</table>
<!-- Candidate\'s Address -->
<table  style="width:100%" class= "tableClass">
   <tr>
      <th width="30%">Skill Test</th>
      <th width="8%">Shift</th>
      <th width="8%">Reporting Time</th>
      <th width="8%">Entry Closing Time</th>
      <th width="20%">Skill Test Time</th>
   </tr>
   <tr>
      <td>Computer Profiency Test (CPT)</td>
      <td>Shift -I</td>
      <td>9.00 AM</td>
      <td>10.00 AM</td>
      <td>11.00 Am to 12.30 AM</td>
   </tr>
    <tr>
      <td>Computer Profiency Test (CPT)</td>
      <td>Shift -II</td>
      <td>9.00 AM</td>
      <td>10.00 AM</td>
      <td>11.00 Am to 12.30 AM</td>
   </tr>
   <tr>
      <td>Computer Profiency Test (CPT)</td>
      <td>Shift -III</td>
      <td>9.00 AM</td>
      <td>10.00 AM</td>
      <td>11.00 Am to 12.30 AM</td>
   </tr>
   <tr>
      <td>Computer Profiency Test (CPT)</td>
      <td>Shift -IV</td>
      <td>9.00 AM</td>
      <td>10.00 AM</td>
      <td>11.00 Am to 12.30 AM</td>
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

