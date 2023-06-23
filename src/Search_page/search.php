<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="../NavBar/navstyle.css">
    <title>Search Page</title>
</head>
<body>
<header class="header">
    <a href="search.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <li><a href="../UserProfile/profile.php">Profile</a></li>
        <li><a href="../About/about.php">About Us</a></li>
        <li><a href="../Contact/contact.php">Contact</a></li>
        <li><a href="../FAQ/faq.php">FAQ</a></li>
    </ul>

</header>
<div class="wrapper">
    <div id="cover">
        <form method="get">
            <div class="tb">
                <div class="td"><input name="username" type="text" placeholder="Search by username" required></div>
                <div class="td" id="s-cover">
                    <button type="submit">
                        <div id="s-circle"></div>
                        <span></span>
                    </button>
                </div>
            </div>
        </form>

        <?php // TODO add nice design of usernames displayed
        if (isset($_GET['username'])) {
            //make a call to the searchUsername endpoint
            //
            session_start();
            //$base_url = "http://ec2-18-184-17-109.eu-central-1.compute.amazonaws.com";
            $base_url = "http://localhost";
            $url_with_username = $base_url."/src/Search_page/searchUsername.php?username=" . $_GET['username'];
            $curl = curl_init();
            //attach the token to the header
            if (isset($_SESSION['token'])) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
            }
            curl_setopt($curl, CURLOPT_URL, $url_with_username);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPGET, true);

            $curl_response = curl_exec($curl);
            //parse the response code
            $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($response_code == 401) {
                echo "Unauthorized";
                exit();
            }


            curl_close($curl);
            echo $curl_response;


        }


        ?>
        <div id="myDropdown" class="dropdown-content">
            <br>
            <!--        <datalist id="results"></datalist>-->
            <?php // TODO add nice design of usernames displayed
            if (isset($_GET['username'])) {
                //make a call to the searchUsername endpoint
                //
                $url_with_username = "http://localhost/src/Search_page/searchUsername.php?username=" . $_GET['username'];
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url_with_username);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPGET, true);

                $curl_response = curl_exec($curl);
                curl_close($curl);
                echo $curl_response;


            }

            ?>

        </div>
    </div>

</div>

<div class="matches">


</div>


</body>
</html>