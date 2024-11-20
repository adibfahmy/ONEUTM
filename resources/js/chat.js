window.Echo.private(`chat.${conversationId}`)
    .listen("MessageSent", (event) => {
        console.log(event.message);
        // Update the chat UI with the new message
    });
