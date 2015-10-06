app.factory('alunoAPI', function($http,config){
	var _getAlunos = function(aluno){
        return $http.get(config.baseURLExterna + "/Aluno/carregarAlunos");
    };
    var _getAluno = function(id){
        return $http.get(config.baseURLExterna + "/Aluno/carregarAluno/" + id);
    };
    var _saveAluno = function(aluno){
        return $http.post(config.baseURLExterna + "/Aluno/adicionarAluno",aluno);
    };
    var _deleteAluno = function(aluno){
        return $http.post(config.baseURLExterna + "/Aluno/deletarAluno",aluno);
    };
    return {
    	getAlunos:_getAlunos,
        getAluno:_getAluno,
        saveAluno: _saveAluno,
        deleteAluno:_deleteAluno
    }
});