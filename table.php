<html>
    <body>
        <table border = 1>
            <tr>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>                
            </tr>



    /*  <?php
                $con = mysqli_connect("localhost","root","","study");

                if (mysqli_connect_errno($con))
                    {
                        echo "Failed to connect to mysql" . mysqli_connect_error();
                    }

                    $result = mysqli_query($con,"SELECT * FROM sample_employers");

                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['middlename'] . "</td>";
                        echo "<td> <input type='button' value='Delete' </td>"; 
                        echo "</tr>";
                    }

                    mysqli_close($con);
            ?>

        </table>
        </body>
</html>