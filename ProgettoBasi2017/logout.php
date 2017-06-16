<?php

session_start();    // attenzione: e' necessaria, altrimenti la sessione non viene distrutta
session_destroy();
header('Location:index.php');
