<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get(
    '/',
    function (Request $request) use ($app) {
        $query = $request->get('q');
        $index = $app['pucene.index'];

        return $app['twig']->render('index.html.twig', ['query' => $query, 'texts' => $index->search($query)]);
    }
)->bind('list');

$app->post(
    '/',
    function (Request $request) use ($app) {
        $index = $app['pucene.index'];

        $index->index($request->get('text'));

        return $app['twig']->render('index.html.twig', []);
    }
)->bind('create');

$app->error(
    function (\Exception $e, Request $request, $code) use ($app) {
        if ($app['debug']) {
            return;
        }

        // 404.html, or 40x.html, or 4xx.html, or error.html
        $templates = [
            'errors/' . $code . '.html.twig',
            'errors/' . substr($code, 0, 2) . 'x.html.twig',
            'errors/' . substr($code, 0, 1) . 'xx.html.twig',
            'errors/default.html.twig',
        ];

        return new Response($app['twig']->resolveTemplate($templates)->render(['code' => $code]), $code);
    }
);
