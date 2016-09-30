'use strict';

angular.module('starter.controllers')
    .controller('ClientCheckoutSuccessfulCtrl', ['$scope', '$state', '$cart', function ($scope, $state, $cart) {
            var cart = $cart.get();

            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();
            $cart.clear();

            $scope.OpenListOrder = function () {
                $state.go('client.order');
            };
        }]);


