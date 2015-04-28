var app = angular.module('enquete', []).constant('BASE_URL', BASE_URL).controller(
        'EnqueteController',
        ['$scope', '$http', 'EnqueteService', 'PerguntaService', 'RespostaService', function ($scope, $http, EnqueteService, PerguntaService, RespostaService) {
                // init
                EnqueteService.read().success(function (data) {
                    // enquetes
                    $scope.enquetes = data;
//		$scope.edit($scope.enquetes[0]);
                    // perguntas
                    PerguntaService.read().success(function (data) {
                        $scope.perguntas = data;
                        $scope.setEnquetePerguntaStyle();
                    });
                    // respostas
                    RespostaService.read().success(function (data) {
                        $scope.respostas = data;
                    });
                });
                // methods
                $scope.save = function (enquete) {
                    var isPersistedEnquete = false;
                    if (enquete.id) {
                        isPersistedEnquete = true;
                    }
                    EnqueteService.create(enquete).success(function (data, status) {
                        if (status == 201 && !isPersistedEnquete) {
                            $scope.enquetes.push(angular.copy(data));
                        }
                    });
                    $scope.clean();
                };
                $scope.edit = function (enquete) {
                    $scope.enquete = enquete;
                    $scope.setEnquetePerguntaStyle();
                };
                $scope.clean = function (enquete) {
                    $scope.enquete = EnqueteModel;
                };
                // Pergunta
                $scope.perguntaAdicionar = function (pergunta) {
                    $scope.perguntas.push(angular.copy(pergunta));
                    $scope.perguntaClean();
                };
                $scope.perguntaRemover = function (pergunta) {
                    for (var index = 0; index < $scope.perguntas.length; index++) {
                        if ($scope.perguntas[index].id == pergunta.id) {
                            $scope.perguntas.splice(index, 1);
                        }
                    }
                    $scope.perguntaClean(pergunta);
                };
                $scope.perguntaClean = function () {
                    $scope.pergunta = {id: null, pergunta: null};
                };
                // Resposta
                $scope.respostaAdd = function (resposta) {
                    $scope.respostas.push(angular.copy(resposta));
                    $scope.respostaClean();
                };
                $scope.respostaEdit = function (resposta) {
                    $scope.resposta = resposta;
                };
                $scope.respostaRemove = function (resposta) {
                    for (var index = 0; index < $scope.respostas.length; index++) {
                        if ($scope.respostas[index].id == resposta.id) {
                            $scope.respostas.splice(index, 1);
                        }
                    }
                };
                $scope.respostaClean = function () {
                    $scope.resposta = {id: null, resposta: null};
                };
                // MIX
                $scope.enquetePerguntaRemover = function (pergunta) {
                    for (var index = 0; index < $scope.enquete.perguntas.length; index++) {
                        if ($scope.enquete.perguntas[index].id == pergunta.id) {
                            $scope.enquete.perguntas.splice(index, 1);
                        }
                    }
                    $scope.setEnquetePerguntaStyle();
                };
                $scope.perguntaRespostaAdicionar = function (resposta) {
                    if ($scope.pergunta && !$scope.testIndexof($scope.pergunta.respostas, resposta)) {
                        $scope.pergunta.respostas.push(resposta);
                    }
                };
                $scope.perguntaRespostaRemover = function (pergunta, resposta) {
                    for (var index = 0; index < pergunta.respostas.length; index++) {
                        if (pergunta.respostas[index].id == resposta.id) {
                            pergunta.respostas.splice(index, 1);
                        }
                    }
                };
                $scope.setEnquetePerguntaStyle = function () {
                    if (!$scope.perguntas || !$scope.enquete) {
                        return;
                    }
                    for (var index1 = 0; index1 < $scope.perguntas.length; index1++) {
                        $scope.perguntas[index1].style = "";
                        if ($scope.enquete.perguntas) {
                            for (var index2 = 0; index2 < $scope.enquete.perguntas.length; index2++) {
                                if ($scope.perguntas[index1].id == $scope.enquete.perguntas[index2].id) {
                                    $scope.perguntas[index1].style = "added";
                                }
                            }
                        }
                    }
                };
                $scope.perguntaToScope = function (pergunta) {
                    if (!$scope.enquete) {
                        alert('Selecione uma enquete');
                        return;
                    }
                    for (var index = 0; index < $scope.enquete.perguntas.length; index++) {
                        $scope.enquete.perguntas[index].selecionada = false;
                    }
                    $scope.pergunta = pergunta;
                    $scope.pergunta.selecionada = true;
                };
                // Util
                $scope.testIndexof = function (list, object) {
                    for (var index = 0; index < list.length; index++) {
                        if (list[index].id == object.id) {
                            return true;
                        }
                    }
                    return false;
                };
            }]);
