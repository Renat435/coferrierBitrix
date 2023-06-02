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

