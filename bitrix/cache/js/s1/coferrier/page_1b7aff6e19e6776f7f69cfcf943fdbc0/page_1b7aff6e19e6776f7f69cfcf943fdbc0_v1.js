
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16861466591095";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    const btn = document.getElementById('profile-change-btn');

    let inputs = document.querySelectorAll('.profile__change-info-input');

    let inputsValue = [];


    for (let i = 0; i < inputs.length; i++){

        let item = inputs[i];
        let inputValue = item.value;

        item.addEventListener('input', () => {
            if(inputValue !== item.value){
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        })
    }


    btn.addEventListener('click', function () {
        // const login = document.getElementById('header-input-login').value,
        //     password = document.getElementById('header-input-password').value;
        //
        BX.ajax.runComponentAction(
            'custom:profile',
            'changeInfo',
            {
                mode: 'class',
                data: {}
            }).then((response) => {
            console.log(response)
        }).catch(e => {
            console.log(e)
        });
    });

})


/* End */
;; /* /local/components/custom/profile/templates/.default/script.js?16861466591095*/
