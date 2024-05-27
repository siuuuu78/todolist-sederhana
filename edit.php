<?php
include 'database.php';


// data yang mo di edit
$q_select = "SELECT * FROM task where taskid =  '".$_GET['id']."' ";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object ($run_q_select);


// edit data
if(isset($_POST['edit'])){
    $q_update = "update task set label = '".$_POST['task']."'  where taskid =  '".$_GET['id']."' ";
    $run_q_update = mysqli_query($conn, $q_update);

    header('Refresh:0; url=index.php');
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        *{
            padding:0;
            margin:0;
            box-sizing:border-box;
        }
        body{
            font-family: "Roboto", sans-serif;
            background: #8360c3;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #2ebf91, #8360c3);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2ebf91, #8360c3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        .container {
            width: 600px;
            height: 100vh;
            margin: 0 auto;
        }
        .header{
            padding: 15px;
            color: #fff
        }
        .header .title{
            display: flex;
            align-items:center;
            margin-bottom:7px;
        }
        .header .title i {
            font-size: 24px;
            margin-right: 10px;
            color: #fff;
            
        }
        .header .title span{
            font-size: 18px;
        }
        .header .deskripsi{
            font-size: 18px;
        }

        .content{
            padding: 15px;
        }
        .card{
           
            background-color:#fff;
            padding: 15px;
            border-radius:5px;
            margin-bottom: 10px;
        }
        .input-control{
            width: 100%;
            display: block;
            padding: 0.5rem;
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .text-right{
            text-align: right;
        }
        button {
            padding : 0.5rem 1rem;
            font-size: 1rem;
            cursor: pointer;
            border:1px solid;
            border-radius: 5px;
        }
        .task-item{
           
            display:flex;
            justify-content: space-between;
        }
        .orange{
            color: orange;
        }
        .red{
            color: red;
        }
        .task-item.done span{
            text-decoration:line-through;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .header .title span, .header .deskripsi {
                font-size: 18px;
            }
            .card {
                padding: 10px;
            }
            button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    
   <div class="container">

    <div class="header">
        <div class="title">
            <a href="index.php">  <i class='bx bx-chevron-left'></i></a>
        <span>Balek</span>
        </div>

        <div class="deskripsi">
            <?= date("l, d M Y") ?>
        </div>

    </div>

    <div class="content">
        <div class="card">
            <form action="" method="post">

                <input type="text" name="task" class="input-control" placeholder="Edit Tasks" value=<?= $d->label ?>  >

                <div class="text-right">
                    <button type="submit" name="edit">Edit</button>
                </div>

            </form>
        </div>
       
        </div>

    </div>

   </div>

</body>
</html>