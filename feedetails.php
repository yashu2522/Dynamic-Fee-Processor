<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fee details</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0px;
        }
        body{
            background-image: linear-gradient(to bottom right, rgb(113, 204, 222), blueviolet);
            height: 100vh;
        }
        header{
            text-align: center;
            padding: 20px;
            top: 0px;
            margin: auto;
            border-bottom: 1px solid blueviolet;
            background-color: white;
            margin-bottom: 100px;
        }
        main{
            margin-top: 100px;
            width: 900px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            padding: 25px;
           
        }
        #studentDetails{
            margin: 30px;
        }
        #studentDetails h3{
            color: #333;
            margin: 5px;
        }
        #mainheading{
            background-color: blueviolet;
            color: white;
            text-align: center;
            padding: 5px;
        }
        td,th{
            border: 1px solid #666;
            padding: 7px;
        }
        th{
            background-color: blueviolet;
            color: #eee;
        }
        tr:nth-child(odd){
            background-color: #eee;
        }
        table, th, td {
            /* border: 1px solid black; */
            border-collapse: collapse;
        }
        table{
            width: 100%;
            
        }
        div.table{
            max-height: 500px;
            overflow: scroll;
        }
        footer{
            background-color: #666;
            color: white;
            bottom: 0px;
            width: 100%;
            position: absolute;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>VIGNAN'S LARA INSTITUTE OF TECHNOLOGY AND SCIENCE</h1>
    </header>
    <main>
        <h1 id="mainheading">
            Student fee details
        </h1>
        <div id="studentDetails">
            <h1>
             <?php  
             session_start(); 
              echo $_SESSION['username'] ;
            ?>
            </h1>
        </div>
        <div class="table">
        <table>
            <tr>
                <th>description</th>
                <th>year paid</th>
                <th>date</th>
                <th>time</th>
                <th>Amount</th>
                <th>Studying year</th>
            </tr>
            <?php
                //echo $_SESSION['username'];
                $db=mysqli_connect("localhost","root","","fee");
                $a = $_SESSION['username'];
                $que="SELECT * FROM daily_fees where Regno='$a'";
                $q=mysqli_query($db,$que);
                $r=mysqli_num_rows($q);
                $sum=0;
                $fyear=0;
                $syear=0;
                $tyear=0;
                $fiyear=0;
                while($r = mysqli_fetch_array($q)){
                ?>
                    <tr><td><?php echo $r['description']?></td><td> <?php echo $r['Pyear']?> </td> <td><?php echo $r['date']?> </td><td> <?php echo $r['time'] ?> </td><td> <?php echo $r['Amount'] ?> </td><td> <?php echo $r['Year'] ?> </td></tr>
                <?php
                    $sum+=$r['Amount'];
                    if($r['Pyear']==1){
                        $fyear+=$r['Amount'];
                    }
                    if($r['Pyear']==2){
                        $syear+=$r['Amount'];
                    }
                    if($r['Pyear']==3){
                        $tyear+=$r['Amount'];
                    }
                    if($r['Pyear']==4){
                        $fiyear+=$r['Amount'];
                    }
               // }
            }
            ?>
        </table>
        </div>
        <?php
        echo "Total fee paid:".$sum."<br> <br>";
        echo "First year fee paid:".$fyear ."<br> <br>";
        echo "Second year fee paid:".$syear ."<br> <br>";
        echo "Third year fee paid:".$tyear."<br> <br>";
        echo "Fourth year fee paid:".$fiyear;
        ?>
    </main>
</body>
</html>
