<? php

if(!empty($_post['submit']))
{
    $Order_ID = $_POST['order_id'];
    $User_Name = $_POST['user_name'];
    $Food_Name = $_POST['fname'];
    $Timestamp = $_POST['timestamp'];

    require ("fpdf/fpdf.php");

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont("Arial","B",16);
    $pdf->Cell(0,10,"Orders Details",1,1,'c');

    $pdf->Cell(20,10,"Order Id:- ",1,0);
    $pdf->Cell(40,10,"User Name:- ",1,0);
    $pdf->Cell(40,10,"fname:- ",1,0);
    $pdf->Cell(50,10,"Timestamp:- ",1,1);

    $pdf->Cell(20,10,"Order_Id:- ",1,0);
    $pdf->Cell(40,10,"User_Name:- ",1,0);
    $pdf->Cell(40,10,"Food_Name:- ",1,0);
    $pdf->Cell(50,10,"Timestamp:- ",1,1);

    $pdf->output();
}

?>