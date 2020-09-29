<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css" />
    <title>Welcome | CSE 341 Web Backend Dev II</title>
</head>

<body>


    <div class="title">
        <h1>CSE 341 Web Backend Development II</h1>

    </div>
    <main>


        <div class="intro">
            <p>My name is Tyson Thornton. To find out a little more about me</p>
            <div id="click"><a href="homepage.php">Click Here</a></div>
        </div>

        <div id="content-container">
            <h2>Below are links to my assignments:</h2>
            <ul id="assignments">
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
                <li><a href="#">Coming Soon</a></li>
            </ul>
        </div>
    </main>

    <footer>
        &copy; 2020 | Tyson Thornton |
        <?php
        $date = strtotime("8:00pm September 26 2020");
        echo "Created date is " . date("Y-m-d h:i:sa", $date);
        ?>
    </footer>
</body>

</html>