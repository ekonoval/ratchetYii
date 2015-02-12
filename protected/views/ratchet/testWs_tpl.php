<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>yii test ws</title>

    <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>

    <script>
        var conn = new ab.Session(
            //'ws://localhost:8080',
            'ws://test.dev:8080',
            function() {
                console.log('ab ws connected');
                conn.subscribe('chatMsgSend', function(topic, data) {
                    console.log('Chat msg has been sent:' + topic );
                    console.log(data);
                });

                conn.subscribe('figureMove', function(topic, data) {
                    console.log('Figure has been moved:' + topic );
                    console.log(data);
                });
            },
            function() {
                console.warn('WebSocket connection closed1');
            },
            {'skipSubprotocolCheck': true}
        );
    </script>
</head>
<body>
    <h2>See console log...</h2>


</body>
</html>