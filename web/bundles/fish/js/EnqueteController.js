var app = angular.module('enquete', []).controller(
	'EnqueteController', 
	['$scope', '$http', 'EnqueteService', 'RespostaService', function($scope, $http, EnqueteService, RespostaService) {
	// init
	EnqueteService.read().success(function(data) {
		$scope.enquetes = data;
//		$scope.enquete = $scope.enquetes[0];
		// respostas
		RespostaService.read().success(function(data) {
			$scope.respostas = data;
			if ($scope.enquete) {
				for (var index1 = 0; index1 < $scope.respostas.length; index1++) {
					for (var index2 = 0; index2 < $scope.enquete.pergunta.respostas.length; index2++) {
						if ($scope.respostas[index1].id == $scope.enquete.pergunta.respostas[index2].id) {
							$scope.respostas.splice(index1, 1);
						}
					}
				}
			}
		});
	});
	// methods
	$scope.save = function(enquete) {
		var isPersistedEnquete = false;
		if (enquete.id) {
			isPersistedEnquete = true;
		}
		EnqueteService.create(enquete).success(function(data, status){
			if (status == 201 && !isPersistedEnquete) {
				$scope.enquetes.push(angular.copy(data));
			}
		});
		$scope.clean();
	};
	$scope.edit = function(enquete) {
		$scope.enquete = enquete;
	};
	$scope.clean = function(enquete) {
		$scope.enquete = EnqueteModel;
	};
	$scope.perguntaRespostaRemover = function(resposta) {
		for (var index = 0; index < $scope.enquete.pergunta.respostas.length; index++) {
			if ($scope.enquete.pergunta.respostas[index].id == resposta.id) {
				$scope.enquete.pergunta.respostas.splice(index, 1);
				$scope.respostaAdicionar(resposta);
			}
		}
	};
	$scope.perguntaRespostaAdicionar = function(resposta) {
		$scope.respostaRemover(resposta);
		$scope.enquete.pergunta.respostas.push(resposta);
	};
	// methods for resposta
	$scope.respostaAdicionar = function(resposta) {
		console.log(resposta);
		$scope.respostas.push(resposta);
	};
	$scope.respostaRemover = function(resposta) {
		for (var index = 0; index < $scope.respostas.length; index++) {
			if ($scope.respostas[index].id == resposta.id) {
				$scope.respostas.splice(index, 1);
			}
		}
	};
}]);
