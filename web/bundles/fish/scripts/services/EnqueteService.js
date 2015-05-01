app.factory('EnqueteService', function ($http, BASE_URL) {
    var Enquete = {
        create: function (enquete) {
            return $http.post(BASE_URL + '/enquete', enquete);
        },
        readAll: function () {
            return $http.get(BASE_URL + '/enquete');
        },
        update: function (enquete) {
            return $http.put(BASE_URL + '/enquete/' + enquete.id, enquete);
        },
        delete: function (enquete) {
            return $http.delete(BASE_URL + '/enquete/' + enquete.id);
        }
    };
    return Enquete;
});
