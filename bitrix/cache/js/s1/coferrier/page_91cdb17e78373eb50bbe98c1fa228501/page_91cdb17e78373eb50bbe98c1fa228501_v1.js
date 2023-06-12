
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16863095721163";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {


    const form = document.getElementById('change-profile-form');

    const formData = new FormData(form);
    const formValues = Object.fromEntries(formData);



    form.addEventListener('input', function () {

        const newFormData = new FormData(form);
        const newFormValues = Object.fromEntries(newFormData);

        if(JSON.stringify(formValues) === JSON.stringify(newFormValues)){
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }

    });

    const btn = document.getElementById('profile-change-btn');

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
;; /* /local/components/custom/profile/templates/.default/script.js?16863095721163*/