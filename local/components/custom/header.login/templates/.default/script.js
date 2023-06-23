BX.ready(function () {
    
    const btn = document.getElementById('header-login-btn');

    document.getElementById('header-sign-in-form').addEventListener('submit', function (e) {
        e.preventDefault();
        btn.disabled = true;
        
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
                    myAlert('Неверный логин или пароль', 'error');
                }
                btn.disabled = false;
        }).catch(e => {
            console.log(e)
        });
    });

})

