
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16865903224383";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    const btn = document.getElementById('profile-change-btn');

    const form = document.getElementById('change-profile-form');

    const formData = new FormData(form);
    const formValues = Object.fromEntries(formData);

    let avatarChanged = false;
    const avatarInput = document.getElementById('profile-change-avatar-input');
    const previewAvatar = document.getElementById('preview-avatar');

    avatarInput.addEventListener('change', function (event) {

        avatarChanged = true;
        btn.disabled = false;
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                previewAvatar.src = reader.result;
            });

            reader.readAsDataURL(file);
        }

    });



    form.addEventListener('input', function () {

        const newFormData = new FormData(form);
        const newFormValues = Object.fromEntries(newFormData);

        if(JSON.stringify(formValues) === JSON.stringify(newFormValues) && !avatarChanged){
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }

    });

    form.addEventListener('submit', function (e) {

        let keys = Object.keys(formValues);

        const newFormData = new FormData(form);
        const newFormValues = Object.fromEntries(newFormData);

        let changeableFields = new FormData();


        for (let i = 0; i < keys.length; i++){
            let currentKey = keys[i];

            if(formValues[currentKey] !== newFormValues[currentKey]){

                changeableFields.append(currentKey.toUpperCase(), newFormValues[currentKey]);

            }
        }

        if(avatarChanged){
            changeableFields.append('image', avatarInput.files[0], avatarInput.files[0].name);
        }

        BX.ajax.runComponentAction(
            'custom:profile',
            'changeInfo',
            {
                mode: 'class',
                data: changeableFields,
                method: 'POST',
                processData: false,
                contentType: false,
            }).then((response) => {

                let data = response.data;

                if(data.status){
                    location.reload();
                } else{
                    alert(data.message);
                }

        }).catch(e => {
            console.log(e)
        });

        e.preventDefault();
    });

    document.getElementById('profile-user-exit').addEventListener('click', function () {
        BX.ajax.runComponentAction(
            'custom:profile',
            'logout',
            {
                mode: 'class',
            }).then((response) => {

            location.reload();

        }).catch(e => {
            console.log(e)
        });
    });

    const changePasswordForm = document.getElementById('change-password-form');
    const changePasswordSubmit = document.getElementById('change-user-password');

    changePasswordForm.addEventListener('input', function () {
        const changePasswordFormValues = Object.fromEntries(new FormData(changePasswordForm));

        const currentPassword = changePasswordFormValues['current-password'];
        const newPassword = changePasswordFormValues['new-password'];
        const repeatNewPassword = changePasswordFormValues['repeat-new-password'];

        if(currentPassword.length >= 8 && newPassword.length >= 8 && repeatNewPassword.length >=8 && newPassword === repeatNewPassword){
            changePasswordSubmit.disabled = false;
        } else {
            changePasswordSubmit.disabled = true;
        }

    });

    changePasswordSubmit.addEventListener('click', function () {

        const changePasswordFormValues = Object.fromEntries(new FormData(changePasswordForm));

        BX.ajax.runComponentAction(
            'custom:profile',
            'changePassword',
            {
                mode: 'class',
                data: {
                    post: changePasswordFormValues,
                }
            }).then((response) => {

            alert(response.data)

        }).catch(e => {
            console.log(e)
        });
    });

})


/* End */
;; /* /local/components/custom/profile/templates/.default/script.js?16865903224383*/
