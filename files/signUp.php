<html>
    <head>
        <title>

        </title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script  type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script  type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
        <script  type="text/javascript" src="alerts/jquery.alerts.js"></script>
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <link rel='stylesheet' href='./files/lessons.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./alerts/jquery.alerts.css' type='text/css' media='all'/>
    </head>
    <body>
        <header id="titleHeader">
            <h1><img src="turtles.png" alt="צב במשקפיים">
            <?php
                 echo _("Turtle Academy - User Registration");
            //        אקדמיית הצב                    
             ?> 
            </h1>
        </header>
        <?php
            $m = new Mongo();
            // select a database
            $db = $m->turtleTestDb;
            // select a collection (analogous to a relational database's table)
            $lessons = $db->users;
        ?>
        <div id="container" >
        <h2>Create Account</h2>
        <form accept-charset="UTF-8" action="/register" class="new_user" id="new_user" method="post">
            <table style="width:90%; margin:auto">
                <tbody>
                    <tr>
                        <td>
                            <label for="user_email">Email</label>
                        </td>
                        <td>
                            <input id="user_email" name="user[email]" placeholder="Email" size="30" type="email">
                            <div class="email_suggestion">
                                <a class="email"></a>
                            </div>
                        </td>
                    </tr>
                    <tr class="set_username">
                        <td>
                            <label for="user_username">Username</label>
                        </td>
                        <td class="username">
                            <input id="user_username" name="user[username]" placeholder="Username" size="30" type="text">
                        </td>
                        <td>
                            <div>
                                <span class="available" style="display: none; ">Available</span>
                                <span class="taken" style="display: none; ">Taken</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="user_password">Password</label>
                        </td>
                        <td>
                            <input id="user_password" name="user[password]" placeholder="Password" size="30" type="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="user_password_confirmation">Password confirmation</label>
                        </td>
                        <td>
                            <input id="user_password_confirmation" name="user[password_confirmation]" placeholder="Password confirmation" size="30" type="password">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" id="btnSaveLesson" class="lessonInputButton" name="formSave" value="Save" />
        </form>
        </div>
