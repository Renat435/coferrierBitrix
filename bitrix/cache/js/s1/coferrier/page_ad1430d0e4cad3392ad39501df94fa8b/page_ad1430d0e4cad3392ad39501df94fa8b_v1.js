
; /* Start:"a:4:{s:4:"full";s:81:"/local/components/custom/index.slider/templates/.default/script.js?16837614191812";s:6:"source";s:66:"/local/components/custom/index.slider/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
// BX.ready(function () {
//     document.addEventListener('DOMContentLoaded', function () {
//         let swiper = new Swiper(".stock__slider", {
//             pagination: {
//                 el: ".stock__slider-pagination",
//                 clickable: true,
//             },
//
//
//             direction: "horizontal",
//             slidesPerView: 1,
//             spaceBetween: 30,
//             loop: true,
//             autoplay: {
//                 delay: 5000,
//                 disableOnInteraction: false,
//             },
//             effect: 'fade',
//             on: {
//                 slideChange: ()=> {//Здесь мы переключаем старый слайд на новый и нужно обновить прогресс-бар. Без таймаута стиль не обновляется.
//                     document.querySelector('.stock__slider-timer-progress').classList.remove('active');
//                     setTimeout(() => {
//                         document.querySelector('.stock__slider-timer-progress').classList.add('active');
//                     }, 50);
//                 },
//             },
//         });
//
//         let swiperSlogans = new Swiper(".stock__slogans", {
//             loop: true,
//             autoplay: {
//                 delay: 6000,
//                 disableOnInteraction: false,
//             },
//             effect: 'fade',
//             allowTouchMove: false
//         });
//
//         document.querySelector('.stock__next').addEventListener('click', function(e){
//             document.getElementById('advantages').scrollIntoView({
//                 behavior: 'smooth',
//                 block: 'start'
//             });
//         });
//     });
// })
/* End */
;
; /* Start:"a:4:{s:4:"full";s:82:"/local/components/custom/index.contacts/templates/.default/script.js?1684256040806";s:6:"source";s:68:"/local/components/custom/index.contacts/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    document.getElementById('contacts-send-btn').addEventListener('click', function () {

        BX.ajax.runComponentAction(
            'custom:index.contacts',
            'sendMessage',
            {
                mode: 'class',
                data: {
                    post: {
                        login: 'qwer',
                        password: 'wwwwwwwwwww',
                    }
                }
            }).then((response) => {
            console.log(response);
            // if(response.data){
            //     location.reload();
            // } else{
            //     alert('Неверный логин или пароль');
            // }
        }).catch(e => {
            console.log(e)
        });


    });


})
/* End */
;; /* /local/components/custom/index.slider/templates/.default/script.js?16837614191812*/
; /* /local/components/custom/index.contacts/templates/.default/script.js?1684256040806*/
