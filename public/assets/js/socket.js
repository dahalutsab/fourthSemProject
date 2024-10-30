let socket = new WebSocket('wss://openmichub.onrender.com:8909');

if (!socket) {
    socket = new WebSocket('ws://localhost:8909');
}

socket.onopen = function() {
    console.log('WebSocket connection opened');
};

socket.onmessage = function(event) {
    console.log('Message received: ', event.data);
};

socket.onclose = function() {
    console.log('WebSocket connection closed');
};

socket.onerror = function(error) {
    console.log('WebSocket error: ', error);
};