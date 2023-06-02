
; /* Start:"a:4:{s:4:"full";s:83:"/local/components/custom/index.places/templates/.default/script.min.js?168546165020";s:6:"source";s:66:"/local/components/custom/index.places/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
console.log("qwer");
/* End */
;
; /* Start:"a:4:{s:4:"full";s:83:"/local/components/custom/index.contacts/templates/.default/script.js?16845183751085";s:6:"source";s:68:"/local/components/custom/index.contacts/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
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
/* End */
;; /* /local/components/custom/index.places/templates/.default/script.min.js?168546165020*/
; /* /local/components/custom/index.contacts/templates/.default/script.js?16845183751085*/
