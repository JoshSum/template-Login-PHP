<?php 
require_once("authuser.php"); 
include '../config.php';
include 'idleTimer.php';
$username= $_SESSION['user']['username'];
$id= $_SESSION['user']['id'];
$data=mysqli_query($con, "SELECT * FROM users WHERE username = '$username'") or die (mysqli_error());
$row=mysqli_fetch_array($data);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets_main/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>User Profile</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets_main/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets_main/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets_main/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets_main/css/demo.css" rel="stylesheet" />

    <!-- Script buat Sweet alert -->
    <script src="../assets_main/js/sweetalert2.all.min.js"></script>

    <!--     Fonts and icons     -->
    <link href="../assets_main/fonts/font-awesome.min.css" rel="stylesheet">
    <link href='../assets_main/fonts/css.css' rel='stylesheet' type='text/css'>
    <link href="../assets_main/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="../assets_main/img/sidebar-5.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        WELCOME
                    </a>
                </div>
                <nav class="main-nav">
                    <ul class="nav">
                        <li>
                            <a href="dashboard.php">
                                <i class="pe-7s-graph"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="user.php">
                                <i class="pe-7s-user"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                                        			
                </ul>
            </nav>
        </div>
    </div>

    <div class="main-panel">
      <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">User</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">                       
                    <li>
                     <a href="">
                        <p class="hidden-lg hidden-md">Search</p>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
             <li><a data-toggle="modal" data-target="#tambah" style="cursor: pointer;"><p><span class="pe-7s-door-lock"></span> Change Password</p></a></li>
             <li>
	                 <a href="user.php">
	                     <p>Account</p>
	                 </a>
             </li>
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <p>	Action
                    <b class="caret"></b>									                                 
                </p>
            	</a>
            <ul class="dropdown-menu">
                <!-- <li><a data-toggle="modal" data-target="#tambah" style="cursor: pointer;"><span class="pe-7s-door-lock"></span> Change Password</a></li> -->
                <li><a href="../logout.php"><span class="pe-7s-next-2"></span> Log Out</a></li>
            </ul>
        </li>                        
        <li class="separator hidden-lg hidden-md"></li>
    </ul>
