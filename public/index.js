let app = require('express')();
let http = require('http').createServer(app);
let io = require('socket.io')(http);
let channelId = '';
let mysql = require('mysql');

io.on('connection', function(socket){
    let conn = mysql.createConnection({
        database: 'books',
        host: "192.168.0.22",
        user: "root",
        password: ""
    });

    socket.on('disconnect', function(){
        socket.leave(channelId);
        console.log('user disconnected from the room ' + channelId);
    });
    socket.on('join', function(channel) {
        channelId = channel;
        socket.join(channelId);

        conn.connect(function(err) {
            if (err) {
                throw err;
            }
            console.log("Connected!");
        });

        console.log('a user connected to the room ' + channelId);
    });
    socket.on('chat message', function(userId, msg, login) {
        let time = new Date().toLocaleString();
        let sql = "INSERT INTO messages (channel_id, user_id, body, last_read, deleted_at, created_at, updated_at)" +
            "values (" + channelId + ", " + userId + ", '" + msg + "', 0, null, '" + time + "', null)";
        conn.query(sql, function(err, results) {
            if (err) throw err;
            console.log("Insert a record!");
        });


        io.sockets.to(channelId).emit('chat message', msg, login, time);
    });
});

http.listen(8080, function(){
    console.log('listening on *:8080');
});
