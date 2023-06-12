
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16865906446476";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
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


    function myAlert(message, style) {
        var alertContainer = document.createElement("div");
        alertContainer.style.position = "fixed";
        alertContainer.style.top = "-100px";
        alertContainer.style.left = "0";
        alertContainer.style.width = "100%";
        alertContainer.style.padding = "10px";
        alertContainer.style.borderRadius = "5px";
        alertContainer.style.backgroundColor = "#f2f2f2";
        alertContainer.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.3)";
        alertContainer.style.marginBottom = "10px";

        if (style === "success") {
            alertContainer.style.backgroundColor = "#d4edda";
            alertContainer.style.borderColor = "#c3e6cb";
            alertContainer.style.color = "#155724";
        } else if (style === "error") {
            alertContainer.style.backgroundColor = "#f8d7da";
            alertContainer.style.borderColor = "#f5c6cb";
            alertContainer.style.color = "#721c24";
        } else if (style === "warning") {
            alertContainer.style.backgroundColor = "#fff3cd";
            alertContainer.style.borderColor = "#ffeeba";
            alertContainer.style.color = "#856404";
        }

        var alertMessage = document.createElement("p");
        alertMessage.textContent = message;

        alertContainer.appendChild(alertMessage);
        document.body.appendChild(alertContainer);

        // Выезд
        setTimeout(function () {
            alertContainer.style.top = "0";
        }, 100);

        // Заезд обратно
        setTimeout(function () {
            alertContainer.style.top = "-100px";
            setTimeout(function () {
                alertContainer.remove();
            }, 300);
        }, 2200);
    }

    // myAlert("Привет, это сообщение с использованием myAlert!", "success");
    myAlert("Возникла ошибка!", "error");
    // myAlert("Предупреждение: эта операция необратима.", "warning");

})


/* End */
;; /* /local/components/custom/profile/templates/.default/script.js?16865906446476*/
