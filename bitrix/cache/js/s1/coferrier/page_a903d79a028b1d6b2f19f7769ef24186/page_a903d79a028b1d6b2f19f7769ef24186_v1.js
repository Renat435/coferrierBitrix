
; /* Start:"a:4:{s:4:"full";s:75:"/local/components/custom/basket/templates/.default/script.js?16874813381598";s:6:"source";s:60:"/local/components/custom/basket/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    document.querySelectorAll('.basket__info-list-item-info-price-block').forEach(item => {
        const minus = item.querySelector('.basket__info-list-item-info-price-block-minus');
        const plus = item.querySelector('.basket__info-list-item-info-price-block-plus');
        const counter = item.querySelector('.basket__info-list-item-info-price-block-counter');

        console.log(minus, plus, counter);
    });

    // const nameInput = document.getElementById('contacts-form-name')
    // const emailInput = document.getElementById('contacts-form-email')
    // const messageInput = document.getElementById('contacts-form-message')
    //
    // document.getElementById('contacts-send-btn').addEventListener('click', function () {
    //
    //     BX.ajax.runComponentAction(
    //         'custom:index.contacts',
    //         'sendMessage',
    //         {
    //             mode: 'class',
    //             data: {
    //                 post: {
    //                     name: nameInput.value,
    //                     email: emailInput.value,
    //                     message: messageInput.value,
    //                 }
    //             }
    //         }).then((response) => {
    //
    //             myAlert(response.data.message, response.data.type);
    //
    //             if(response.data.type === 'success'){
    //                 messageInput.value = '';
    //             }
    //
    //     }).catch(e => {
    //         console.log(e)
    //     });
    //
    //
    // });


})
/* End */
;; /* /local/components/custom/basket/templates/.default/script.js?16874813381598*/
