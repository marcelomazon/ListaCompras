(function (){
	var app = angular.module('ListaCompras',['ngRoute','produtos']);

	app.config(function($routeProvider) {
		$routeProvider
			.when('/home', {
				templateUrl: 'home.html',
				controller: 'homeCtrl'
			})
			.when('/lista/:id/:nm', {
				templateUrl: 'lista.html',
				controller: 'listaCtrl'
			})
			.otherwise({
				redirectTo: '/home'
			});
	});
	
	app.controller('homeCtrl', ['$scope', '$http', '$filter', function($scope, $http, $filter){
		$scope.message = "Minhas Listas de Compras";
		$scope.nm_lista = '';

		$scope.listas = [];

		$http.get("data/listas.php").success(function(data){
			$scope.listas = data;
		}).error(function(data, status, headers, config){
			alert("Falha ao buscar dados!");
		});

		$scope.addLista = function(){
			if ($scope.nm_lista != ''){
				$http.post('data/listas.php', $scope.nm_lista).success(function(data){
					if (data > 0){
						$scope.listas.push({'codigo': data, 'nome':$scope.nm_lista, 'qtde': 0, 'total': 0})
						$scope.nm_lista = '';
					}else{
						alert('Falha ao criar Lista '+$scope.nm_lista);
					}
				}).
				error(function(data, status, headers, config){
					alert('Falha ao gravar lista! '+data);
				});	
				
				
			}
		};

        $scope.excluiLista = function(lista,indice){
            $http.delete('data/listas.php?id='+lista).success(function(data) {
				$scope.listas.splice(indice, 1);
			}).
            error(function(data, status, headers, config) {
				alert("Falha ao excluir lista!");
			});
		};
		
	}]);

	app.directive('ngConfirmClick', [ function(){
		return {
			link: function (scope, element, attr) {
				var msg = attr.ngConfirmClick || "Are you sure?";
				var clickAction = attr.confirmedClick;
				element.bind('click',function (event) {
					if ( window.confirm(msg) ) {
						scope.$eval(clickAction)
					}
				});
			}
		};
	}])

	
})();