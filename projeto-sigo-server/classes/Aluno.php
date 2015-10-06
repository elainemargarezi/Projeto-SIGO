<?php 
class Aluno{
	function post_adicionarAluno($aluno){
		$sqlInsertEndereco = "INSERT INTO endereco (rua,bairro,numero,complemento,cep,cidade,uf) 
		VALUES (:rua,:bairro,:numero,:complemento,:cep,:cidade,:uf)";
		$sqlInsertResponsavel = "INSERT INTO responsavel (nome,cpf,telefone,celular,operadora,email,idEndereco) 
		VALUES (:nome,:cpf,:telefone,:celular,:operadora,:email,:idEndereco)";
		$sqlInsertAluno = "INSERT INTO aluno (nome,matricula,turma,serie,dataNascimento,sexo,telefone,celular,operadora,
			idResponsavel) 
		VALUES (:nome,:matricula,:turma,:serie,:dataNascimento,:sexo,:telefone,:celular,:operadora,:idResponsavel)";
		 try {
            DB::beginTransaction();

            $stmt = DB::prepare($sqlInsertEndereco);
			$stmt->bindParam("rua",$aluno->enderecoRua);
			$stmt->bindParam("bairro",$aluno->enderecoBairro);
			$stmt->bindParam("numero",$aluno->enderecoNumero);
			$stmt->bindParam("complemento",$aluno->enderecoComplemento);
			$stmt->bindParam("cep",$aluno->enderecoCep);
			$stmt->bindParam("cidade",$aluno->enderecoCidade);
			$stmt->bindParam("uf",$aluno->enderecoUf);
			$stmt->execute();
			$aluno->idEndereco = DB::lastInsertId();

			$stmt = DB::prepare($sqlInsertResponsavel);
			$stmt->bindParam("nome",$aluno->responsavelNome);
			$stmt->bindParam("cpf",$aluno->responsavelCpf);
			$stmt->bindParam("telefone",$aluno->responsavelTelefone);
			$stmt->bindParam("celular",$aluno->responsavelCelular);
			$stmt->bindParam("operadora",$aluno->responsavelOperadora);
			$stmt->bindParam("email",$aluno->responsavelEmail);
			$stmt->bindParam("idEndereco",$aluno->idEndereco);
			$stmt->execute();
			$aluno->idResponsavel = DB::lastInsertId();

			$stmt = DB::prepare($sqlInsertAluno);
			$stmt->bindParam("nome",$aluno->alunoNome);
			$stmt->bindParam("matricula",$aluno->alunoMatricula);
			$stmt->bindParam("turma",$aluno->alunoTurma);
			$stmt->bindParam("serie",$aluno->alunoSerie);
			$stmt->bindParam("dataNascimento",DB::dateToMySql($aluno->alunoDataNasc));
			$stmt->bindParam("sexo",$aluno->alunoSexo);
			$stmt->bindParam("telefone",$aluno->alunoTelefone);
			$stmt->bindParam("celular",$aluno->alunoCelular);
			$stmt->bindParam("operadora",$aluno->alunoOperadora);
			$stmt->bindParam("idResponsavel",$aluno->idResponsavel);
			$stmt->execute();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw new Exception($ex->getMessage());
        }
        return $aluno;
    }
    function get_carregarAlunos(){
	    $sqlCarregarAlunos = "SELECT al.idAluno,al.nome as alunoNome,al.matricula,al.turma,al.serie,res.nome as responsavelNome,
	    res.telefone as responsavelTelefone,res.celular as responsavelCelular,res.operadora as responsavelOperadora, 
	    res.email as responsavelEmail FROM aluno al INNER JOIN responsavel res ON al.idResponsavel = res.idResponsavel 
	    INNER JOIN endereco en ON res.idEndereco = en.idEndereco";
    	$stmt = DB::prepare($sqlCarregarAlunos);
		$stmt->execute();
		return $stmt->fetchAll();
    }
    function get_carregarAluno($idAluno){
	    	$sqlCarregarAluno = "SELECT al.idAluno,al.nome as alunoNome,al.matricula as alunoMatricula,al.turma as alunoTurma,
	    	al.serie as alunoSerie,al.dataNascimento as alunoDataNasc,al.sexo as alunoSexo,al.telefone as alunoTelefone,
	    	al.celular as alunoCelular,al.operadora as alunoOperadora,res.idResponsavel,res.nome as responsavelNome,
	    	res.cpf as responsavelCpf,res.telefone as responsavelTelefone,res.celular as responsavelCelular,
	    	res.operadora as responsavelOperadora,res.email as responsavelEmail,en.idEndereco,en.rua as enderecoRua,
	    	en.bairro as enderecoBairro,en.numero as enderecoNumero,en.complemento as enderecoComplemento,en.cep as enderecoCep,
	    	en.cidade as enderecoCidade,en.uf as enderecoUf 
			FROM aluno al INNER JOIN responsavel res ON al.idResponsavel = res.idResponsavel 
			INNER JOIN endereco en ON res.idEndereco = en.idEndereco WHERE idAluno = $idAluno";
	    	$stmt = DB::prepare($sqlCarregarAluno);
			$stmt->execute();
			return $stmt->fetchAll();
    }
    function post_deletarAluno($aluno){
    	$sqlDeletarEndereco = "DELETE FROM endereco WHERE idEndereco = :idEndereco";
    	$sqlDeletarResponsavel = "DELETE FROM responsavel WHERE idResponsavel = :idResponsavel";
	    $sqlDeletarAluno = "DELETE FROM aluno WHERE idAluno = :idAluno";
	    try {
            DB::beginTransaction();
            $stmt = DB::prepare($sqlDeletarEndereco);
            $stmt->bindParam("idEndereco",$aluno->idEndereco);
            $stmt->execute();

            $stmt = DB::prepare($sqlDeletarResponsavel);
            $stmt->bindParam("idResponsavel",$aluno->idResponsavel);
            $stmt->execute();

            $stmt = DB::prepare($sqlDeletarAluno);
            $stmt->bindParam("idAluno",$aluno->idAluno);
			$stmt->execute();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw new Exception($ex->getMessage());
        }
    }
}