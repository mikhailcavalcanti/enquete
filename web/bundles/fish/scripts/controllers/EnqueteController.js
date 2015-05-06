app.controller('EnqueteController', function ($rootScope, $scope, EnqueteService) {
    $scope.init = function () {
        $scope.enquete = new EnqueteModel();
        $scope.readAll();
        $scope.setPerguntasToScope(enquete);
    };
    $scope.save = function (enquete) {
        if (!enquete.id) {
            $scope.create(enquete);
        } else {
            $scope.update(enquete);
        }
    };
    $scope.edit = function (enquete) {
        $scope.enquete = enquete;
        $scope.setPerguntasToScope(enquete);
    };
    $scope.create = function (enquete) {
        EnqueteService.create(enquete)
                .success(function (data, status) {
                    if (201 === status) {
                        var enqueteFromResponse = angular.copy(data);
                        $scope.enquetes.push(enqueteFromResponse);
                        $scope.selecionarEnquete(($scope.enquetes.length - 1), enqueteFromResponse);
                        alert('Sucesso');
                    }
                })
                .error(function (data, status) {
                    if (422 === status) {
                        alert(data.messages);
                    }
                });
    };
    $scope.readAll = function () {
        EnqueteService.readAll().success(function (enquetes) {
            $scope.enquetes = enquetes;
        });
    };
    $scope.update = function (enquete) {
        EnqueteService.update(enquete)
                .success(function (data, status) {
                    if (200 === status) {
                        alert('Sucesso');
                    }
                })
                .error(function (data, status) {
                    if (422 === status) {
                        alert(data.messages);
                    }
                });
    };
    $scope.delete = function (enquete) {
        if (confirm('Deseja deletar esta enquete?')) {
            EnqueteService.delete(enquete).success(function (enqueteResponse, status) {
                if (204 === status) {
                    for (var index = 0; index < $scope.enquetes.length; index++) {
                        if ($scope.enquetes[index].id === enquete.id) {
                            $scope.enquetes.splice(index, 1);
                            if ($scope.enquete.id === enquete.id) {
                                $scope.cleanAll();
                            }
                        }
                    }
                }
            });
        }
    };
    $scope.clean = function (enquete) {
        $scope.filter.enquete.titulo = '';
    };
    $scope.cleanAll = function () {
        $rootScope.$broadcast('cleanAll');
    };
    $scope.selecionarEnquete = function (index, enquete) {
        if ($scope.enqueteSelecionada !== index) {
            $scope.enqueteSelecionada = index;
            if (enquete) {
                $scope.edit(enquete);
            }
        } else {
            $scope.enqueteSelecionada = -1;
            $scope.cleanAll();
        }
    };
    $scope.setPerguntasToScope = function (enquete) {
        $rootScope.$broadcast('setPerguntasToScope', {enquete: enquete});
    };
    // Listeners
    $scope.$on('cleanAll', function () {
        $scope.clean();
    });
});
