
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16864886383797";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    function formatPhoneNumber(input) {
        // Удаляем все символы, кроме цифр
        const phoneNumber = input.value.replace(/\D/g, '');

        // Создаем шаблон для форматирования
        const pattern = '+7 (___) ___-__-__';

        let formattedPhoneNumber = '';
        let j = 0;

        // Проходимся по каждому символу в шаблоне и заменяем "_" на соответствующую цифру из введенного номера
        for (let i = 0; i < pattern.length; i++) {
            if (pattern[i] === '_') {
                if (j < phoneNumber.length) {
                    formattedPhoneNumber += phoneNumber[j++];
                } else {
                    break;
                }
            } else {
                formattedPhoneNumber += pattern[i];
            }
        }

        // Устанавливаем отформатированный номер в поле ввода
        input.value = formattedPhoneNumber;
    }

    const phoneInput = document.getElementById('profile-change-phone');

    const phoneNumber = new libphonenumber.parsePhoneNumber(phoneInput.value, 'RU');
    const formattedPhoneNumber = phoneNumber.formatInternational();
    phoneInput.value = formattedPhoneNumber;

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
            console.log(response)
        }).catch(e => {
            console.log(e)
        });

        e.preventDefault();
    });

})


/* End */
;; /* /local/components/custom/profile/templates/.default/script.js?16864886383797*/
