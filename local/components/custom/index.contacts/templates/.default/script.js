BX.ready(function () {

    const nameInput = document.getElementById('contacts-form-name')
    const emailInput = document.getElementById('contacts-form-email')
    const messageInput = document.getElementById('contacts-form-message')

    document.getElementById('contacts-send-btn').addEventListener('click', function () {

        BX.ajax.runComponentAction(
            'custom:index.contacts',
            'sendMessage',
            {
                mode: 'class',
                data: {
                    post: {
                        name: nameInput.value,
                        email: emailInput.value,
                        message: messageInput.value,
                    }
                }
            }).then((response) => {

                myAlert(response.data.message, response.data.type);

                if(response.data.type === 'success'){
                    messageInput.value = '';
                }

        }).catch(e => {
            console.log(e)
        });


    });


})