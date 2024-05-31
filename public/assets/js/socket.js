const conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e) {
//     print the echo message from the server
    console.log("Connection established!");
    conn.send("Hello World");
};

conn.onmessage = function(e) {
    console.log(e.data);
};