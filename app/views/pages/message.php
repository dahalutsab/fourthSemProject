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
        .list-group-item {
            border-color: #ddd;
        }
        .list-group-item:hover {
            background-color: #f0f2f5;
            cursor: pointer;
        }
        .nav-tabs .nav-link {
            color: #333;
            border: none;
        }
        .nav-tabs .nav-link.active {
            background-color: #f0f2f5;
            border-bottom-color: transparent;
        }
    </style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <ul class="nav nav-tabs mb-3" id="userTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="allUsersTab" data-bs-toggle="tab" data-bs-target="#allUsers" type="button" role="tab" aria-controls="allUsers" aria-selected="true">All Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="myChatsTab" data-bs-toggle="tab" data-bs-target="#myChats" type="button" role="tab" aria-controls="myChats" aria-selected="false">My Chats</button>
                </li>
            </ul>
            <div class="tab-content" id="userTabContent">
                <div class="tab-pane fade show active" id="allUsers" role="tabpanel" aria-labelledby="allUsersTab">
                    <div class="list-group" id="allUsersList">
                        <!-- All users will be populated here -->
                    </div>
                </div>
                <div class="tab-pane fade" id="myChats" role="tabpanel" aria-labelledby="myChatsTab">
                    <div class="list-group" id="myChatsList">
                        <!-- My chats will be populated here -->
                    </div>
                </div>
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

<script>
    $(document).ready(function() {
        const sessionUserId = <?= $_SESSION[SESSION_USER_ID] ?>;
        let selectedUserId = null;

        // Function to fetch messages between users
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

        // Function to fetch all users for "All Users" tab
        function fetchAllUsers() {
            $.ajax({
                url: '/api/getAllUsers',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const users = response.data;
                        let allUsersHtml = '';
                        users.forEach(user => {
                            if (user.id !== sessionUserId) {
                                allUsersHtml += `<a href="#" class="list-group-item list-group-item-action" data-user-id="${user.id}">${user.username}</a>`;
                            }
                        });
                        $('#allUsersList').html(allUsersHtml);
                    }
                }
            });
        }

        // Function to fetch my chats for "My Chats" tab
// Function to fetch my chats for "My Chats" tab
        function fetchMyChats() {
            $.ajax({
                url: '/api/getMyChats',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        const chats = response.data;
                        let myChatsHtml = '';
                        chats.forEach(chat => {
                            myChatsHtml += `<a href="#" class="list-group-item list-group-item-action" data-user-id="${chat.id}">${chat.username}</a>`;
                        });
                        $('#myChatsList').html(myChatsHtml);
                        // Select the first user in the list
                        const firstUser = $('#myChatsList .list-group-item').first();
                        if (firstUser.length > 0) {
                            selectedUserId = firstUser.data('user-id');
                            $('#chatHeader').text(`Chatting with ${firstUser.text()}`);
                            fetchMessages();
                        }
                    }
                }
            });
        }
        // WebSocket initialization
        const socket = new WebSocket('ws://localhost:8080');

        // WebSocket event listeners
        socket.onopen = function() {
            console.log('Connected to WebSocket server');
        };

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

        socket.onerror = function(error) {
            console.error('WebSocket error:', error);
        };

        // Send message function
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

        // Handle user selection from user lists
        $('#userTabContent').on('click', '.list-group-item', function() {
            selectedUserId = $(this).data('user-id');
            $('#chatHeader').text(`Chatting with ${$(this).text()}`);
            fetchMessages();
        });

        // Initial fetch for "All Users" tab
        fetchAllUsers();

        // Switch tabs event handling
        $('#allUsersTab').on('shown.bs.tab', function() {
            fetchAllUsers();
        });

        $('#myChatsTab').on('shown.bs.tab', function() {
            fetchMyChats();
        });

        // Function to open a specific chat from URL parameter
        function openSpecificChat(user_id) {
            selectedUserId = user_id;
            fetchMessages();
            $('#userTabs a[href="#myChats"]').tab('show');
            $('#chatHeader').text(`Chatting with ${$('#myChatsList').find(`[data-user-id="${user_id}"]`).text()}`);
        }

        // Check for user_id parameter in the URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('user_id')) {
            const user_id = parseInt(urlParams.get('user_id'));
            openSpecificChat(user_id);
        }
    });
</script>
