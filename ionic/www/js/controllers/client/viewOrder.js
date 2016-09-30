'use strict';

angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl', ['$scope', '$stateParams', '$ionicLoading', 'ClientOrder',
        function($scope, $stateParams, $ionicLoading, ClientOrder) {
              $scope.orders = [];
              $ionicLoading.show({
                  template: 'Carregando...'
              });

              ClientOrder.get({id: $stateParams.id, include: 'items, cupoms'}, function (data) {
               $scope.orders = data.data;
                  $ionicLoading.hide();
        }, function (dataError) {
                $ionicLoading.hide();
              });
     }]);
