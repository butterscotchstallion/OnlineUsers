<html><head>
    <title>Online Users Example</title>
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
            require 'lib/config.php';
            require 'lib/User.class.php';
            $connection = GetConnection();
            $u          = new User($connection);
            $users      = $u->FetchOnlineUsers();
            foreach( $users as $u )
            {
                ?>
                <tr>
                    <td><?php echo $u->sessionID;?></td>
                    <td><?php echo $u->lastSeen;?></td>
                </tr>
                <?php
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