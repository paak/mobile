(function () {

    var injectParams = ['$http', '$rootScope'];

    var authFactory = function ($http, $rootScope) {
        var serviceBase = './mobileservice/',
            factory = {
                loginPath: '/login',
                user: {
                    isAuthenticated: false,
                    roles: null
                }
            };

        // factory.login = function (username, password) {
        //     return $http.post(serviceBase + 'login', { userLogin: { userName: username, password: password } }).then(
        //         function (results) {
        //             var loggedIn = results.data.status;
        //             changeAuth(loggedIn);
        //             return loggedIn;
        //         });
        // };

        factory.login = function (username, password) {
            return $http.get(serviceBase + 'login.php?username=' + username + '&password=' + password).then(
                function (results) {
                    console.log(results.data);
                    var loggedIn = results.data.status;
                    changeAuth(loggedIn);
                    return loggedIn;
                });
        };

        factory.logout = function () {
            return $http.post(serviceBase + 'logout').then(
                function (results) {
                    var loggedIn = !results.data.status;
                    changeAuth(loggedIn);
                    return loggedIn;
                });
        };

        factory.redirectToLogin = function () {
            $rootScope.$broadcast('redirectToLogin', null);
        };

        function changeAuth(loggedIn) {
            factory.user.isAuthenticated = loggedIn;
            $rootScope.$broadcast('loginStatusChanged', loggedIn);
        }

        return factory;
    };

    authFactory.$inject = injectParams;

    angular.module('wcaApp').factory('authService', authFactory);

}());

