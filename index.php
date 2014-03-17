<html>
    <head>
        <title>Blue Evil Website of Death</title>
        <style>
            body{
/*                 background-color:#aac; */
                font-family:"Open Sans Light";
                background: url(background.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                text-align:center;
            }
            div{
                color:white;
            }
            .centerbox{
                padding:20px;
                border-radius:3px;
                background-color:rgba(255,255,255,0.4);
                width:400px;
                height:220px;
                margin:0px auto;
                position:absolute;
                top:50%;
                left:50%;
                margin-top:-130px;
                margin-left:-210px;
                display:table-cell;
            }
            #login input{
                border-style:none;
                width:300px;
                height:40px;
                margin:2px;
                border-radius:3px;
                padding:10px;
                font-size:12pt;
                font-family:"Open Sans Light";
            }
            #login .header{
                text-shadow:0px 0px 10px #000;
            }
            .header{
                font-size:24pt;
                color:white;
                margin:10px;
            }
            a{
                color:white;
                opacity:0.8;
                text-decoration:none;
                border-radius:3px;
            }
            a:hover{
                opacity:1.0;
            }
            a button{
                width:250px;
                padding:10px;
                font-size:12pt;
                border-style:none;
                border-radius:3px;
                margin:2px;
            }
            .msgbox{
                margin-top:95px;
            }
            .centerbox table{
                width:100%;
            }
            .centerbox table td{
                background-color:rgba(255,255,255,0.2);
                padding:3px;
            }
            .centerbox table tr td:first-child{
                text-align:right;
                font-weight:bold;
            }
            #nc{
                position:absolute;
                width:200px;
                height:140px;
                margin-left:-100px;
                margin-top:-254px;
                left:50%;
                top:50%;
                z-index:1000;
            }
            #os{
                position:absolute;
                bottom:0px;
                left:0px;
                width:200px;
            }
            @font-face{
                font-family: "Open Sans Light";
                src: url(OpenSans-Light.ttf);
            }
        </style>
    </head>
    <body>
    <img src="nyan-cat.gif" id="nc"></img>
    <img src="oshino.png" id="os"></img>
<?php
session_start();
$page = $_GET['p'];
$logins = [
    'user'=>[
            'password'=>'user',
            'name'=>'Evil User Z. Damaso',
            'age'=>"32",
            'bdate'=>"8/19/1983"
        ],
    'admin'=>[
            'password'=>'adminadmin',
            'name'=>'Good Guy A. Dmin',
            'age'=>"24",
            'bdate'=>"9/21/2046"
        ]];

switch($page){
    case "processlogin":
        $user = $_POST["username"];
        if($logins[$user]["password"] == $_POST["password"]) {
            $_SESSION["user"] = $user;
            echo '<div class="centerbox"><div class="msgbox">You have logged in successfully! :D</div></div>';
            echo '<script> setTimeout(function(){window.location="?p=home";}, 2000); </script>';
        }
        else echo ('<div class="centerbox"><div class="msgbox">Oh my, you entered an invalid account combination.<br><a href="?p=login">Try again.</a></div></div><script> setTimeout(function(){window.location="?p=login";}, 2000); </script>');
    break;
    case "login":
        if(!isset($_SESSION["user"])){
        echo <<<LEL
        <form class="centerbox" id="login" action="?p=processlogin" method="post">
            <div class="header">Evil Login Thingy</div>
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Login">
        </form>
LEL;
    } else {
        echo '<div class="centerbox"><div class="msgbox"> Oh my, you are already logged in.</div></div>';
        echo '<script> setTimeout(function(){window.location="?p=home";}, 2000); </script>';
    }
    break;
    case "logout":
        session_destroy();
        echo '<div class="centerbox"><div class="msgbox">You have logged out successfully! :D</div></div>';
        echo '<script> setTimeout(function(){window.location="?p=home";}, 2000); </script>';
    break;
    case "admin":
        if($_SESSION["user"] == admin || !isset($_GET["doauth"]))
        echo '<div class="centerbox">Welcome to the Administration Control Panel<br>
            <a><button>Add Account</button></a>
            <a><button>Remove Account</button></a>
            <a><button>Update User</button></a>
            <a href="?p=home"><button>Disconnect from the Matrix</button></a>
        </div>';
        else echo '<div class="centerbox">You are not an authorized user.</div><script> setTimeout(function(){window.location="?p=home";}, 2000); </script>';

    break;
    case "profile":
        $u = $logins[$_GET["id"]];
        if(isset($u)){
            echo <<<MEW
            <div class="centerbox">
                <table>
                    <tr><td>Name</td><td>{$u['name']}</td></tr>
                    <tr><td>Age</td><td>{$u['age']}</td></tr>
                    <tr><td>Birth date</td><td>{$u['bdate']}</td></tr>
                </table>
                <a href="?p=home"><button>Return</button></a>
            </div>
MEW;
        } else {
            echo '<div class="centerbox">User does not existifiedificationalismicity. :(</div>';
        }

    break;
    default:
    case "home":
        if(!isset($_SESSION["user"])){
            echo '<div class="centerbox"><div class="header">Welcome stranger. :D<br></div>' . "\n";
            echo '<a href="?p=login">Login Here</a><br></div>' . "\n";
        } else {
            echo '<div class="centerbox"><div class="header">Welcome ' . $_SESSION["user"] . '. :D<br></div>' . "\n";
            if($_SESSION["user"] == "admin") echo('<a href="?p=admin"><button>Administration Control Panel</button></a><br>' . "\n");
            echo '<a href="?p=profile&id=' . $_SESSION["user"] . '"><button>Profile</button></a>' . "\n";
            echo '<a href="?p=logout"><button>Logout</button></a></div></div>' . "\n";
        }
}
?>
    </body>
</html>
