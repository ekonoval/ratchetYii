<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>yii test ws</title>

    <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>

    <script>
        var conn = new ab.Session('ws://localhost:8080',
            function() {
                console.log('ab ws connected');
                conn.subscribe('kittensCategory', function(topic, data) {
                    // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
                    console.log('New article published to category "' + topic + '" : ' + data.title);
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