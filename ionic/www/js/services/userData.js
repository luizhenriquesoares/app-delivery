'use strict';

angular.module('starter.services')
    .factory('UserData', ['$localStorage', function ($localStorage) {
        var key = 'user';
        return {
            set: function (value) {
                return $localStorage.setObject(key, value);
            },
            get: function () {
                return $localStorage.getObject(key);
            }
        }
    }]);