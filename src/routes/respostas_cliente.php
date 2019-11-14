<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Chamado;
use App\Models\Resposta;
use App\Models\Mail;
use App\Aura\Filter\FilterFactory;

$modelChamado = new Chamado();
$model = new Resposta();
$ObjMail = new Mail();

$app->post('/api/v2/{clientToken}/respostas', function (Request $request, Response $response, array $args) use ($model, $ObjMail, $modelChamado) {
	
	$filter_factory = new FilterFactory;
    $filter = $filter_factory->newSubjectFilter();
    $filter->validate('clientToken')->is('string');
    $filter->validate('clientToken')->isNot('int');

    $dataToken['clientToken'] = $args['clientToken'];
    
    if (!$filter->apply($dataToken)) {
        $messages = $filter->getFailures()
            ->getMessages();
        return $response->withJson([
            'status' => 'error',
            'messages' => $messages
        ], 422);
    }

    $data = $request->getParsedBody();

	$filter_factory = new FilterFactory;
    $filter = $filter_factory->newSubjectFilter();
    $filter->validate('chaId')->is('int');
    $filter->validate('resNome')->is('string');
    $filter->validate('resNome')->isNot('int');
    $filter->validate('resConteudo')->is('string');
    
    if (!$filter->apply($data)) {
        $messages = $filter->getFailures()
            ->getMessages();
        return $response->withJson([
            'status' => 'error',
            'messages' => $messages
        ], 422);
    }

	if (!isset($data['usuId']) || trim($data['usuId']) == '' || empty($data['usuId'])) {
		$data['usuId'] = 0;
	}

	$resposta = $model->create($data);
	$chamado = $modelChamado->where('chaToken', $dataToken['clientToken'])->findOrFail($resposta->chaId);
	$chamados_ativo = $modelChamado->where('chaToken', $dataToken['clientToken'])->whereNull('completed_at')->count();

	$address = ['email@email.com'];
	$subject = 'O chamado número ' . $chamado->chaId . ' foi respondito';
	$bodyHtml = '
		<h1>Olá! Houve uma resposta no chamado.</h1>
		<p>Seguem os dados do chamado:</p>
		<p>Chamado: #'.$chamado->chaId.' </p>
		<p>Chamado: '.$chamado->chaDescricao.' </p>
		<p>Cliente: '.$chamado->chaNomeCliente.' </p>
		<p>Prioridade: '.$chamado->prioridade->priDescricao.' </p>
		<p>Tipo: '.$chamado->tipo->tipDescricao.' </p>
		<p>Data: '.$chamado->created_at.' </p>
	';

	if ($this->get('settings')['send_mail']['reply_chamado']) {
		if ($ObjMail->send($address, utf8_decode($subject), utf8_decode($bodyHtml))) {
			$dataEmail['chaId'] = $chamado->chaId;
			$dataEmail['emaAddress'] = serialize($address);
			$dataEmail['emaSuject'] = $subject;
			$dataEmail['emaBody'] = $bodyHtml;
			$ObjMail->create($dataEmail);
		}
	}
	
	$this->pusher->trigger('sis-channel', 'new-message', [
        'name_client' => $chamado->chaNomeCliente,
        'chamados_count' => $chamados_ativo,
        'message' => 'Houve uma resposta no chamado número ' . $chamado->chaId,
    ]);

	return $response->withJson($resposta);
});

$app->delete('/api/v2/{clientToken}/respostas/{id}', function (Request $request, Response $response, array $args) use ($model, $ObjMail) {

	$filter_factory = new FilterFactory;
    $filter = $filter_factory->newSubjectFilter();
    $filter->validate('clientToken')->is('string');
    $filter->validate('clientToken')->isNot('int');

    $dataToken['clientToken'] = $args['clientToken'];
    
    if (!$filter->apply($dataToken)) {
        $messages = $filter->getFailures()
            ->getMessages();
        return $response->withJson([
            'status' => 'error',
            'messages' => $messages
        ], 422);
    }

	$resposta = $model->join('tbchamados', 'tbchamados.chaId', '=', 'tbrespostas.chaId')->findOrFail($args['id']);
	$resposta->delete();
	return $response->withJson($resposta);
});