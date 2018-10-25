<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{

    echo "<script>alert('Invalid Details');</script>";

}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="">
        <div class="main-wrapper">

            <div class="">
                <div class="row">
 <h1 align="center">Student Result Management System</h1>
<div>

  <h2 align="center"> <img src="images/kasiga-school-logo.jpg" alt="Kāsiga School" height="75" width="75"  class=" profile-img" border-radius="20px">
   </img>
    &nbsp;&nbsp;&nbsp;&nbsp;KĀSIGA International<br/>
    <small font-size="1px" class="center">Copyright © Gaurav Kaushal | IT Project</small>
   </h2>
</div>

<div class="col-lg-6 visible-lg-block">
<section class="section">

  <!-- Student Login -->
                            <div class="row mt-20">
                                <div class="col-md-10 col-md-offset-1 pt-50">

                                    <div class="row mt-20 ">
                                        <div class="col-md-11">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-title text-center">
                                                        <h4>For Students</h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body p-20">

                                                    <div class="section-title">
                                                        <p align="center" class="sub-title">Only for existing students</p>
                                                    </div>

<!--Starting of student login form -->
                                                <form action="result.php" method="post">
                                                  <div class="form-group">
                                                    <label for="rollid">Enter your Roll Id</label>
                                                      <div>
                                                        <input type="text" class="form-control" id="rollid" placeholder="Enter Your Roll Id" autocomplete="off" name="rollid">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="default" class="left">Class</label>
                                                    <select name="class" class="form-control" id="default" required="required">
                                                      <option value="">Select Class</option>
                                                      <?php $sql = "SELECT * from tblclasses";
                                                      $query = $dbh->prepare($sql);
                                                      $query->execute();
                                                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                      if($query->rowCount() > 0)
                                                      {
                                                        foreach($results as $result)
                                                      {   ?>
                                                      <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
                                                      <?php }} ?>
                                                    </select>
                                                  </div>

                                                  <div class="form-group mt-20">
                                                    <div class="">
                                                      <button type="submit" class="btn btn-success btn-labeled pull-right">Search<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                      <div class="clearfix"></div>
                                                    </div>
                                                  </div>
                                                </form>

<!--Ending of student login form -->


                                                </div>
                                            </div>
                                            <!-- /.panel -->

                                        </div>
                                        <!-- /.col-md-11 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </section>
                    </div>

                    <!-- Admin login -->

                    <div class="col-lg-6">
                        <section class="section">
                            <div class="row mt-20">
                                <div class="col-md-10 col-md-offset-1 pt-50">

                                    <div class="row mt-20 ">
                                        <div class="col-md-11">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-title text-center">
                                                        <h4>Admin Login</h4>
                                                    </div>
                                                </div>
                                                <div class="panel-body p-20">

                                                    <div class="section-title">
                                                        <p class="sub-title">For faculty and Academics Department</p>
                                                    </div>

                                                    <form class="form-horizontal" method="post">
                                                    	<div class="form-group">
                                                    		<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="text" name="username" class="form-control" id="inputEmail3" placeholder="UserName">
                                                    		</div>
                                                    	</div>
                                                    	<div class="form-group">
                                                    		<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                                    		<div class="col-sm-10">
                                                    			<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                                                    		</div>
                                                    	</div>

                                                        <div class="form-group mt-20">
                                                    		<div class="col-sm-offset-2 col-sm-10">

                                                    			<button type="submit" name="login" class="btn btn-success btn-labeled pull-right">Sign in<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    		</div>
                                                    	</div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.panel -->
                                            <p class="text-muted text-center"><small>Copyright © Priyansh-Akshat | Hand crafted for <a href="http://www.kasigaschool.com/">KĀSIGA International </a></small> </p>
                                        </div>
                                        <!-- /.col-md-11 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </section>

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /. -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
