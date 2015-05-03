app.controller('EnqueteController', function ($scope, EnqueteService) {
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
        EnqueteService.create(enquete).success(function (data, status) {
            if (201 === status) {
                $scope.enquetes.push(angular.copy(data));
                alert('Sucesso');
            }
        });
    };
    $scope.readAll = function () {
        EnqueteService.readAll().success(function (enquetes) {
            $scope.enquetes = enquetes;
        });
    };
    $scope.update = function (enquete) {
        EnqueteService.update(enquete).success(function (data, status) {
            if (200 === status) {
                alert('Sucesso');
            }
        });
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
        $scope.setEnquetePerguntasStyle();
    };
    $scope.clean = function (enquete) {
        $scope.enquete = EnqueteModel;
    };
    $scope.setEnquetePerguntasStyle = function () {
        var perguntaControllerElement = document.querySelector('[data-ng-controller=PerguntaController]');
        var perguntaControllerScope = angular.element(perguntaControllerElement).scope();

        if (!perguntaControllerScope.perguntas || !$scope.enquete) {
            return;
        }
        for (var index1 = 0; index1 < perguntaControllerScope.perguntas.length; index1++) {
            perguntaControllerScope.perguntas[index1].style = "";
            if ($scope.enquete.perguntas) {
                for (var index2 = 0; index2 < $scope.enquete.perguntas.length; index2++) {
                    if (perguntaControllerScope.perguntas[index1].id === $scope.enquete.perguntas[index2].id) {
                        perguntaControllerScope.perguntas[index1].selecionada = true;
                    }
                }
            }
        }
    };
    $scope.selecionarEnquete = function (index) {
        if ($scope.enqueteSelecionada !== index) {
            $scope.enqueteSelecionada = index;
        } else {
            $scope.enqueteSelecionada = -1;
            $scope.clean();
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
});