</div>
</div>
</nav>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form action="user.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row["id"] ?>"></input>
                            <input type="hidden" name="gambarLama" value="<?= $row["photo"] ?>"></input>                                    
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Company (disabled)</label>
                                        <input type="text" class="form-control" disabled placeholder="Company" value="Creative BNP Group.">
                                    </div>
                                </div>                                        
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo  $row['email'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" value="<?php echo $row["name"] ?>" name="full">
                                    </div>
                                </div>                                       
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Departement</label>
                                        <input type="text" class="form-control" placeholder="Position" value="<?php echo  $row["bagian"] ?>" name="position">
                                    </div>
                                </div>
                            </div>                                    

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        Select profile picture to upload:
                                        <input type="file" name="gambar" id="gambar">
                                        
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Change Password</button> -->
                                

                            <button type="submit" class="btn btn-info btn-fill pull-right" action="" name="submit">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                        <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
                                    <div class="modal-dialog">
                                        <div class ="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" style="font-size: 35px">&times;</button>
                                                <h4 class="modal-title">Change Password</h4>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class ="control-label">Old Password</label>
                                                        <input type="password" name="old" class="form-control" id="old" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class ="control-label">New Password</label>
                                                        <input type="password" name="new" class="form-control" id="new" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class ="control-label">Repeat New Password</label>
                                                        <input type="password" name="repeat" class="form-control" id="repeat" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn btn-danger">Reset</button>                                                               
                                                        <button type="submit" class="btn btn-success" name="change" value="change">Save</button>                                                               
                                                    </div>                                            
                                                </div>                                                    
                                            </form>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="" alt=""/>
                    </div>
                    <div class="content">
                        <div class="author">
                           <a href="#">
                               
                            <img class="avatar border-gray" src="../user_img/<?php echo $row['photo'] ?>"  />
                            <h4 class="title"><?php echo  $row["name"] ?><br />
                               <small><?php echo ucfirst($row['user_type']); ?></small>
                           </h4>
                       </a>
                   </div>
                   <p class="description text-center"><?php echo $row["email"] ?>
                   </p>
                   <p class="description text-center"><?php echo $row["bagian"] ?>
                   </p>
               </div>
               <!-- <hr>
               <button type="submit" class="btn btn-default btn-fill" style="text-align: center;width: 100%; font-size: 20px;" name="submit" onclick="window.location.href='../logout.php'">Logout</button>
               <hr> -->
                </div>
               <!-- <p><a href="../logout.php" style="margin-left: 160px;font-size: 20px;">Logout</a></p> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
             <p class="copyright pull-right">
                &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Joshua Sumardi</a>, Application for Proccess Data 
            </p>
        </div>
    </footer>

</div>
</div>


</body>

<!--   Core JS Files   -->
<script src="../assets_main/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets_main/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="../assets_main/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets_main/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<!--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="../assets_main/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="../assets_main/js/demo.js"></script>

</html>

<?php
include '../config.php';

function update($data){
    global $con;
    $id = $data["id"];
    $email = htmlspecialchars($data["email"]);
    $full = htmlspecialchars($data["full"]);
    $position = htmlspecialchars($data["position"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    

    if($_FILES['gambar']['error'] === 4) {
        $gambarLama = $gambarLama;
    } else {
        $gambarLama = upload();
 

    if(!$gambarLama){
        return false;
    }
    }
    $query = "UPDATE users SET 
        email = '$email',
        name = '$full',
        bagian = '$position',
        photo = '$gambarLama' WHERE id = $id";

    mysqli_query($con,$query);
    return mysqli_affected_rows($con);


}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4){
        echo "<script>
        alert('pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ["jpg", "jpeg", "png", "gif", "bmp"];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
        swal('What You Upload is Not a Picture !','Please check your file again !','warning').then(function(){
                document.location.href = 'user.php';
            });
        </script>";
        return false;
    }

    if ($ukuranFile > 1000000){
        echo "<script>
        swal('Image Size Too Large !','Please choose another picture !','error').then(function(){
                document.location.href = 'user.php';
            });
        </script>";
        return false;
    }


    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../user_img/' . $namaFileBaru);
    return $namaFileBaru;

}


if(isset($_POST["submit"])){
    if (update($_POST) > 0){
    echo "<script>
            swal('Data Successfully Updated !','','success').then(function(){
                document.location.href = 'user.php';
            });            
        </script>";
    } else{
    echo "<script>
            swal('Data Failed to Upload !','','error', closeOnConfirm : true).then(function(){
                document.location.href = 'user.php';
            });           
        </script>";
    }
}

if(isset($_POST["change"])){
    $old = filter_input(INPUT_POST, 'old', FILTER_SANITIZE_STRING);
    $new = filter_input(INPUT_POST, 'new', FILTER_SANITIZE_STRING);
    $repeat = filter_input(INPUT_POST, 'repeat', FILTER_SANITIZE_STRING);

    if (password_verify($old, $row["password"])) {
        if($new != $repeat){
          echo "<script>
                swal('New Password Do Not Match','Please Check your New Password','error');
                </script>";
        } else{
            $new = password_hash($_POST["new"], PASSWORD_DEFAULT);
            $sql = "
                UPDATE users
                    set `password` = :new
                WHERE id = $id ";            
            $stmt = $db->prepare($sql);

            // bind parameter ke query
            $params = array(                              
                ":new" => $new
            );

            // eksekusi query untuk menyimpan ke database
            $saved = $stmt->execute($params);

            // jika query simpan berhasil, maka user sudah terdaftar
            // maka alihkan ke halaman login
            if($saved) {
            echo "<script>
                swal('Your New Password Has Been Updated !','Now you can login with your new password','success');
                </script>";
        } else {
            echo "<script>
                swal('Error !','Error','error');
                </script>";
        }
    }

    } else {
        echo "<script>
             swal('Your Old Password Do Not Match','Please Check your Old Password','error');
             </script>";
    }
}
?>
<script type="text/javascript">
idleTimer();
</script>