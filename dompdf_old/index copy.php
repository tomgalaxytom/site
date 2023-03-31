
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

$connect = mysqli_connect("localhost", "root", "", "dompdf");

$query = "select * from customers";
$result = mysqli_query($connect, $query);

$output = "
 <style>


 table, th, td {
    border:1px solid black;
    border-collapse: collapse;
  }


  td {
    text-align: center;
  }

 

</style>
<table>
 <tr>
  <th>Category</th>
  <th>Product Name</th>
  <th>Price</th>
 </tr>
";

while($row = mysqli_fetch_array($result))
{
 $output .= '
  <tr>
   <td>'.$row["name"].'</td>
   <td>'.$row["hometown"].'</td>
   <td>'.$row["edu"].'</td>
  </tr>
 ';
}

$output .= '</table>
<br>
<table  style="width:100%">

<tr>

<th>Paper</th>

<th>Subject</th>

<th>Exam Date</th>
<th>Shift</th>
<th>Exam Time</th>
<th>Marks</th>

</tr>

<tr>

<td rowspan="4">Computer Based Examination</td>

<td>A.General Inteligence & Reasoning</td>

<td rowspan="4">16-08-2021</td>
<td>Shift - I</td>

<td rowspan="4">10.00 Am to 11.00 AM</td>
<td>50</td>


</tr>



<tr>

<td>B.General Awareness</td>
<td>Shift - II</td>

<td>50</td>
</tr>
<tr>

<td>C.General Awareness</td>
<td>Shift - III</td>

<td>50</td>
</tr>

<tr>

<td>D.English Comprehension </td>
<td>Shift - IV</td>

<td>50</td>
</tr>

</table>




';

//echo $output;

$document->loadHtml($output);

//set page size and orientation

$document->setPaper('A4', 'landscape');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Webslesson", array("Attachment"=>0));
//1  = Download
//0 = Preview


?>
