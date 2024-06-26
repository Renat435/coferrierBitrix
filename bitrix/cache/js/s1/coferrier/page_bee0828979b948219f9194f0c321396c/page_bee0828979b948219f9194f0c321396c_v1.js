
; /* Start:"a:4:{s:4:"full";s:81:"/local/components/custom/index.places/templates/.default/script.js?16865108595434";s:6:"source";s:66:"/local/components/custom/index.places/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
document.addEventListener('DOMContentLoaded', function () {

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

    BX.ajax.runComponentAction(
        'custom:index.places',
        'getPlacesJS',
        {
            mode: 'class',
            data: {}
        }).then((response) => {

        let myPlacemarks = response.data;

        ymaps.ready(() => {
                let map = new ymaps.Map("places__map", {
                    center: [myPlacemarks[0]['GPS_N'], myPlacemarks[0]['GPS_S']],
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
                    '<img class="custom-balloon__item-img" src="/local/templates/coferrier/img/svg/address.svg" alt="address">' +
                    '<p class="custom-balloon__item-text">$[properties.address]</p>' +
                    '</div>' +
                    '<div class="custom-balloon__item">' +
                    '<img class="custom-balloon__item-img" src="/local/templates/coferrier/img/svg/time.svg" alt="time">' +
                    '<p class="custom-balloon__item-text">$[properties.schedule]</p>' +
                    '</div>' +
                    '<div class="custom-balloon__item">' +
                    '<img class="custom-balloon__item-img" src="/local/templates/coferrier/img/svg/call.svg" alt="call">' +
                    '<a class="custom-balloon__item-text" href="tel:$[properties.phoneNumber]">$[properties.phoneNumber]</a>' +
                    '</div>'
                );


                let placemarkCollection = [];

                for (let i = 0; i < myPlacemarks.length; i++) {

                    const item = myPlacemarks[i];

                    let placemark = new ymaps.Placemark([item['GPS_N'], item['GPS_S']], {
                        address: item['ADDRESS'],
                        schedule: item['SCHEDULE'],
                        phoneNumber: item['PHONE'],
                    }, {
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: '/local/templates/coferrier/img/map-placemark.png',
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
                        document.querySelectorAll('[data-placemark-id="' + item.ID + '"]').forEach(btn => {
                            btn.addEventListener('click', function () {

                                let coordinates = placemark.geometry.getCoordinates().map(parseFloat);

                                map.panTo(coordinates, {
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
                        let coordinates = placemark.geometry.getCoordinates().map(parseFloat);

                        map.panTo(coordinates, {
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

    }).catch(e => {
        console.log(e)
    });

});
/* End */
;; /* /local/components/custom/index.places/templates/.default/script.js?16865108595434*/
