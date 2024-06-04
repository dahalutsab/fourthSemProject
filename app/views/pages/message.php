<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        .card {
            height: 500px;
        }
        .card-body {
            overflow-y: scroll;
            height: 400px;
        }

        .card-footer {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .message {
            display: flex;
            margin-bottom: 15px;
        }

        .message.left {
            justify-content: flex-start;
        }

        .message.right {
            justify-content: flex-end;
        }

        .message-bubble {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 20px;
            position: relative;
        }

        .message.left .message-bubble {
            background-color: #e9ecef;
            color: #000;
            border-top-left-radius: 0;
        }

        .message.right .message-bubble {
            background-color: #007bff;
            color: white;
            border-top-right-radius: 0;
        }

        .message-text {
            margin: 0;
        }

        .message-time {
            font-size: 0.8em;
            margin-top: 5px;
            color: rgba(0, 0, 0, 0.5);
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="list-group" id="userList">
                <!-- User list will be populated here -->
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 id="chatHeader">Select a user to chat</h5>
                </div>
                <div class="card-body" id="chatBody">
                    <!-- Messages will be displayed here -->
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" id="messageInput" class="form-control" placeholder="Type a message">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="sendMessageButton">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        const sessionUserId = <?= $_SESSION[SESSION_USER_ID] ?>;
        let selectedUserId = null;

        // Fetch and display user list
        function fetchUsers() {
            $.ajax({
                url: '/api/getAllUsers',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const users = response.data;
                        let userListHtml = '';
                        users.forEach(user => {
                            if (user.id !== sessionUserId) {
                                userListHtml += `<a href="#" class="list-group-item list-group-item-action" data-user-id="${user.id}">${user.username}</a>`;
                            }
                        });
                        $('#userList').html(userListHtml);
                    }
                }
            });
        }

        // Fetch and display messages
        function fetchMessages() {
            if (selectedUserId) {
                $.ajax({
                    url: '/api/getMessagesBetweenUsers',
                    method: 'GET',
                    data: { user1_id: sessionUserId, user2_id: selectedUserId },
                    success: function(response) {
                        if (response.success) {
                            const messages = response.data;
                            let chatBodyHtml = '';
                            messages.forEach(message => {
                                const align = message.sender_id === sessionUserId ? 'right' : 'left';
                                chatBodyHtml += `<div class="message ${align}">
                                                    <div class="message-bubble">
                                                        <div class="message-text">${message.content}</div>
                                                        <div class="message-time">${new Date(message.timestamp).toLocaleTimeString()}</div>
                                                    </div>
                                                 </div>`;
                            });
                            $('#chatBody').html(chatBodyHtml);
                            $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
                        }
                    }
                });
            }
        }

        const socket = new WebSocket('ws://localhost:8080');

        // Handle WebSocket connection open
        socket.onopen = function() {
            console.log('Connected to the server');
        };

        // Handle WebSocket message
        socket.onmessage = function(event) {
            const message = JSON.parse(event.data);
            if (message.sender_id === selectedUserId || message.receiver_id === selectedUserId) {
                const align = message.sender_id === sessionUserId ? 'right' : 'left';
                const chatBodyHtml = `<div class="message ${align}">
                                        <div class="message-bubble">
                                            <div class="message-text">${message.content}</div>
                                            <div class="message-time">${new Date(message.timestamp).toLocaleTimeString()}</div>
                                        </div>
                                      </div>`;
                $('#chatBody').append(chatBodyHtml);
                $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
            }
        };

        // Handle WebSocket error
        socket.onerror = function(error) {
            console.error('WebSocket error:', error);
        };

        // Send message
        $('#sendMessageButton').on('click', function() {
            const messageContent = $('#messageInput').val();
            if (messageContent && selectedUserId) {
                const message = {
                    sender_id: sessionUserId,
                    receiver_id: selectedUserId,
                    content: messageContent,
                    timestamp: new Date().toISOString()
                };
                socket.send(JSON.stringify(message));
                $('#messageInput').val('');
                const chatBodyHtml = `<div class="message right">
                                        <div class="message-bubble">
                                            <div class="message-text">${messageContent}</div>
                                            <div class="message-time">${new Date(message.timestamp).toLocaleTimeString()}</div>
                                        </div>
                                      </div>`;
                $('#chatBody').append(chatBodyHtml);
                $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
            }
        });

        // Handle user selection
        $('#userList').on('click', '.list-group-item', function() {
            selectedUserId = $(this).data('user-id');
            $('#chatHeader').text(`Chatting with ${$(this).text()}`);
            fetchMessages();
        });

        // Initial fetch
        fetchUsers();
    });
</script>
</body>
</html>
