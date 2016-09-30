'use strict';

angular.module('starter.controllers')
    .controller('LoginCtrl', ['$scope', 'OAuth', 'OAuthToken', '$ionicPopup', '$state', 'UserData', 'User','$redirect',
        function($scope, OAuth, OAuthToken, $ionicPopup, $state, UserData, User, $redirect) {

        $scope.user = {
            username: '',
            password: ''
        };

        $scope.login = function () {

            var promise = OAuth.getAccessToken($scope.user);
                promise
                    .then(function (data) {
                        return User.authenticated({include: 'client'}).$promise;
                     })
                    .then(function (data) {
                        UserData.set(data.data);
                        $redirect.redirectAfterLogin();
                    }, function (responseError) {
                        UserData.set(null);
                        OAuthToken.removeToken();
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Login e/ou senha invalidos'
                        });

                        console.debug(responseError);
                    });

        }
    }]);

