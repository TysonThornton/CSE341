<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <title>Homepage</title>
</head>
<body>


    <div class="title">
        <h1>Some Of My Interests</h1>

    </div>
    <main>

        <div id="content-container">
            <h2>Dogs</h2>
            <p>I have always owned a dog. My wife and I recently got a puppy which I've never
                done before. His name is Leroy and he is now 1 year old and is a Whippet.
            </p>
            <div>
                <img class="image" src="/images/9-29-2020 3.42.28 PM.png" alt="picture of Leroy the whippet">
            </div>
        </div>

        <div id="content-container">
            <h2>NBA</h2>
            <p>I am a big fan of the NBA. I've stopped following one specific team, but instead
                follow players that I like. One of my favorite players is Lebron James who is on
                the Los Angeles Lakers and will probably win the NBA championship this year.
            </p>
            <div>
                <img class="image" src="/images/lakers2.png" alt="LA Lakers logo">
            </div>
        </div>

        <div id="content-container">
            <h2>Music</h2>
            <p>I love music. I love all types of music. I have tried playing an instrument and singing and
                I have accepted that it isn't one of my gifts. I still listen to music all of the time and
                enjoy discovering new music. Once I find an albumn that I really enjoy and 70% or more of
                the songs on it are worth listening to it, then I buy that vinyl albumn. I have a small collection
                but it is growing.
            </p>
            <div>
                <img class="image" src="/images/vinyl_record_player.jpg" alt="vinyl record player">
            </div>
        </div>
    </main>

    <footer>
        &copy; 2020 | Tyson Thornton | 
        <?php
        $date=strtotime("8:00pm September 26 2020");
        echo "Created date is " . date("Y-m-d h:i:sa", $date); 
        ?>
    </footer>
    
</body>
</html>