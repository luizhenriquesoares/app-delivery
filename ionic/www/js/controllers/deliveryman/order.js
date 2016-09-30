'use strict';

angular.module('starter.controllers')
    .controller('DeliverymanOrderCtrl', ['$scope', '$state', 'DeliverymanOrder', '$ionicLoading',
        function($scope, $state, DeliverymanOrder, $ionicLoading) {
            $scope.items = [];

            $ionicLoading.show({
               template: 'Carregando'
            });

            $scope.openOrderDetail = function (order) {
                $state.go('deliveryman.view_order', {id: order.id});
            };

            $scope.doRefresh = function () {
                getOrders().then(function (data) {
                    $scope.items = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function (dataError) {
                    $scope.$broadcast('scroll.refreshComplete');
                })
            };

            function getOrders() {
               return DeliverymanOrder.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            };
            getOrders().then(function (data) {
                $scope.items = data.data;
                $ionicLoading.hide();
            }, function (error) {
                $ionicLoading.hide();
            });

     }]);
