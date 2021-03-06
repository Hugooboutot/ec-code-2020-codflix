<?php

session_start();

require_once( 'model/user.php' );

function loginPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/loginView.php');
  else:
    require('view/homeView.php');
  endif;

}

function login( $post ) {

  $data = new stdClass();
  $data->email = $post['email'];
  $data->password = hash('sha256',$post['password']); 
  $user = null;
  $userData = null;

  if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $post['email']))
  {
    $user = new User( $data );
    $userData     = $user->getUserByEmail();
  }
  $error_msg = "Email ou mot de passe incorrect";

  if( $userData && sizeof( $userData ) != 0 ){ 
    if( $user->getPassword() == $userData['password'] ){ 
$_SESSION['user_id'] = $userData['id'];

      header( 'location: index.php ');
    } else { 
      $error_msg = "Email ou mot de passe incorrect";
    }
  }

  require('view/auth/loginView.php');
}

function logout() {
  $_SESSION = array();
  session_destroy();

  header( 'location: index.php' );
}
