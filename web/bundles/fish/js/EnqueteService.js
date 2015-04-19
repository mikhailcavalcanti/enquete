app.factory('EnqueteService', function ($http, BASE_URL) {
    var enquetes = [];
    var Enquete = {
        create: function (enquete) {
            return $http.post(BASE_URL + '/enquete/', enquete);
        },
        read: function () {
            return $http.get(BASE_URL + '/enquete/.json');
        }
    };
    return Enquete;
});
