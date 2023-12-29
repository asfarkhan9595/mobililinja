document.addEventListener('DOMContentLoaded', function () {
    // SIP.js configuration
    var configuration = {
        uri: 'sip:3582720500@vaihde.contakti.com',
        authorizationUser: '3582720500',
        password: '67ece7434d1e6b372328a914b63660303',
        wsServers: 'wss://vaihde.contakti.com:8089/0/ws',
        traceSip: true,
        log: {
            level: 3,
        },
    };

    // Create SIP.js user agent
    var userAgent = new SIP.UA(configuration);

    // Register event handlers
    userAgent.on('message', function (message) {
        receiveMessage(message.remoteIdentity.displayName, message.body);
    });

    // Function to send a message
    window.sendMessage = function () {
        var inputMessage = document.getElementById('inputMessage');
        var messageText = inputMessage.value.trim();
        if (messageText) {
            var target = 'sip:destination_user@destination_sip_domain';
            var message = userAgent.message(target, messageText);
            sendMessageToUI('You', messageText);
            inputMessage.value = '';
        }
    };

    // Function to receive and display a message
    function receiveMessage(sender, message) {
        sendMessageToUI(sender, message);
    }

    // Function to display a message in the UI
    function sendMessageToUI(sender, message) {
        var messagesDiv = document.getElementById('messages');
        var messageDiv = document.createElement('div');
        messageDiv.innerHTML = '<strong>' + sender + ':</strong> ' + message;
        messagesDiv.appendChild(messageDiv);
        // Scroll to the bottom to show the latest message
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }
});
