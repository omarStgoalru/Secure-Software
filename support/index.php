<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
    <style>
       
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 4rem;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

       
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
 
  <div class="sidebar">
        <h2 class="text-light text-center mb-4">Support Panel</h2>
        <a href="http://localhost/Bookstore/support/index.php" class="active">Dashboard</a>
        <a href="http://localhost/Bookstore/support/order_view.php">Orders</a>
        <a href="http://localhost/Bookstore/support/support.php">Support</a>
        <a href="http://localhost/Bookstore/support/contact_view.php">Contact</a>
        <a href="http://localhost/Bookstore/support/logout.php">Logout</a>
    </div>

   
    <div class="content">
        <h1>Dashboard</h1>
        <div id="chartContainer" style="height: 300px;"></div>
    </div>

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Database information"
                },
                axisY: {
                    title: "Value",
                    scaleBreaks: {
                        autoCalculate: true
                    }
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    dataPoints: [
                        { label: "A", y: 10 },
                        { label: "B", y: 20 },
                        { label: "C", y: 30 },
                        { label: "D", y: 40 },
                        { label: "E", y: 50 }
                    ]
                }]
            });
            chart.render();
        }
    </script>
</body>
</html>
