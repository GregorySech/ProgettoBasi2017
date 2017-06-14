<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Libreria di utilities per semplificarsi la vita
 */
class utilities {
    public static function checkLogin(){
        session_start();
        if(empty($_SESSION['userID'])) {
            header('Location:index.php');
        }
    }
}
