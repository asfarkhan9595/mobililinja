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

    // Create session for handling calls
    var session;

    // Register event handlers
    userAgent.on('registered', function () {
        setStatus('Ready');
    });

    userAgent.on('unregistered', function () {
        setStatus('Not Registered');
    });

    userAgent.on('registrationFailed', function () {
        setStatus('Registration Failed');
    });

    userAgent.on('connecting', function () {
        setStatus('Connecting...');
    });

    userAgent.on('connected', function () {
        setStatus('Connected');
    });

    userAgent.on('disconnected', function () {
        setStatus('Disconnected');
    });

    // Call function
    window.startCall = function () {
        var target = document.getElementById('target').value;
        if (target) {
            session = userAgent.invite(target, {
                media: {
                    constraints: {
                        audio: true,
                        video: true,
                    },
                    render: {
                        remote: document.getElementById('remoteVideo'),
                        local: document.getElementById('localVideo'),
                    },
                },
            });
            setStatus('Calling...');
        }
    };

    // Hang up function
    window.hangup = function () {
        if (session) {
            session.bye();
            session = null;
            setStatus('Call Ended');
        }
    };

    // Function to set status
    function setStatus(status) {
        document.getElementById('status').innerHTML = status;
    }
});
