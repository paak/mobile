(function () {

    var injectParams = ['$location', '$filter', '$window',
                        '$timeout', 'authService'];

    var homeController = function ($location, $filter, $window,
        $timeout, authService) {

        var vm = this;
    };

    homeController.$inject = injectParams;

    angular.module('wcaApp').controller('homeController', homeController);

}());
