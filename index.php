<?php session_start(); ?>
<html><head>
    <title>Online Users Example</title>
    <style type="text/css">
        body {
            font-family: verdana, arial, sans-serif;
            font-size: 76%;
            color: #222;
            background-color: #fff;
        }
        
        #online {
            width: 50%;
        }
            #online th {
                text-align: left;
                font-family: georgia, arial, sans-serif;
                padding-left: 1em;
            }
            
            #online td {
                padding: 1em;
            }
    </style>
</head><body>

<table id="online">
    <thead>
        <tr>
            <th>Identifier</th>
            <th>Last seen</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require dirname(__FILE__) . '/lib/config.php';
            require dirname(__FILE__) . '/lib/User.class.php';
            $connection = GetConnection();
            $u          = new User($connection);
            $u->Update(session_id(), $_SERVER['HTTP_USER_AGENT']);
            $users      = $u->FetchOnlineUsers();
            if( $users )
            {
                foreach( $users as $u )
                {
                    ?>
                    <tr>
                        <td><?php echo $u->sessionID;?></td>
                        <td><?php echo $u->lastSeen;?></td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?><tr><td colspan="2">No users online in the last 5 minutes</td></tr><?php
            }
        ?>
    </tbody>
</table>

<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="/sandbox/OnlineUsers/lib/socket.io/socket.io.js"></script>

<script>
    function getResponse() {
        $.ajax({
            cache : false,
            // setup the server address
            url : 'http://prgmrbill.com:8124/',
            data : {},
            success : function(response, code, xhr) {
     
                if ( 'OK' == response ) 
                {
                    getResponse();
                    return false;
                }
     
                // do whatever you want with the response
                $('#outputUL').prepend('<li>' + response + '</li>');
     
                // make new call
                getResponse();
            },
            error : function(response, code) {
                console.log(response);
            }
        });
    }
        
    $(document).ready(function() {
        //getResponse();
    });
</script>
-->

</body></html>