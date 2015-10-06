app.controller('pesquisaAlunoCtrl', function($scope,aluno,alunoAPI){
  	
  	$scope.alunos = aluno.data.result;

  	/* var alunoteste = $scope.alunos.filter(function(elemento){
		return elemento.idAluno === "1"; implementar carregamento do form apartir do array existente
	});
  	console.log(alunoteste);*/
  	
  	$scope.ordenarPor = function (campo) {
		$scope.criterioDeOrdenacao = campo;
		$scope.direcaoDaOrdenacao = !$scope.direcaoDaOrdenacao;
	};
	$scope.deletarAlunos = function(alunos) {
        $scope.alunos = alunos.filter(function(aluno) {
        	if (!aluno.selecionado){
	            return aluno;
           	}//lista na table somente quem não foi selecionado para exclusão
            if (aluno.selecionado){
	            alunoAPI.deleteAluno(aluno).success(function(data){//persiste o delete no banco
	  				//implementar um loader aqui
	        	}).error(function(data) {
	        	 	console.log(data);
	        	});
           	}
        });
    };
	$scope.isAlunoSelecionado = function(alunos) {
        return alunos.some(function(aluno) {
            return aluno.selecionado;
        });
    };
});