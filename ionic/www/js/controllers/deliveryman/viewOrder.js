'use strict';

angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl', ['$scope', '$stateParams', '$ionicLoading', 'DeliverymanOrder',
        '$cordovaGeolocation', '$ionicPopup',
        function ($scope, $stateParams, $ionicLoading, DeliverymanOrder, $cordovaGeolocation, $ionicPopup) {
            var watch, lat, long;

            $scope.orders = [];
            $ionicLoading.show({
                template: 'Carregando...'
            });

            // Recebe todos pedidos do entregador
            DeliverymanOrder.get({id: $stateParams.id, include: 'items, cupom'}, function (data) {
                $scope.orders = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });

            // encerra a entrega, e para enviar o geoposicionamento do  entregador
            $scope.goToDelivery = function () {
                $ionicPopup.alert({
                    title: 'Atenção',
                    template: 'Deseja finalizar a localização ?'
                }).then(function () {
                    stopWatchPosition();
                });

                // altera o status do pedido para entregue e salva com uma hash
                DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function () {
                    var watchOptions = {
                        timeout: 3000,
                        enableHighAccuracy: false
                    };
                    // inicia a captura do posicionamento do entregador
                    watch = $cordovaGeolocation.watchPosition(watchOptions);
                    watch.then(null, function (responseError) {
                        //error
                    }, function (position) {
                        if(!lat){
                            lat = position.coords.latitude;
                            long = position.coords.longitude;
                        }else{
                            long -= 0.0444;
                        }
                        // enviar para api a latitude e longitude do entregador.
                        DeliverymanOrder.geo({id: $stateParams.id}, {
                           lat: lat,
                           long: long
                        });
                    });

                }, function () {
                    $ionicPopup.alert({
                        title: 'Atenção',
                        template: 'Error ao finalizar sua localização'
                    });
                });
            };
            // para e destroy objeto de captura do geoposicionamento
            function stopWatchPosition() {
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                    $cordovaGeolocation.clearWatch(watch.watchID);

                }
            }
        }]);
