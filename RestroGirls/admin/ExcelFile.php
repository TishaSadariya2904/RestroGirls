<?php
$cnn = mysqli_connect("localhost", "root", "", "mishtidb");

$output = "";

if (isset($_POST['submit'])) 
{
    $sql = "select * from register order by id desc";
    $res = mysqli_query($cnn, $sql);
    $i = 1;
    if (mysql_num_rows($res) > 0) 
    {

        $output .= '
            <table class="table" border="1">
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Food Name</th>
                    <th>Timestamp</th>
                </tr>
        ';

        while ($row = mysqli_fetch_array($res)) 
        {
            $output = '
                    <tr>
                        <td>' . $row["order_id"] . '</td>
                        <td>' . $row["user_name"] . '</td>
                        <td>' . $row["fname"] . '</td>
                        <td>' . $row["timestamp"] . '</td>
                    </tr>
            ';
        }
        $output .= '</table>';
        echo $output;
    } 
    else
    {
        echo "No Data Found";
    }
}