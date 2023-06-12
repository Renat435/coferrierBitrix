
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16864891564457";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    document.addEventListener("DOMContentLoaded", function () {
        var eventCalllback = function (e) {
            var el = e.target,
                clearVal = el.dataset.phoneClear,
                pattern = el.dataset.phonePattern,
                matrix_def = "+7(___) ___-__-__",
                matrix = pattern ? pattern : matrix_def,
                i = 0,
                def = matrix.replace(/\D/g, ""),
                val = e.target.value.replace(/\D/g, "");
            if (clearVal !== 'false' && e.type === 'blur') {
                if (val.length < matrix.match(/([\_\d])/g).length) {
                    e.target.value = '';
                    return;
                }
            }
            if (def.length >= val.length) val = def;
            e.target.value = matrix.replace(/./g, function (a) {
                return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
            });
        }
        var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
        for (let elem of phone_inputs) {
            for (let ev of ['input', 'blur', 'focus']) {
                elem.addEventListener(ev, eventCalllback);
            }
        }
    });

    function formatPhoneNumber(inputNumber) {
        const pattern = '8 (___) ___-__-__';
        let formattedNumber = '';
        let digitIndex = 0;

        // Проходимся по каждому символу в шаблоне и заменяем "_" на соответствующую цифру из введенного номера
        for (let i = 0; i < pattern.length; i++) {
            if (pattern[i] === '_') {
                if (digitIndex < inputNumber.length) {
                    formattedNumber += inputNumber[digitIndex++];
                } else {
                    break;
                }
            } else {
                formattedNumber += pattern[i];
            }
        }

        return formattedNumber;
    }


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
;; /* /local/components/custom/profile/templates/.default/script.js?16864891564457*/
