<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Report Demo</title>
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300,400,700);

        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
            color: #999;
        }

        .welcome {
           width: 300px;
           height: 300px;
           position: absolute;         
           top: 50%; 
           margin-top: -150px;
        }

        a, a:visited {
            color:#FF5949;
            text-decoration:none;
        }

        a:hover {
            text-decoration:underline;
        }

        ul li {
            display:inline;
            margin:0 1.2em;
        }

        p {
            margin:2em 0;
            color:#555;
        }
    </style>
</head>
<body>
    <h1> Списък магазини в регион София и оценките им през месец
         <?php $monthNum = sprintf("%02s", $date);
        $timestamp = mktime(0, 0, 0, $monthNum, 10);
        $monthName = date("F", $timestamp); 
        echo $monthName;
        ?> 
    </h1>

        <table>
            <?php
                foreach ($views as $view) {
                    echo $view;
                }
            ?>           
        </table>

</body>
</html>
