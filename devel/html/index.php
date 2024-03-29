<?php session_start(); ?>
<!DOCTYPE html>

<html id="votePoll" class="tinyViewPort" xmlns="http://www.w3.org/1999/html">

<head>
    <title>
        Welcome to VotePoll
    </title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
    <script type="text/javascript" src="../javascript/login.js"></script>
    <script type="text/javascript" src="../javascript/validateForm.js"></script>
    <script type="text/javascript" src="../javascript/reloadCaptcha.js"></script>
    <script type="text/javascript" src="../javascript/validateUser.js"></script>
    <script type="text/javascript" src="../javascript/search.js"></script>

</head>

<body class="page_loggedOut">
    <div class="page_body">
        <div class="header_loggedOut" role="banner">
            <div class="navbar container">

                <ul class="header_navigation" role="navigation">
                    <li class="header_item">
                        <a class="header_link" href="index.php">Home</a>
                    </li>
                    <li class="header_item">
                        <a class="header_link" href="Polls.html">Polls</a>
                    </li>
                    <li class="header_item">
                        <a class="header_link" href="Developers.html">Developers</a>
                    </li>

                    <li id="loginContainer">
                        <a href="#" id="loginButton"><span>Login</span><em></em></a>

                        <div style="clear:both"></div>
                        <div id="loginBox">
                            <form action="../php/login.php" id="loginForm" method="post">
                                <fieldset id="body">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username"/>

                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password"/>
                                </br></br>
                                <input type="submit" id="login" value="Sign in"/>

                            </fieldset>

                        </form>
                    </div>
                </li>
                <li id="errMsg">
                    <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?>
                </li>
                <?php unset($_SESSION['errMsg']); ?>

            </ul>
        </div>
        <div id="containerSearch">
            <div id="results"></div>
            <form action="" method="get">
                <div id="search_data">Search: <input id="searchData" type="text"></div>
            </form>
        </div>
    </div>
    <div class="site_main" role="main">
        <div id="site container" class="context_site">
            <div class="signup_section">
                <div id="signup">
                    <h2>Sign Up</h2>

                    <form action="../php/register.php" id="signup" method="post">
                        <input id="SnapHostID" name="SnapHostID" type="hidden" value="YX4ES97MDBEB"/>
                        <table border="0" cellpadding="5" cellspacing="0" width="600">
                            <tr>
                                <td><b>Full Name*:</b></td>
                                <td>
                                    <input id="name" name="name" type="text" maxlength="120"
                                    style="width:146px; border:1px solid #999999" required=""/>
                                </td>
                            </tr>
                            <tr>

                                <td><b>Email address*:</b></td>
                                <td><input id="email" name="email" type="email" maxlength="60"
                                   style="width:300px; border:1px solid #999999" required=""/></td>
                               </tr>
                               <tr>

                                <td><b>Username*:</b></td>
                                <td><input id="username" name="username" type="text" maxlength="60"
                                   style="width:300px; border:1px solid #999999"/ required="">
                               </td>
                           </tr>
                           <tr>
                            <td><b>Password*:</b></td>
                            <td><input id="password" name="password" type="password" maxlength="60"
                               style="width:146px; border:1px solid #999999" required=""/></td>
                           </tr>

                           <tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <br/>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr valign="top">
                                            <td>
                                                <i>Enter web form code*:</i>
                                                <input id="CaptchaCode" name="CaptchaCode" type="text" required=""
                                                style="width:80px; border:1px solid #999999;" maxlength="6"/>
                                            </td>
                                            <td>
                                                <a href="http://www.SnapHost.com"><img id="CaptchaImage"
                                                   alt="Web Form Code"
                                                   title="Anti-spam web forms"
                                                   style="margin-left:20px; border:1px solid #999999"
                                                   src="http://www.SnapHost.com/captcha/WebForm.aspx?id=YX4ES97MDBEB&ImgType=2"/></a>
                                                   <br/><a href="#"
                                                   onclick="return ReloadCaptchaImage('CaptchaImage');"><span
                                                   style="font-size:12px;">reload image</span></a>
                                               </td>
                                           </tr>
                                       </table>
                                       <br/>
                                       <i>* - required fields. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</i>
                                       <input id="skip_Submit" name="skip_Submit" type="submit" value="Submit"/>
                                   </td>
                               </tr>
                           </table>
                           <br/>
                       </form>
                   </div>
                   <div class="container">
                    <h1 class="heading">
                        Vote better, do better.
                    </h1>

                    <p class="subheading">
                        A website of pure voting enjoyment. Create, share and vote. Polls at it's best.
                        <a href="Info.html">Learn more about it.</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>