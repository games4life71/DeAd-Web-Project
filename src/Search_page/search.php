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
    <a href="../HomePage/homepage.php"><img src="../../assets/Logo/Asset%201.svg" class="logo" alt="logo"></a>
    <input class="menu-btn" type="checkbox" id="menu-btn"/>
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
        <li><a href="../HomePage/homepage.php">Home</a></li>
        <li><a href="../Login_Module/login.php">Login</a></li>
        <li><a href="../About/about.html">About Us</a></li>
        <li><a href="../Contact/contact.html">Contact</a></li>
        <li><a href="../FAQ/faq.html">FAQ</a></li>
    </ul>

</header>
<div id="cover">
    <form method="get">
        <div class="tb">
            <div class="td"><input name="username" type="text" placeholder="Search for the prisoner" required></div>
            <div class="td" id="s-cover">
                <button type="submit">
                    <div id="s-circle"></div>
                    <span></span>
                </button>
            </div>
        </div>
    </form>

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

<div class="matches">

</div>


</body>
</html>