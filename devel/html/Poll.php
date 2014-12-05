<!DOCTYPE html>
<html>

<head>

    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <title>
        Welcome to VotePoll
    </title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../css/pollStyle.css" />
	

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
          ['Option', 'Count'],
          ['Answer Vote', 1]
        ]);

            var options = {
			'pieSliceTextStyle': {
            'color': 'white',
          },
		 'textStyle' :{
		 'color': 'white',
		 },
                backgroundColor: 'transparent',
                /*'width': 400,
                'height': 300,    size can be defined here as well*/
                title: 'Poll Question Here',
				'legend': { 'textStyle': { 'color': 'white' } },
				'titleTextStyle': {
    color: 'white'
}
				
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
	
	
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
                 
                    <h1 class="heading">
                        Poll
                    </h1>
					
					 <div id="piechart" style="width: 900px; height: 500px;"></div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
