const socket = new WebSocket('ws://localhost:8080');

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