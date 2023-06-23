
; /* Start:"a:4:{s:4:"full";s:75:"/local/components/custom/basket/templates/.default/script.js?16874980789618";s:6:"source";s:60:"/local/components/custom/basket/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function () {

    const totalPrice = document.getElementById('total-price');

    function updateTotalPrice() {

        const allTotalPrices = document.querySelectorAll('.total-price.price');

        let total = 0;

        for (let i = 0; i < allTotalPrices.length; i++){
            total += parseInt(allTotalPrices[i].innerHTML);
        }

        totalPrice.innerHTML = total;

    }

    document.querySelectorAll('.basket__info-list-item').forEach(item => {
        const minus = item.querySelector('.basket__info-list-item-info-price-block-minus');
        const plus = item.querySelector('.basket__info-list-item-info-price-block-plus');
        const counter = item.querySelector('.basket__info-list-item-info-price-block-counter');
        const price = parseInt(item.querySelector('.basket__info-list-item-info-price-text > .price').innerHTML);
        const currentTotal = item.querySelector('.basket__info-list-item-info-price-text > .total-price');

        minus.addEventListener('click', () => {
            let value = parseInt(counter.innerHTML);
            if(value > 1){
                currentTotal.innerHTML = price * (value - 1);
                counter.innerHTML = value - 1;
                updateTotalPrice();
            }
        });

        plus.addEventListener('click', () => {
            let value = parseInt(counter.innerHTML);

            if(parseInt(totalPrice.innerHTML) + price <= 1500){
                currentTotal.innerHTML = price * (value + 1);
                counter.innerHTML = value + 1;
                updateTotalPrice();
            }

        });

    });

    document.querySelectorAll('.basket__info-list-item-delete').forEach(item => {
        item.addEventListener('click', () => {
            item.disabled = true;
            BX.ajax.runComponentAction(
                'custom:basket',
                'deleteElementFromBasket',
                {
                    mode: 'class',
                    data: {
                        post: item.dataset.id
                    }
                }).then((response) => {
                    if (response.data === true){
                        item.closest('.basket__info-list-item').remove();
                        if(document.querySelectorAll('.basket__info-list-item').length === 0){
                            location.reload();
                        }
                        updateTotalPrice();
                    } else {
                        myAlert('Упс что-то пошло не так', 'error');
                    }

                    item.disabled = false;

            }).catch(e => {
                console.log(e)
            });
        })
    });

    const orderAddress = document.getElementById('order-address');
    const orderTime = document.getElementById('order-time');
    const orderTimeNumber = document.getElementById('order-time-number');
    const itemPhone = document.querySelector('.basket__info-order-item-phone');

    BX.ajax.runComponentAction(
        'custom:basket',
        'getPlacesToJS',
        {
            mode: 'class',
            data: {}
        }).then((response) => {

        let myPlacemarks = response.data;

        ymaps.ready(() => {
                let map = new ymaps.Map("basket-map", {
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
                        document.querySelectorAll('[data-placemark-id-label="' + item.ID + '"]').forEach(btn => {

                            btn.addEventListener('click', function () {

                                let coordinates = placemark.geometry.getCoordinates().map(parseFloat);

                                map.panTo(coordinates, {
                                    flying: true,
                                }).then(() => {
                                    map.setZoom(10);
                                }).then(() => {
                                    placemark.balloon.open();
                                });

                                orderAddress.innerHTML = item['ADDRESS'];
                                orderTime.className = `time ${item['WORKLOAD']['CLASS']}`;
                                orderTimeNumber.innerHTML = item['WORKLOAD']['TIME'];
                                itemPhone.innerHTML = item['PHONE'];
                                itemPhone.href = `tel: ${item['PHONE']}`;
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

    document.querySelector('.basket__info-order-button').addEventListener('click', function () {
        let items = [];

        document.querySelectorAll('.basket__info-list-item').forEach(item => {
            let id = item.dataset.id;
            let name = item.querySelector('.basket__info-list-item-info-name').innerHTML.trim();
            let count = item.querySelector('.basket__info-list-item-info-price-block-counter').innerHTML.trim();
            items.push(id + '&' + name + '&' + count);
        });

        let addressId = document.querySelector('.basket__places-list-item-input:checked + .basket__places-list-item-address').dataset.placemarkIdLabel;

        BX.ajax.runComponentAction(
            'custom:basket',
            'addNewOrder',
            {
                mode: 'class',
                data: {
                    post: {
                        items: items,
                        addressId: addressId,
                        totalPrice: totalPrice.innerHTML,
                    }
                }
            }).then((response) => {

                console.log(response);

        }).catch(e => console.log(e));

    });

})
/* End */
;; /* /local/components/custom/basket/templates/.default/script.js?16874980789618*/
