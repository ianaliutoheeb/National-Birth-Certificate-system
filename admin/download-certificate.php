<?php
namespace Dompdf;
require_once 'dompdf/autoload.inc.php';
ob_start();
$con=mysqli_connect("localhost", "root", "", "obcsdb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Birth Certificate</title>
<style>
table, th, td {
  border: 1px solid;
}
</style>
</head>
<body>
<h2 align="center"><img  src="img/Nigeria Coat of Arm.png" alt=""> <br> REPUBLIC OF NIGERIA <br> NATIONAL POPULATION COMMISSION <br> <em>Certificate of Birth </em> </h2>
<h4 align="center">
    <strong> issued under the Birth and Death Etc. (Compulsory Registration) Decree No. 69 of 1992 </strong>
</h5>
	<?php 

$cid=intval($_GET['cid']);
	$ret=mysqli_query($con,"SELECT tblapplication.*,tbluser.FirstName,tbluser.LastName,tbluser.MobileNumber,tbluser.Address from  tblapplication join  tbluser on tblapplication.UserID=tbluser.ID where tblapplication.ApplicationID='$cid'");

while ($row=mysqli_fetch_array($ret)) { ?>
<h3>Application / Certificate Number: <?php  echo $row['ApplicationID'];?></h3>
<table    border="0" cellspacing = "0" cellpadding = "0"   width = "100%" style="border-collapse:collapse;">

<tr >
<td colspan="2" > <strong> Registartion Center:</strong> <u>  <?php  echo $row['FirstName'];?> </u> </td>
<td colspan="2" > <strong> Center Number:</strong> <u>  <?php  echo $row['MobileNumber'];?> </u> </td>
</tr>
<tr >
<td colspan="2" > <strong> State:</strong> <u>  <?php  echo $row['PostalAdd'];?> </u> </td>
<td colspan="2" > <strong> L.G.A:</strong> <u>  <?php  echo $row['Email'];?> </u> </td>
</tr>
<tr align="right">
<td colspan="4" > <strong> Birth ID: </strong> <u>  <?php  echo $row['ApplicationID'];?> </u> </td>
</tr>
<tr align="center">
<td colspan="4" > <h3 align="center"> <strong>This is to certify that the information has been taken 
  from the original record of birth taken on <br>&nbsp; <br> <?php  echo $row['Dateofapply'];?>  by  
  <?php  echo $row['UpdationDate'];?> </strong> </h3></td>
</tr>

<tr>
    <th width="150">Full Name</th>
    <td width="250" colspan="3"><?php  echo $row['FullName'];?></td>
</tr>
<tr>
    <th width="150">Sex</th>
    <td><?php  echo $row['Gender'];?></td>
    <th scope>Date of Birth</th>
    <td><?php  echo $row['DateofBirth'];?></td>
  </tr>
<tr>
    <th scope colspan="2">Place of Birth</th>
    <td colspan="2"><?php  echo $row['PlaceofBirth'];?></td>
</tr>
<tr>
    <th scope colspan="2">Name of Mother</th>
    <td colspan="2"><?php  echo $row['NameOfMother'];?></td>
</tr>
<tr>
    <th scope colspan="2">Name of Father</th>
    <td colspan="2"><?php  echo $row['NameofFather'];?></td>
</tr>
<tr>
    <th scope colspan="2">Permanent Address of Parents</th>
    <td colspan="2"><?php  echo $row['MobileNumber'];?></td>
</tr>
</table>

<?php } ?>

<p>THIS IS A COMPUTER GENERATED CERTIFICATE. </p>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->setPaper('A4', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
//For view
//$dompdf->stream("",array("Attachment" => false));
// for download
$dompdf->stream("Birth-Certificate.pdf");
?>