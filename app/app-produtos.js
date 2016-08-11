(function(){
  var app = angular.module('produtos',[ ]);

  app.controller('listaCtrl', ['$scope', '$http', '$filter', '$routeParams', function($scope, $http, $filter, $routeParams){
		$scope.id = $routeParams.id;
		$scope.nm = $routeParams.nm;
		$scope.produtos = [];
		
		// carrega produtos da lista
		$http.get("data/produtos.php?lista="+$scope.id).success(function(data){
			if (!data)
				$scope.addItem();
			else 
				$scope.produtos = data;
		}).error(function(data, status, headers, config){
			alert("Falha ao buscar dados!");
		});
		
		// calcula valor total dos itens
		$scope.getValorTotal = function(){
			var vl_total = 0;
			angular.forEach($scope.produtos, function(item){
				vl_total += item.qtde * item.valor;
			});
			return vl_total;
		}
		
		// adiciona item na tabela
		$scope.addItem = function(){
			$scope.produtos.push({'lista':$scope.id, 'codigo':0, 'nome': '', 'qtde': 1, 'valor':0, 'cesta':0});
		};
		
		// salva lista de produtos
		$scope.salvaProdutos = function(){
			if ($scope.getValorTotal() > 0){
				$http.post('data/produtos.php', $scope.produtos).success(function(data){
					alert('Lista atualizada!');
                //$location.url = '#/home';
				}).
				error(function(data, status, headers, config){
					alert('Falha ao atualizar lista de produtos! '+data);
				});	
			}
		};
		
		// remove item da lista
		$scope.removeItem = function(index){
			$scope.produtos.splice(index, 1);
		}
	
	}]);

})();	