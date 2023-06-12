
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16861474782025";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {


    var form = document.getElementById('change-profile-form');

// Создаем новый объект FormData и передаем ему форму
    var formData = new FormData(form);

    console.log(formData)

// Создаем пустой объект для хранения пар имя: значение
    var formValues = {};

    let test = {};

// Проходимся по каждой паре ключ-значение в объекте FormData
    for (var pair of formData.entries()) {
        // Добавляем имя и значение в объект formValues
        formValues[pair[0]] = pair[1];
        test[pair[0]] = pair[1];
    }

// Теперь в объекте formValues содержатся пары имя: значение для каждого элемента формы
    console.log(formValues === test);



    const btn = document.getElementById('profile-change-btn');

    let inputs = document.querySelectorAll('.profile__change-info-input');

    let inputsValue = [];


    for (let i = 0; i < inputs.length; i++){

        let item = inputs[i];
        let itemValue = item.value;
        inputsValue.push(item.value);

        item.addEventListener('input', () => {
            if(itemValue !== item.value){
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        })
    }


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
;; /* /local/components/custom/profile/templates/.default/script.js?16861474782025*/
