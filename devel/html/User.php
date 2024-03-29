<?php session_start(); ?>
<!DOCTYPE html>
<html id="votePoll" class="tinyViewPort" xmlns="http://www.w3.org/1999/html">

<head>

    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <title>
        Welcome to VotePoll
    </title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../javascript/addButton.js"></script>
    <script type="text/javascript" src="../javascript/image.js"></script>
    <script type="text/javascript" src="../javascript/Showpoll.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/user.css"/>
</head>

<body class="page_loggedIn">
    <div class="page_body">
        <div class="header_loggedIn" role="banner">
            <div class="navbar container">
                <ul class="header_navigation" role="navigation">
                    <li class="header_item">
                        <a class="header_link" href="User.php">Home</a>
                    </li>
                    <li class="header_item">
                        <a class="header_link" href="Polls.html">Polls</a>
                    </li>
                    <li class="header_item">
                        <a class="header_link" href="Developers.html">Developers</a>
                    </li>

                    <li id="logoutContainer">
                        <a href="../php/logout.php" id="logoutButton"><span>Logout</span><em></em></a>
                    </li>

                </ul>

            </div>
        </div>
        <div class="site_main" role="main">
            <div class="container">
                <div class="create_poll_section">
                    <div id="create_poll">
                        <h2>Create a new Poll</h2>

                        <form action="../php/create.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="pic" id="pic" accept="image/*" onchange="readURL(this)">
                            <img id="blah" src="#" alt="your image"/>

                        </br>
                        <div><b>Insert polls title:</b></br>
                            <input id="title" name="title" type="text" maxlength="60"
                            style="width:300px; border:1px solid #999999"/>
                        </div>


                        <div><b>Insert your question:</b></br>

                            <input id="question" name="question" type="text" maxlength="60"
                            style="width:300px; border:1px solid #999999"/>

                        </div>
                        <div id='answers'>
                            <div id='answer1'>
                                <b>Answer number 1:</b></br>

                                <input id="answer1" name="answer1" type="text" maxlength="60"
                                style="width:150px; border:1px solid #999999"/>
                            </div>

                            <div id='answer2'>
                                <b>Answer number 2:</b></br>


                                <input id="answer2" name="answer2" type="text" maxlength="60"
                                style="width:150px; border:1px solid #999999"/>

                            </div>
                            <div id="errMsg1">
                                <?php if(!empty($_SESSION['errMsg1'])) { echo $_SESSION['errMsg1']; } ?>
                            </div>
                            <?php unset($_SESSION['errMsg1']); ?>
                        </div>
                    </br> 
                    <div>
                        <input type="button" name="addAns" id='addAns' value="Add Answer">
                        <input type="button" name="remAns" id='remAns' value="Remove Answer">
                    </div>
                </br>

                <input type="submit" value="Create!" />

            </form>
        </div>

        <h1 class="heading">
            Your Polls
        </h1>

        <div id="yourPolls">
            
        </div>

    </div>
</div>
</div>
</div>
</body>

</html>