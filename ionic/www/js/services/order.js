'use strict';

angular.module('starter.services')
    .factory('ClientOrder', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/client/order/:id', {id: '@id'}, {
            query: {
                isArray: false
            }
        });
    }])

    .factory('DeliverymanOrder', ['$resource', 'appConfig', function ($resource, appConfig) {
        var url = appConfig.baseUrl + '/api/deliveryman/order/:id';
        return $resource(url, {id: '@id'}, {
            query: {
                isArray: false
            },
            updateStatus: {
                method: 'PATCH',
                url: url + '/update-status'
            },
            geo:{
               method: 'POST',
                url: url + '/geo'
            }
        });
    }]);

