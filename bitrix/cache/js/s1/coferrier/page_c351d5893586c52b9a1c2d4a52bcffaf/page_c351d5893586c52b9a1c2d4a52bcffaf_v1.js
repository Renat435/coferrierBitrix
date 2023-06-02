
; /* Start:"a:4:{s:4:"full";s:81:"/local/components/custom/index.places/templates/.default/script.js?16855300135754";s:6:"source";s:66:"/local/components/custom/index.places/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
document.addEventListener('DOMContentLoaded', function () {

    BX.ajax.runComponentAction(
        'custom:index.places',
        'getPlacesJS',
        {
            mode: 'class',
            data: {}
        }).then((response) => {
        console.log(response)
    }).catch(e => {
        console.log(e)
    });

    const myPlacemarks = [
        {
            id: 12,
            coords: [55.73, 37.75],
            img: './assets/img/place-1.jpg',
            address: 'Владикавказ ул. Кирова д. 34',
            schedule: 'пн-вс: 7:30 - 20:00',
            phoneNumber: '+7 (988) 977 54 23',
        },
        {
            id: 14,
            coords: [55.81, 37.75],
            img: './assets/img/place-2.jpg',
            address: 'Владикавказ ул. Маркова д. 66',
            schedule: 'пн-вс: 7:30 - 20:00',
            phoneNumber: '+7 (988) 977 54 23',
        },
        {
            id: 15,
            coords: [56.81, 37.75],
            img: './assets/img/place-2.jpg',
            address: 'Владивосток ул Пожарников д. 78',
            schedule: 'пн-вс: 7:30 - 20:00',
            phoneNumber: '+7 (988) 977 54 23',
        },
    ];

    ymaps.ready(() => {
            let map = new ymaps.Map("places__map", {
                center: [55.76, 37.64],
                zoom: 9,
                controls: []
            });

            let customBalloonLayout = ymaps.templateLayoutFactory.createClass(
                '<div class="custom-balloon">' +
                '$[[options.contentLayout observeSize]]' +
                '</div>'
            );

            let customBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div class="custom-balloon__item">' +
                '<img class="custom-balloon__item-img" src="./assets/img/address.svg" alt="address">' +
                '<p class="custom-balloon__item-text">$[properties.address]</p>' +
                '</div>' +
                '<div class="custom-balloon__item">' +
                '<img class="custom-balloon__item-img" src="./assets/img/time.svg" alt="time">' +
                '<p class="custom-balloon__item-text">$[properties.schedule]</p>' +
                '</div>' +
                '<div class="custom-balloon__item">' +
                '<img class="custom-balloon__item-img" src="./assets/img/call.svg" alt="call">' +
                '<a class="custom-balloon__item-text" href="tel:$[properties.phoneNumber]">$[properties.phoneNumber]</a>' +
                '</div>'
            );


            let placemarkCollection = [];

            for (let i = 0; i < myPlacemarks.length; i++) {

                const item = myPlacemarks[i];

                let placemark = new ymaps.Placemark(item.coords, {
                    address: item.address,
                    schedule: item.schedule,
                    phoneNumber: item.phoneNumber,
                }, {
                    iconLayout: 'default#imageWithContent',
                    iconImageHref: '../../assets/img/map-placemark.png',
                    iconImageSize: [40, 40],
                    iconImageOffset: [-20, -20],
                    balloonShadow: false,
                    balloonLayout: customBalloonLayout,
                    balloonContentLayout: customBalloonContentLayout,
                    balloonPanelMaxMapArea: 0,
                    balloonOffset: [0, 0],
                    closeButton: false,
                    hideIconOnBalloonOpen: true,
                })


                placemarkCollection.push(placemark);

                try {
                    document.querySelectorAll('[data-placemark-id="' + item.id + '"]').forEach(btn => {
                        btn.addEventListener('click', function () {
                            map.panTo(item.coords, {
                                flying: true,
                            }).then(() => {
                                map.setZoom(10);
                            }).then(() => {
                                placemark.balloon.open();
                            });
                        })
                    })
                } catch
                    (e) {
                    console.log(e);
                }
            }

            const clusterer = new ymaps.Clusterer({
                preset: 'islands#brownClusterIcons',
            });

            clusterer.add(placemarkCollection);

            map.geoObjects.add(clusterer);

            placemarkCollection.map(placemark => {
                placemark.events.add('click', function (e) {
                    const coords = e.get('target').geometry.getCoordinates();
                    map.panTo(coords, {
                        flying: true
                    });
                });
            })

            map.events.add('click', function () {
                placemarkCollection.map(function (geoObject) {
                    if (geoObject instanceof ymaps.Placemark && geoObject.balloon.isOpen()) {
                        geoObject.balloon.close();
                    }
                });
            });
        }
    );


    let placesSwiper = new Swiper(".places__slider", {
        pagination: {
            el: ".places__slider-pagination",
            clickable: true,
        },
        direction: "horizontal",
        slidesPerView: 3,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.places__slider-button--next',
            prevEl: '.places__slider-button--prev'
        }
    });
});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:83:"/local/components/custom/index.contacts/templates/.default/script.js?16845183751085";s:6:"source";s:68:"/local/components/custom/index.contacts/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    const nameInput = document.getElementById('contacts-form-name')
    const emailInput = document.getElementById('contacts-form-email')
    const messageInput = document.getElementById('contacts-form-message')

    document.getElementById('contacts-send-btn').addEventListener('click', function () {

        BX.ajax.runComponentAction(
            'custom:index.contacts',
            'sendMessage',
            {
                mode: 'class',
                data: {
                    post: {
                        name: nameInput.value,
                        email: emailInput.value,
                        message: messageInput.value,
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
;; /* /local/components/custom/index.places/templates/.default/script.js?16855300135754*/
; /* /local/components/custom/index.contacts/templates/.default/script.js?16845183751085*/
