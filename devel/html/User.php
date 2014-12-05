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
    <link type="text/css" rel="stylesheet" href="../css/user.css" />
</head>

<body class="page_loggedIn">
    <div class="page_body">
        <div class="header_loggedIn" role="banner">
            <div class="navbar container">
                <ul class="header_navigation" role="navigation">
                    <li class="header_item">
                        <a class="header_link" href="User.html">Home</a>
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

                        <form method="post" action="../php/upload.php" enctype="multipart/form-data">
                            <input type="file" name="pic" id="pic" accept="image/*" onchange="readURL(this)">
                            <img id="blah" src="#" alt="your image" />
                            <input type="submit">
                        </form>


                        <div><b>Insert your question:</b>

                            <input id="question" name="question" type="text" maxlength="60" style="width:300px; border:1px solid #999999" />

                        </div>
                        <div id="answers">
                            <div>
                                <b>Answer number 1:</b>

                                <input id="answer0" class="answer_type" name="Answer1" type="text" maxlength="60" style="width:150px; border:1px solid #999999" />
                            </div>

                            <div id="ans">
                                <b>Answer number 2:</b>


                                <input id="answer1" class="answer_type" name="Answer2" type="text" maxlength="60" style="width:150px; border:1px solid #999999" />

                            </div>
                            <input type="button" name="addAns" id="addAns0" value="Add" onclick="addInput()">
                        </div>

                        <input type="submit" value="Create!" />



                    </div>

                    <h1 class="heading">
                        Your Polls
                    </h1>

                </div>
            </div>
        </div>
    </div>
</body>

</html>