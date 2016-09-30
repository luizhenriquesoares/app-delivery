angular.module('starter.run').run(['$state', 'PermissionStore', 'OAuth', 'UserData', 'RoleStore', '$rootScope',
    'authService','httpBuffer',
    function ($state, PermissionStore, OAuth, UserData, RoleStore, $rootScope, authService, httpBuffer) {
        PermissionStore.definePermission('user-permission', function () {
            return OAuth.isAuthenticated();
        });


        /**
         * Permissões de Client
         */
        PermissionStore.definePermission('client-permission', function () {
            var user = UserData.get();
            if (user == null || !user.hasOwnProperty('role')) {
                return false;
            }

            return user.role == 'client';
        });

        RoleStore.defineRole('client-role', ['user-permission', 'client-permission']);

        /**
         * Permissões do Deliveryman
         */
        PermissionStore.definePermission('deliveryman-permission', function () {
            var user = UserData.get();
            if (user == null || !user.hasOwnProperty('role')) {
                return false;
            }
            return user.role == 'deliveryman';
        });
        RoleStore.defineRole('deliveryman-role', ['user-permission', 'deliveryman-permission']);

        $rootScope.$on('event:auth-loginRequired', function (event, data) {
            switch (data.data.error) {
                case 'access_denied':
                    if (!$rootScope.refreshingToken) {
                        $rootScope.refreshingToken = OAuth.getRefreshToken();
                    }
                    $rootScope.refreshingToken.then(function (data) {
                        authService.loginConfirmed();
                        $rootScope.refreshingToken = null;
                    }, function (responseError) {
                        $state.go('logout');
                    });
                    break;
                case 'invalid_credentials':
                    httpBuffer.rejectAll(data);
                    break;
                default:
                    $state.go('logout');
            }

        });

    }
]);