<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chat - ONEUTM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="icon.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

   @include('partials.head')
   @include('partials.header')

    <!-- Chat Container -->
    <div class="flex flex-col h-screen">
        <!-- Chat Header -->
        <div id="chat-header" class="bg-white shadow-md py-3 px-6 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-primary">Chat</h1>
            </div>
            <p class="text-gray-500">Connected</p>
        </div>

        <!-- Chat Area -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <div class="w-1/4 bg-gray-100 p-4 border-r border-gray-300 hidden md:block">
                <h2 class="text-lg font-bold mb-4 text-primary">Sellers</h2>
                <ul class="space-y-2">
                    <li id="user-1-btn" class="flex items-center p-2 bg-gray-200 rounded cursor-pointer hover:bg-gray-300">
                        <img src="https://media.karousell.com/media/photos/products/2024/10/1/partial_perfume_for_sale_1727823509_26b16227_progressive.jpg" alt="User 1" class="w-20 h-20 rounded-full mr-2">
                        <span>Seller 1</span>
                    </li>
                    <li id="user-2-btn" class="flex items-center p-2 bg-gray-200 rounded cursor-pointer hover:bg-gray-300">
                        <img src="https://media.karousell.com/media/photos/products/2024/1/17/preloved_nike_air_jordan_1_hig_1705482027_52e86c8f_progressive.jpg" alt="User 2" class="w-20 h-20 rounded-full mr-2">
                        <span>Seller 2</span>
                    </li>
                    <li id="user-3-btn" class="flex items-center p-2 bg-gray-200 rounded cursor-pointer hover:bg-gray-300">
                        <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//100/MTA-61782472/no-brand_no-brand_full01.jpg" alt="User 3" class="w-20 h-20 rounded-full mr-2">
                        <span>Seller 3</span>
                    </li>
                </ul>
            </div>

            <!-- Chat Box -->
            <div class="flex-1 bg-white flex flex-col">
                <!-- Chat Header Name -->
                <div id="chat-name" class="p-4 bg-white border-b border-gray-300 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-primary">Seller 1</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Product Details -->
                        <div class="text-right">
                            <p class="text-gray-700 font-semibold">Perfume for Sale</p>
                            <p class="text-gray-500 text-sm">RM 210</p>
                        </div>
                        <!-- Product Image -->
                        <img 
                            id="product-image" 
                            src="https://media.karousell.com/media/photos/products/2024/10/1/partial_perfume_for_sale_1727823509_26b16227_progressive.jpg" 
                            alt="Product Image" 
                            class="w-16 h-16 rounded-lg object-cover"
                        >
                    </div>
                </div>

                <!-- Messages -->
                <div id="chat-messages" class="flex-1 p-4 overflow-y-auto flex flex-col">
                    <!-- Messages will be dynamically loaded here -->
                </div>

                <!-- Input Area -->
                <div class="p-4 bg-gray-100 border-t border-gray-300">
                    <div class="flex items-center space-x-2">
                        <!-- Sender Selector -->
                        <select id="sender-selector" class="w-40 border border-gray-300 rounded-lg p-2">
                            <option value="user1">Send as Buyer</option>
                            <option value="user2">Send as Seller</option>
                        </select>

                        <!-- Message Input -->
                        <input 
                            id="message-input" 
                            type="text" 
                            placeholder="Type a message..." 
                            class="flex-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-400"
                        >

                        <!-- Send Button -->
                        <button id="send-button" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chat-messages');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');
        const senderSelector = document.getElementById('sender-selector');
        const chatName = document.getElementById('chat-name');

        const products = {
            user1: {
                name: 'Perfume for Sale',
                price: 'RM 210',
                image: 'https://media.karousell.com/media/photos/products/2024/10/1/partial_perfume_for_sale_1727823509_26b16227_progressive.jpg'
            },
            user2: {
                name: 'Nike Air Jordan 1',
                price: 'RM 340',
                image: 'https://media.karousell.com/media/photos/products/2024/1/17/preloved_nike_air_jordan_1_hig_1705482027_52e86c8f_progressive.jpg'
            },
            user3: {
                name: 'Buku Programming Matlab',
                price: 'RM 5',
                image: 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//100/MTA-61782472/no-brand_no-brand_full01.jpg'
            }
        };

        const messages = {
            user1: [
                { sender: 'user1', text: 'Hey bro, is this item still available?', time: '12:00 PM' },
                { sender: 'user2', text: 'Hey! Yes, it is still available. Are you interested?', time: '12:01 PM' }
            ],
            user2: [
                { sender: 'user1', text: 'Can we negotiate?', time: '1:00 PM' }
            ],
            user3: [
                { sender: 'user1', text: 'Hi, nak lock dulu boleh ?', time: '2:30 PM' }
            ]
        };

        let currentUser = 'user1';

        const renderMessages = () => {
            chatMessages.innerHTML = '';
            messages[currentUser].forEach(msg => {
                const messageBubble = document.createElement('div');
                messageBubble.classList.add('flex', 'items-start', 'mb-4');
                if (msg.sender === 'user2') {
                    messageBubble.classList.add('flex-row-reverse');
                }

                const bubbleContent = `
                    <div class="${msg.sender === 'user1' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-900'} p-3 rounded-lg max-w-xs">
                        <p>${msg.text}</p>
                    </div>
                    <span class="text-sm text-gray-500 ${msg.sender === 'user1' ? 'ml-2' : 'mr-2'}">${msg.time}</span>
                `;
                messageBubble.innerHTML = bubbleContent;
                chatMessages.appendChild(messageBubble);
            });

            chatMessages.scrollTop = chatMessages.scrollHeight;
        };

        const addMessage = (text, sender) => {
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            messages[currentUser].push({ sender, text, time });
            renderMessages();
        };

        const updateProductDetails = (userId) => {
            const productName = chatName.querySelector('.text-right p:first-child');
            const productPrice = chatName.querySelector('.text-right p:last-child');
            const productImage = document.getElementById('product-image');

            productName.textContent = products[userId].name;
            productPrice.textContent = products[userId].price;
            productImage.src = products[userId].image;
        };

        sendButton.addEventListener('click', () => {
            const message = messageInput.value.trim();
            if (message === '') return;

            const sender = senderSelector.value;
            addMessage(message, sender);
            messageInput.value = '';
        });

        messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendButton.click();
            }
        });

        document.getElementById('user-1-btn').addEventListener('click', () => {
            currentUser = 'user1';
            chatName.querySelector('h2').textContent = 'Seller 1';
            updateProductDetails('user1');
            renderMessages();
        });

        document.getElementById('user-2-btn').addEventListener('click', () => {
            currentUser = 'user2';
            chatName.querySelector('h2').textContent = 'Seller 2';
            updateProductDetails('user2');
            renderMessages();
        });

        document.getElementById('user-3-btn').addEventListener('click', () => {
            currentUser = 'user3';
            chatName.querySelector('h2').textContent = 'Seller 3';
            updateProductDetails('user3');
            renderMessages();
        });

        renderMessages();
    </script>
</body>
</html>
