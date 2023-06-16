BX.ready(function () {

    const registrationForm = document.getElementById('registration-form');
    const submit = document.getElementById('registration-submit');

    registrationForm.addEventListener('submit', function (event) {
        submit.disabled = true;

        BX.ajax.runComponentAction(
            'custom:header.registration',
            'registration',
            {
                mode: 'class',
                data: {
                    post: Object.fromEntries(new FormData(registrationForm)),
                }
            }).then((response) => {
            submit.disabled = false;

            const data = response.data;

            if(data.type === 'success'){
                window.location.href = "/profile";
            } else {
                myAlert(data.error, 'error');
            }

        }).catch(e => {
            console.log(e)
        });

        event.preventDefault();
    });

    registrationForm.addEventListener('input', function (){
        let values = Object.fromEntries(new FormData(registrationForm));

        if(values.phone.length === 17 && values.password === values['repeat-password']){
            submit.disabled = false;
        } else{
            submit.disabled = true;
        }
    });

})

