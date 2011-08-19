<?php
/* Compatible with TrinityCore       *
 * (c) 2011 Wheth <whethx@gmail.com> */

// Script work status: Done. //
// Features: SQL-Injection protected, IP check, user-inserted data validation, limit 8-16 username/password and 8-30 email, check for esisting user/email. //

if (!$_POST) {
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Expansion</td>
                <td><select name="expansion"><option value="wotlk">Wrath of the Lich King</option><option value="tbc">The Burning Crusade</option><option value="classic">Classic</option></select></td>
            </tr>
            <tr>
                <td colspan=2><input type="submit" value="Register"></td>
            </tr>
        </table>
    </form>
<?php
} else {
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $email = mysql_real_escape_string($_POST['email']);
    $expansion = mysql_real_escape_string($_POST['expansion']);
    $pattern = "/[^a-z0-9]/i";
    $patternemail = "/[^a-zA-Z0-9@\-_.]/";
    if (preg_match($pattern, $username) != 1) {
        if (preg_match($pattern, $password) != 1) {
            if (preg_match($patternemail, $email) != 1) {
                if ((strlen($username) >= 8) && (strlen($username) <= 16)) {
                    if ((strlen($password) >= 8) && (strlen($password) <= 16)) {
                        if ((strlen($email) >= 5) && (strlen($email) <= 30)) {
                            if (($expansion == 'classic') || ($expansion == 'tbc') || ($expansion == 'wotlk')) {
                                $query1 = $database->query("SELECT * FROM ".$config['auth_database'].".account WHERE username = \"".$username."\"");
                                if (!$query1) {
                                    echo 'Database error.';
                                } else {
                                    $rows1 = $database->rows($query1);
                                    if ($rows1 == 0) {
                                        $query2 = $database->query("SELECT * FROM ".$config['auth_database'].".account WHERE email = \"".$email."\"");
                                        if (!$query2) {
                                            echo 'Database error.';
                                        } else {
                                            $rows2 = $database->rows($query2);
                                            if ($rows2 == 0) {
                                                $ip = $_SERVER['REMOTE_ADDR'];
                                                $query3 = $database->query("SELECT * FROM ".$config['auth_database'].".account WHERE last_ip = \"".$ip."\"");
                                                if (!$query3) {
                                                    echo 'Database error.';
                                                } else {
                                                    $rows3 = $database->rows($query3);
                                                    if ($rows3 == 0) {
                                                        switch ($expansion) {
                                                            case 'wotlk':
                                                                $expansion = 2;
                                                            break;
                                                            case 'tbc':
                                                                $expansion = 1;
                                                            break;
                                                            case 'classic':
                                                                $expansion = 0;
                                                            break;
                                                            default:
                                                                $expansion = 0;
                                                            break;
                                                        }
                                                        $passhash = strtoupper(sha1(strtoupper($username).':'.strtoupper($password)));
                                                        $username = strtoupper($username);
                                                        $email = strtolower($email);
                                                        $query3 = $database->query("INSERT INTO ".$config['auth_database'].".account (username, sha_pass_hash, email, expansion) VALUES (\"".$username."\", \"".$passhash."\", \"".$email."\", ".$expansion.")");
                                                        if (!$query3) {
                                                            echo 'Database error.';
                                                        } else {
                                                            echo "Account created.";
                                                        }
                                                    } else {
                                                        echo 'Your ip has already registered an account.';
                                                    }
                                                }
                                            } else {
                                                echo 'This email is already in use.';
                                            }
                                        }
                                    } else {
                                        echo 'This username is already in use.';
                                    }
                                }
                            } else {
                                echo 'The expansion is not valid.';
                            }
                        } else {
                            echo "The email must be composed by a minimum of 8 characters and a maximum of 30 characters.";
                        }
                    } else {
                        echo "The password must be composed by a minimum of 8 and a maximum of 16 characters.";
                    }
                } else {
                    echo "The username must be composed by a minimum of 8 and a maximum of 16 characters.";
                }
            } else {
                echo "The email contains forbidden characters. The only characters allowed are A-Z a-z 0-9 . @ _ -.";
            }
        } else {
            echo "The password contains forbidden characters. The only characters allowed are A-Z a-z 0-9.";
        }
    } else {
        echo "The username contains forbidden characters. The only characters allowed are A-Z a-z 0-9.";
    }
}
?>
<br><br><br><br><br><hr><small>Coded by <a href="mailto:whethx@gmail.com">Wheth</a></small>