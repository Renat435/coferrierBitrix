
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16863402002461";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
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

    btn.addEventListener('click', function () {

        let keys = Object.keys(formValues);

        const newFormData = new FormData(form);
        const newFormValues = Object.fromEntries(newFormData);

        let changeableFields = new FormData();
        // formData.append('image', file);
        //
        // let changeableFields = {};


        for (let i = 0; i < keys.length; i++){
            let currentKey = keys[i];

            if(formValues[currentKey] !== newFormValues[currentKey]){
                changeableFields.append(currentKey.toUpperCase(), newFormValues[currentKey]);
            }
        }

        if(avatarChanged){

            changeableFields.append('PERSONAL_PHOTO', avatarInput.files[0]);
            
        }

        console.log(changeableFields);

        BX.ajax.runComponentAction(
            'custom:profile',
            'changeInfo',
            {
                mode: 'class',
                data: {
                    post: changeableFields,
                }
            }).then((response) => {
            console.log(response)
        }).catch(e => {
            console.log(e)
        });
    });

})


/* End */
;; /* /local/components/custom/profile/templates/.default/script.js?16863402002461*/