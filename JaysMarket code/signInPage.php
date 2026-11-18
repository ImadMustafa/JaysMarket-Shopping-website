<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(43,48,53,255);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 300px;
            box-sizing: border-box;
        }
        .logo {
            margin-bottom: 1em;
        }
        .container form {
            margin-top: 1em;
        }
        .container table {
            width: 100%;
            margin: auto;
        }
        .container td {
            padding: 0.5em;
            font-size: 1em;
        }
        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 0.5em;
            margin: 0.5em 0;
            border: 1px solid rgba(43,48,53,255);
            border-radius: 4px;
            box-sizing: border-box;
        }
        .container input[type="submit"] {
            background-color: rgb(129, 193, 236);
            color: rgba(43,48,53,255);
            border: none;
            padding: 0.75em 1.5em;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            margin-top: 1em;
            width: 100%;
            box-sizing: border-box;
        }
        .container input[type="submit"]:hover {
            background-color: rgba(129, 193, 236, 0.8);
        }
        .container a {
            color: rgba(43,48,53,255);
            text-decoration: none;
            font-size: 0.9em;
            display: block;
            margin-top: 1em;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .container #errorMessage {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="logo">
        <a href="index.php"><img src="images/site/logo.png" width="200" alt="Logo"></a>
    </div>
    <div class="container">
        <form name="loginForm" action="login.php" method="POST" onsubmit="return validateForm()">
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="useremail"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="userpassword"></td>
                </tr>
                <tr>
                    <td colspan="2" id="errorMessage"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Log in"></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="addUserPage.php">Make a new account</a></td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        function validateForm() {
            var email = document.forms["loginForm"]["useremail"].value;
            var password = document.forms["loginForm"]["userpassword"].value;

            if (email === "" || password === "") {
                document.getElementById("errorMessage").innerHTML = "Please fill in both email and password fields";
                return false;
            }
        }
    </script>
</body>
</html>
