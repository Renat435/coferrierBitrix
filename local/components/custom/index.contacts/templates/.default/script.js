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
            console.log(response);
            // if(response.data){
            //     location.reload();
            // } else{
            //     alert('Неверный логин или пароль');
            // }
        }).catch(e => {
            console.log(e)
        });


    });


})