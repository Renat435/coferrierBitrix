
; /* Start:"a:4:{s:4:"full";s:76:"/local/components/custom/profile/templates/.default/script.js?16861471681820";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    // console.log(document.getElementById('change-profile-form'));

    let form = document.getElementById('change-profile-form');

// Создаем массив для хранения значений value
    let values = [];

// Проходимся по коллекции элементов формы и получаем значения value
    for (let i = 0; i < form.elements.length; i++) {
        let element = form.elements[i];
        // Проверяем, что элемент является полем ввода
        if (element.nodeName === 'INPUT') {
            values.push(element.value);
        }
    }

    console.log(values);



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
;; /* /local/components/custom/profile/templates/.default/script.js?16861471681820*/
