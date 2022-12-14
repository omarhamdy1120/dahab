<?php
session_start();
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
} else {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] :'';

    if ( 'addSalesman' == $action ) {
        $fname = $_REQUEST['fname'] ?$_REQUEST['fname'] : '';
        $lname = $_REQUEST['lname'] ?$_REQUEST['lname'] : '';
        $email = $_REQUEST['email'] ?$_REQUEST['email'] : '';
        $phone = $_REQUEST['phone'] ?$_REQUEST['phone'] : '';
        $password = $_REQUEST['password'] ?$_REQUEST['password']: '';

        if ( $fname && $lname && $lname && $phone && $password ) {
            $hashPassword = md5( $password );
            $query = "INSERT INTO salesmans(fname,lname,email,phone,password) VALUES ('{$fname}','$lname','$email','$phone','$hashPassword')";
            mysqli_query( $connection, $query );
            header( "location:inc/salesman.php?id=allSalesman" );
        }
    } elseif ( 'updateSalesman' == $action ) {
        $id = $_REQUEST['id'] ?$_SESSION['id']:'';
        $fname = $_REQUEST['fname'] ?$_REQUEST['fname'] : '';
        $lname = $_REQUEST['lname'] ?$_REQUEST['lname'] : '';
        $email = $_REQUEST['email'] ?$_REQUEST['email'] : '';
        $phone = $_REQUEST['phone'] ?$_REQUEST['phone'] : '';

        if ( $fname && $lname && $lname && $phone ) {
            $query = "UPDATE salesmans SET fname='{$fname}', lname='{$lname}', email='$email', phone='$phone' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:inc/salesman.php?id=allSalesman" );
        }
    } elseif ( 'updateProfile' == $action ) {
        $fname = $_REQUEST['fname'] ?$_REQUEST['fname'] : '';
        $lname = $_REQUEST['lname'] ?$_REQUEST['lname'] : '';
        $email = $_REQUEST['email'] ?$_REQUEST['email'] : '';
        $phone = $_REQUEST['phone'] ?$_REQUEST['phone'] : '';
        $oldPassword = $_REQUEST['oldPassword'] ?$_REQUEST['oldPassword']: '';
        $newPassword = $_REQUEST['newPassword'] ?$_REQUEST['newPassword']: '';
        $sessionId = $_SESSION['id'] ? $_SESSION['id']: '';
        $sessionRole = $_SESSION['role'] ?$_SESSION['role']: '';
        $avatar = $_FILES['avatar']['name'] ?$_FILES['avatar']['name']: "";

        if ( $fname && $lname && $email && $phone && $oldPassword && $newPassword ) {
            $query = "SELECT password,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
            $result = mysqli_query( $connection, $query );

            if ( $data = mysqli_fetch_assoc( $result ) ) {
                $_password = $data['password'];
                $_avatar = $data['avatar'];
                $avatarName = '';
                if ( $_FILES['avatar']['name'] !== "" ) {
                    $allowType = array(
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    );
                    if ( in_array( $_FILES['avatar']['type'], $allowType ) !== false ) {
                        $avatarName = $_FILES['avatar']['name'];
                        $avatarTmpName = $_FILES['avatar']['tmp_name'];
                        move_uploaded_file( $avatarTmpName, "assets/img/$avatar" );
                    } else {
                        header( "location:inc/userprofile.php?id=userProfileEdit&avatarError" );
                        return;
                    }
                } else {
                    $avatarName = $_avatar;
                } 
                    $hashPassword = md5( $newPassword );
                    $updateQuery = "UPDATE {$sessionRole}s SET fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', password='{$hashPassword}', avatar='{$avatarName}' WHERE id='{$sessionId}'";
                    mysqli_query( $connection, $updateQuery );

                    header( "location:inc/userprofile.php?id=userProfile" ); 

            }

        } else {
            echo mysqli_error( $connection );
        }

    }

}
