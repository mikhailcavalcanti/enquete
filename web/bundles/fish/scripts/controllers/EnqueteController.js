app.controller('EnqueteController', function ($scope, EnqueteService) {
    $scope.save = function (enquete) {
        var isPersisted = enquete.id ? true : false;
        EnqueteService.create(enquete).success(function (data, status) {
            if (status === 201 && !isPersisted) {
                $scope.enquetes.push(angular.copy(data));
            }
        });
        $scope.clean();
    };
    $scope.readAll = function () {
        EnqueteService.readAll().success(function (enquetes) {
            $scope.enquetes = enquetes;
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
//    // MIX
//    $scope.enquetePerguntaRemover = function (pergunta) {
//        for (var index = 0; index < $scope.enquete.perguntas.length; index++) {
//            if ($scope.enquete.perguntas[index].id == pergunta.id) {
//                $scope.enquete.perguntas.splice(index, 1);
//            }
//        }
//        $scope.setEnquetePerguntaStyle();
//    };
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
//    $scope.perguntaToScope = function (pergunta) {
//        if (!$scope.enquete) {
//            alert('Selecione uma enquete');
//            return;
//        }
//        for (var index = 0; index < $scope.enquete.perguntas.length; index++) {
//            $scope.enquete.perguntas[index].selecionada = false;
//        }
//        $scope.pergunta = pergunta;
//        $scope.pergunta.selecionada = true;
//    };
//    // Util
    $scope.testIndexof = function (list, object) {
        for (var index = 0; index < list.length; index++) {
            if (list[index].id == object.id) {
                return true;
            }
        }
        return false;
    };
});
