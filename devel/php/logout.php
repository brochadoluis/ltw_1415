<?php
require_once 'users.php';
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Luís
 * Date: 04/12/2014
 * Time: 04:09
 */
logout();
header('Location: ../html/index.html');