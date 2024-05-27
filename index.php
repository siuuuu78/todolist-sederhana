<?php
include 'database.php';

// proses insert data
if (isset($_POST['add'])) {
    $q_insert = "INSERT INTO task (label, status) VALUES (
        '".$_POST['task']."',
        'open'
    )";
    $run_q_insert = mysqli_query($conn, $q_insert);

    if ($run_q_insert) {
        header('Refresh:0; url=index.php');
    }
}

// proses show data
$q_select = "SELECT * FROM task ORDER BY taskid DESC";
$run_q_select = mysqli_query($conn, $q_select);

// delete data
if (isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE taskid = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);

    header('Refresh:0; url=index.php');
}

// update data
if (isset($_GET['done'])) {
    $status = $_GET['status'] == 'open' ? 'close' : 'open';
    
    $q_update = "UPDATE task SET status = '".$status."' WHERE taskid = '".$_GET['done']."'";
    $run_q_update = mysqli_query($conn, $q_update);

    if ($run_q_update) {
        header('Refresh:0; url=index.php');
    }
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
        <i class='bx bx-sun'></i>
        <span>To Do List</span>
        </div>

        <div class="deskripsi">
            <?= date("l, d M Y") ?>
        </div>

    </div>

    <div class="content">
        <div class="card">
            <form action="" method="post">

                <input type="text" name="task" class="input-control" placeholder="Add Tasks">

                <div class="text-right">
                    <button type="submit" name="add">Add</button>
                </div>

            </form>
        </div>

        <?php

        if(mysqli_num_rows($run_q_select) > 0) {
                while($r = mysqli_fetch_array($run_q_select)){
        ?>
        <div class="card">
            <div class="task-item <?= $r['status'] == 'close'? 'done' : '' ?>">

                <div>
                    <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid']?>&status=<?= $r['status']?>'"  <?= $r['status'] == 'close' ? 'checked' : '' ?>>
                    <span><?= $r['label'] ?></span>

                </div>
                <div>
                    <a href="edit.php?id=<?= $r['taskid'] ?>" class="orange" title="Edit"><i class="bx bx-edit"></i></a>
                    <a href="?delete=<?= $r['taskid'] ?>" class="red" title="Hapus" onclick="return confirm('Bener?')"><i class="bx bx-trash"></i></a>
                </div>

            </div>
        </div>
        <?php }} else { ?>
            <div>Belum ada task</div>
            <?php } ?>

       
        </div>

    </div>

   </div>

</body>
</html>