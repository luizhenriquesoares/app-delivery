'use strict';

angular.module('starter.controllers')
    .controller('ClientMenuCtrl', ['$scope', '$state', 'UserData',
        function($scope, $state, UserData) {
            $scope.user = UserData.get();

            $scope.logout = function () {
                $state.go('logout');
            };
        }]);
