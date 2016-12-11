<?php // apiResultsDoctrine - src/routes_results.php

// TODO

use Swagger\Annotations as SWG;

$app->get(
    '/results',
    function ($request, $response, $args) {
        $this->logger->info('GET \'/results\'');
        $results = getEntityManager()
            ->getRepository('MiW16\Results\Entity\Result')
            ->findAll();

        if (empty($results)) { // 404 - User object not found
            $newResponse = $response->withStatus(404);
            $datos = array(
                'code' => 404,
                'message' => 'Result object not found'
            );
            return $this->renderer->render($newResponse, 'message.phtml', $datos);
        }

        return $response->withJson(array('results' => $results));
    }
)->setName('miw_cget_results');

$app->get(
    '/results/{id:[0-9]+}',
    function ($request, $response, $args) {
        $this->logger->info('GET \'/results/' . $args['id'] . '\'');
        $result = getEntityManager()
            ->getRepository('MiW16\Results\Entity\Result')
            ->findOneById($args['id']);

        if (empty($result)) {  // 404 - User id. not found
            $newResponse = $response->withStatus(404);
            $datos = array(
                'code' => 404,
                'message' => 'Result not found'
            );
            return $this->renderer->render($newResponse, 'message.phtml', $datos);
        }

        return $response->withJson($result);
    }
)->setName('miw_get_results');

$app->options(
    '/results',
    function ($request, $response, $args) {
        $this->logger->info('OPTIONS \'/results\'');

        return $response
            ->withHeader(
                'Allow',
                'OPTIONS, GET, POST, PUT'
            );
    }
)->setName('miw_options_results');

$app->post(
    '/results',
    function ($request, $response, $args) {
        $this->logger->info('POST \'/results\'');
        $data = json_decode($request->getBody(), true); // parse the JSON into an assoc. array
        // process $data...

        // TODO
        $newResponse = $response->withStatus(501);
        return $newResponse;
    }
)->setName('miw_post_results');

$app->put(
    '/results/{id:[0-9]+}',
    function ($request, $response, $args) {
        $this->logger->info('PUT \'/results\'');
        $data = json_decode($request->getBody(), true); // parse the JSON into an assoc. array
        // process $data...

        // TODO
        $newResponse = $response->withStatus(501);
        return $newResponse;
    }
)->setName('miw_put_results');
