'use strict';

angular.module('starter.controllers')

    .controller('ClientCheckoutCtrl', ['$ionicLoading',
        'ClientOrder', '$scope', '$state', '$cart', '$ionicPopup', 'Cupom', '$cordovaBarcodeScanner', 'User',
        function ($ionicLoading, ClientOrder, $scope, $state, $cart, $ionicPopup, Cupom, $cordovaBarcodeScanner, User) {
            User.authenticated({
                include: 'client'
            }, function (data) {

            }, function (responseError) {

            });

            var cart = $cart.get();
            var paymentMethods = [];
            $scope.total = [];
            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();

            $scope.removeItem = function (i) {

                $cart.removeItem(i);
                $scope.items.splice(i, 1);
                $scope.total = $cart.getTotalFinal();
            };
            var amount = $scope.total;
            getMethodsPayment(amount);
            $scope.openProductDetail = function (i) {

                $state.go('client.checkout_item_detail', {
                    index: i
                })
            };

            $scope.openListProducts = function () {
                $state.go('client.view_products');
            };

            $scope.save = function () {
                var obj = {
                    items: angular.copy($scope.items)
                };

                angular.forEach(obj.items, function (item) {
                    item.product_id = item.id;
                });

                $ionicLoading.show({
                    template: 'Carregando...'
                });
                if ($scope.cupom.value) {
                    obj.cupom_code = $scope.cupom.code;
                }

                ClientOrder.save({id: null}, obj, function (data) {

                    $ionicLoading.hide();
                    $state.go('client.checkout_successful');
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Pedido não Realizado - Tente Novamente.'
                    })
                });
            };



            // leitura do codigo de barra
            $scope.readBarCode = function () {
                $cordovaBarcodeScanner
                    .scan()
                    .then(function (barcodeData) {
                        getValueCupom(barcodeData.text);
                    }, function (error) {
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Não foi possivel ler o código de barras'
                        })
                    });
            };

            $scope.removeCupom = function () {
                $cart.removeCupom();
                $scope.cupom = $cart.get().cupom;
                $scope.total = $cart.getTotalFinal();
            };

            function getValueCupom(code) {
                $ionicLoading.show({
                    template: 'Carregando...'
                });
                Cupom.get({
                    code: code
                }, function (data) {
                    $cart.setCupom(data.data.code, data.data.value);
                    $scope.cupom = $cart.get().cupom;
                    $scope.total = $cart.getTotalFinal();
                    $ionicLoading.hide();
                }, function (responseError) {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Cupom Inválido.'
                    })

                });
            }

            function getMethodsPayment(amount) {
                PagSeguroDirectPayment.getPaymentMethods({
                    amount: amount,
                    success: function (response) {
                        paymentMethods = response.paymentMethods;
                        Object.keys(paymentMethods).forEach(function (data) {
                            $scope.paymentMethods = paymentMethods[data].name;

                            console.log($scope.paymentMethods);

                        });
                    }
                });
            }
        }
    ]);