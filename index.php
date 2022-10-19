<?php
    // each client should remember their session id for EXACTLY 30 min
    ini_set('session.gc_maxlifetime', 1800);

    // each client should remember their session id for EXACTLY 30 min
    session_set_cookie_params(1800);

    session_start();
    $sessionId = isset($_SESSION['id']) ?$_SESSION['id'] :'';
    $sessionRole = isset($_SESSION['role']) ?$_SESSION['role'] :'';
    echo "$sessionId $sessionRole";
    if ( !$sessionId && !$sessionRole ) {
        header( "location:login.php" );
        die();
    }
    include_once "config.php";
    ob_start();
    $id = isset($_REQUEST['id']) ? $_REQUEST['id']:'dashboard';
    $action = isset($_REQUEST['action']) ?$_REQUEST['action']: '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard</title>
</head>

<body>

    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "DashBoard";
                    } elseif ( 'addSalesman' == $id ) {
                        echo "Add Salesman";
                    } elseif ( 'allSalesman' == $id ) {
                        echo "Salesmans";
                    } elseif ( 'userProfile' == $id ) {
                        echo "Your Profile";
                    } elseif ( 'editSalesman' == $action ) {
                        echo "Edit Salesman";
                    }
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
                $query = "SELECT fname,lname,role,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                ?>
                <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$fname $lname (" . ucwords( $role ) . " )";
                        }
                    ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.php">Dashboard</a>
                        <a class="dropdown-item" href="inc/userprofile.php?id=userProfile">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
        <img class="logo" src="assets/img/logo.png" alt="Dahab" style="width:150px">
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if ( 'admin' == $sessionRole ) {?>
                <!-- For Admin, -->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addSalesman' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="inc/salesman.php?id=addSalesman"><i id="left" class="fas fa-user-plus"></i>Add Salesman</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allSalesman' == $id ) {
    echo " active";
}?>">
                <a href="inc/salesman.php?id=allSalesman"><i id="left" class="fas fa-user"></i>All Salesman</a>
            </li>
        </ul>
        <footer class="text-center" style="font-size:12px;" ><span>DahabMasr</span><br>©2022 DahabMasr All right reserved.</footer>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <!-- ---------------------- DashBoard ------------------------ -->
            <?php if ( 'dashboard' == $id ) {?>
                <!-- ---------------------- Gold Price Calculator ------------------------ -->
                <?php
                    ini_set('display_errors',0);
                    if( isset( $_POST['calculate'] ))
                    {
                            $karat_21=875;
                            $karat_24=999.9;
                            $karat_21_pr=$_POST['first_value'];
                    
                    if (is_numeric($karat_21_pr)) {
                        $karat_24_pr= $karat_21_pr * $karat_24 / $karat_21;
                    }
                }?>
                <!-- ---------------------- Gold Price Calculator ------------------------ -->
            <div class="dashboard p-0">
                    <form method="post">
                    <h6 style="font-family: system-ui;margin-left:120px"> Gold Price</h6>
                        <div class="total">
                            <div class="row" style="bottom:25px !important">
                                <div class="col">
                                    <div class="total__box text-center">
                                        <span class="input-group-addon">21.Karat Price</span>
                                        <input type="text" class="form-control" name="first_value">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary  btn-lg btn-block" name="calculate" value="Calculate" style="background-color: #26282B; width: 100%;">Calculate</button>
                                <div class="col">
                                    <div class="total__box text-center">
                                    <span class="input-group-addon">24.Karat Price =</span>
                                    <span class="input-group-addon" style="font-weight: bold ;font-size: 25px "><?php echo round($karat_24_pr,3)?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row  gy-5">
                                <div class="col" style="left:150px; text-align: -webkit-right; bottom:25px">
                                <h6 style="font-family: system-ui;text-align:center;"> Making Charge</h6>
                                    <table width='90% border='0'>
                                        <tr>
                                            <th width='10%' style="text-align:center">Qrt <br> Pound (2g)</th>
                                            <th width='10%' style="text-align:center">Half <br> Pound (4g)</th>
                                            <th width='10%' style="text-align:center">One <br> Pound (8g)</th>
                                            <th width='10%' style="text-align:center">Five <br> Pound (40g)</th>
                                            <th width='10%' style="text-align:center">1/4 <br> Gram</th>
                                            <th width='10%' style="text-align:center">1/2 <br> Gram</th>
                                            <th width='10%' style="text-align:center">1 <br> Gram</th>
                                            <th width='10%' style="text-align:center">2.5 <br> Grams</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from coins , ingots";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){
                                            $id = $data['id'];
                                            $qrt = $data['qrt'];
                                            $half = $data['half'];
                                            $one = $data['one'];
                                            $five = $data['five'];
                                            $qrtgram = $data['qrtgram'];
                                            $halfgram = $data['halfgram'];
                                            $onegram = $data['1gram'];
                                            $gram2 = $data['2gram'];
                                        ?>
                                            <tr>
                                                
                                                <td> <div contentEditable='true' class='edit' id='qrt_<?php echo $id; ?>'> <?php echo $qrt; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='half_<?php echo $id; ?>'><?php echo $half; ?> </div> </td>
                                                <td> <div contentEditable='true' class='edit' id='one_<?php echo $id; ?>'> <?php echo $one; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='five_<?php echo $id; ?>'><?php echo $five; ?> </div> </td>        
                                                <td> <div contentEditable='true' class='edit' id='qrtgram_<?php echo $id; ?>'> <?php echo $qrtgram; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='halfgram_<?php echo $id; ?>'><?php echo $halfgram; ?> </div> </td>
                                                <td> <div contentEditable='true' class='edit' id='1gram_<?php echo $id; ?>'> <?php echo $onegram; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='2gram_<?php echo $id; ?>'><?php echo $gram2; ?> </div> </td>
                                            </tr>
                                        <?php
                                            $count ++;
                                        }
                                        ?>  
                                    </table>
                                    <table width='90% border='0'>
                                        <tr>
                                            <th width='10%' style="text-align:center">5 <br> Grams</th>
                                            <th width='10%' style="text-align:center">8 <br> Grams</th>
                                            <th width='10%' style="text-align:center">10 <br> Grams</th>
                                            <th width='10%' style="text-align:center">15.55 <br> Grams</th>
                                            <th width='10%' style="text-align:center">20 <br> Grams</th>
                                            <th width='10%' style="text-align:center">31.10 <br> Grams</th>
                                            <th width='10%' style="text-align:center">50 <br> Grams</th>
                                            <th width='10%' style="text-align:center">100 <br> Grams</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from ingots";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){
                                            $id = $data['id'];
                                            $gram5 = $data['5gram'];
                                            $gram8 = $data['8gram'];
                                            $gram10 = $data['10gram'];
                                            $gram15 = $data['15gram'];
                                            $gram20 = $data['20gram'];
                                            $gram31 = $data['31gram'];
                                            $gram50 = $data['50gram'];
                                            $gram100 = $data['100gram'];
                                        ?>
                                            <tr>
                                                
                                                <td> <div contentEditable='true' class='edit' id='5gram_<?php echo $id; ?>'> <?php echo $gram5; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='8gram_<?php echo $id; ?>'><?php echo $gram8; ?> </div> </td>
                                                <td> <div contentEditable='true' class='edit' id='10gram_<?php echo $id; ?>'> <?php echo $gram10; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='15gram_<?php echo $id; ?>'><?php echo $gram15; ?> </div> </td>
                                                <td> <div contentEditable='true' class='edit' id='20gram_<?php echo $id; ?>'> <?php echo $gram20; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='31gram_<?php echo $id; ?>'><?php echo $gram31; ?> </div> </td>
                                                <td> <div contentEditable='true' class='edit' id='50gram_<?php echo $id; ?>'> <?php echo $gram50; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='100gram_<?php echo $id; ?>'><?php echo $gram100; ?> </div> </td>
                                            </tr>
                                        <?php
                                            $count ++;
                                        }
                                        ?>  
                                    </table>
                                    
                                    <table width='90% border='0'>
                                        <tr>
                                            <th width='10%' style="text-align:center">250 <br> Grams</th>
                                            <th width='10%' style="text-align:center">500 <br> Grams</th>
                                            <th width='10%' style="text-align:center">1000 <br> Grams</th>
                                            <th width='10%' style="text-align:center">Unkown</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from ingots";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){
                                            $id = $data['id'];
                                            $gram250 = $data['250gram'];
                                            $gram500 = $data['500gram'];
                                            $gram1000 = $data['1000gram'];
                                        ?>
                                            <tr>
                                                
                                                <td> <div contentEditable='true' class='edit' id='250gram_<?php echo $id; ?>'> <?php echo $gram250; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='500gram_<?php echo $id; ?>'><?php echo $gram500; ?> </div> </td>
                                                <td> <div contentEditable='true' class='edit' id='1000gram_<?php echo $id; ?>'> <?php echo $gram1000; ?></div> </td>
                                                <td> <div>Unkown</div> </td>
                                            </tr>
                                        <?php
                                            $count ++;
                                        }
                                        ?>  
                                    </table>
                                </div>
                                    </div>

                        </div>
                    </form>
                
                <?php }?>
                <br>
                <div class="row">
                    <h3 style="margin-left:400;font-family: system-ui;margin-bottom:15px"> Coins&Ingots</h3> <br>
                                <div class="col" style="left:100px;bottom:15px !important;">
                                    <table width='70% border='0'>
                                        <tr>
                                            <th width='10%' style="text-align:center">Qrt <br> Pound</th>
                                            <th width='10%' style="text-align:center">Half <br> Pound</th>
                                            <th width='10%' style="text-align:center">One <br> Pound</th>
                                            <th width='10%' style="text-align:center">5 <br> Pound</th>
                                            <th width='10%' style="text-align:center">Qrt <br> Gram</th>
                                            <th width='10%' style="text-align:center">Half <br> Gram</th>
                                            <th width='10%' style="text-align:center">One <br> Gram</th>
                                            <th width='10%' style="text-align:center">2.5 <br> Grams</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from coins , ingots";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){

                                        ?>
                                            <tr>
                                                
                                                <td> <div> <?php echo round(($qrt + $karat_21_pr) * 2,3); ?></div> </td>
                                                <td> <div> <?php echo round(($half + $karat_21_pr) * 4,3); ?> </div> </td>
                                                <td> <div> <?php echo round(($one + $karat_21_pr) * 8,3); ?></div> </td>
                                                <td> <div> <?php echo round(($five + $karat_21_pr) * 40,3); ?> </div> </td>        
                                                <td> <div> <?php echo round(($qrtgram + $karat_24_pr),3); ?></div> </td>
                                                <td> <div> <?php echo round(($halfgram + $karat_24_pr),3); ?> </div> </td>
                                                <td> <div> <?php echo round(($onegram + $karat_24_pr),3); ?></div> </td>
                                                <td> <div> <?php echo round(($gram2 + $karat_24_pr),3); ?> </div> </td>
                                            </tr>
                                        <?php
                                            $count ++;
                                        }
                                        ?>  
                                    </table>
                                    <table width='70% border='0'>
                                        <tr>
                                            <th width='10%' style="text-align:center">5 <br> Grams</th>
                                            <th width='10%' style="text-align:center">8 <br> Grams</th>
                                            <th width='10%' style="text-align:center">10 <br> Grams</th>
                                            <th width='10%' style="text-align:center">15.55 <br> Grams</th>
                                            <th width='10%' style="text-align:center">20 <br> Grams</th>
                                            <th width='10%' style="text-align:center">31.10 <br> Grams</th>
                                            <th width='10%' style="text-align:center">50 <br> Grams</th>
                                            <th width='10%' style="text-align:center">100 <br> Grams</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from coins , ingots";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){

                                        ?>
                                            <tr>
                                                
                                                <td> <div> <?php echo round(($gram5 + $karat_24_pr) * 5,3); ?></div> </td>
                                                <td> <div> <?php echo round(($gram8 + $karat_24_pr) * 8,3); ?> </div> </td>
                                                <td> <div> <?php echo round(($gram10 + $karat_24_pr) * 10,3); ?></div> </td>
                                                <td> <div> <?php echo round(($gram15 + $karat_24_pr) * 15.55,3); ?> </div> </td>        
                                                <td> <div> <?php echo round(($gram20 + $karat_24_pr) * 20,3); ?></div> </td>
                                                <td> <div> <?php echo round(($gram31 + $karat_24_pr) * 31.10,3); ?> </div> </td>
                                                <td> <div> <?php echo round(($gram50 + $karat_24_pr) * 50,3); ?></div> </td>
                                                <td> <div> <?php echo  round(($gram100 + $karat_24_pr) * 100,3); ?> </div> </td>
                                            </tr>
                                        <?php
                                            $count ++;
                                        }
                                        ?>  
                                    </table>
                                    <table width='70% border='0'>
                                        <tr>
                                            <th width='10%' style="text-align:center">250 <br> Grams</th>
                                            <th width='10%' style="text-align:center">500 <br> Grams</th>
                                            <th width='10%' style="text-align:center">1000 <br> Grams</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from coins , ingots";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){

                                        ?>
                                            <tr>
                                                
                                                <td> <div> <?php echo round(($gram250 + $karat_24_pr) * 250,3); ?></div> </td>
                                                <td> <div> <?php echo round(($gram500 + $karat_24_pr) * 500,3); ?> </div> </td>
                                                <td> <div> <?php echo round(($gram1000 + $karat_24_pr) * 1000,3); ?></div> </td>
                                            </tr>
                                        <?php
                                            $count ++;
                                        }
                                        ?>  
                                    </table>
                                </div>
                            </div>
                
            </div>
        </div>
    </section>
    <!-- ---------------------- Salesman ------------------------ -->

            
    <!-- ---------------------- User Profile ------------------------ -->

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <script src="ingots_script.js"></script>
</body>

</html>