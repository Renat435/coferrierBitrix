
; /* Start:"a:4:{s:4:"full";s:75:"/local/components/custom/profile/templates/.default/script.js?1685143172914";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    document.getElementById('header-login-btn').addEventListener('click', function () {
        const login = document.getElementById('header-input-login').value,
            password = document.getElementById('header-input-password').value;

        BX.ajax.runComponentAction(
            'custom:header.login',
            'login',
            {
                mode: 'class',
                data: {
                    post: {
                        login: login,
                        password: password,
                    }
                }
            }).then((response) => {
                if(response.data){
                    location.reload();
                } else{
                    alert('Неверный логин или пароль');
                }
        }).catch(e => {
            console.log(e)
        });
    });

})


/* End */
;; /* /local/components/custom/profile/templates/.default/script.js?1685143172914*/
