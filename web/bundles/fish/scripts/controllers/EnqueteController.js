app.controller('EnqueteController', function ($rootScope, $scope, EnqueteService) {
    $scope.save = function (enquete) {
        var perguntaControllerElement = document.querySelector('[data-ng-controller=PerguntaController]');
        var perguntaControllerScope = angular.element(perguntaControllerElement).scope();
        enquete.perguntas = [];
        perguntaControllerScope.perguntas.forEach(function (pergunta) {
            if (pergunta.selecionada) {
                enquete.perguntas.push(pergunta);
            }
        });
        if (!enquete.id) {
            $scope.create(enquete);
        } else {
            $scope.update(enquete);
        }
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
    $scope.edit = function (enquete) {
        var perguntaControllerElement = document.querySelector('[data-ng-controller=PerguntaController]');
        var perguntaControllerScope = angular.element(perguntaControllerElement).scope();

        perguntaControllerScope.perguntas.forEach(function (pergunta) {
            enquete.perguntas.forEach(function (perguntaEnquete) {
                if (perguntaEnquete.id === pergunta.id) {
                    pergunta.respostas = perguntaEnquete.respostas;
                }
            });
        });

        $scope.enquete = enquete;
        $scope.selectPerguntasFromEnquete($scope.enquete);
    };
    $scope.clean = function (enquete) {
        $scope.enquete = EnqueteModel;
    };
    $scope.cleanAll = function () {
        $rootScope.$broadcast('cleanAll');
    };
    $scope.selectPerguntasFromEnquete = function (enquete) {
        $rootScope.$broadcast('selectPerguntasFromEnquete', {enquete: enquete});
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
    // Util
    $scope.testIndexof = function (list, object) {
        for (var index = 0; index < list.length; index++) {
            if (list[index].id === object.id) {
                return true;
            }
        }
        return false;
    };
    // Listeners
    $scope.$on('cleanAll', function () {
        $scope.clean();
        $scope.selectPerguntasFromEnquete();
        $scope.selecionarEnquete(-1, null);
    });
});
