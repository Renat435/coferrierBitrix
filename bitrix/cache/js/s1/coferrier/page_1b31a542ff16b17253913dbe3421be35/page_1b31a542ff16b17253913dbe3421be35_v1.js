
; /* Start:"a:4:{s:4:"full";s:75:"/local/components/custom/profile/templates/.default/script.js?1686146196885";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    const btn = document.getElementById('profile-change-btn');

    console.log('qwer')

    document.querySelectorAll('.profile__change-info-input').map(item => {
        item.addEventListener('change', () => {
            console.log('wqer');

            btn.disabled = false;
        })
    })


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
;; /* /local/components/custom/profile/templates/.default/script.js?1686146196885*/
