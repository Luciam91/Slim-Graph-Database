<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $response;
});

$app->post('/user/create', function ($request, $response, $args) {
    $repository = $this->em->getRepository(\Application\Entity\Member::class);

    $member = new \Application\Entity\Member(
        $request->getParam('email'),
        $request->getParam('forename'),
        $request->getParam('surname')
    );

    $this->em->persist($member);
    $this->em->flush();

    return $response->withJson([]);
});

$app->post('/user/{id}/friends', function ($request, $response, $args) {
    $repository = $this->em->getRepository(\Application\Entity\Member::class);

    $member = $repository->findOneBy('email', $args['id']);

    $friend = $repository->findOneBy('email', $request->getParam('email'));

    $member->addFriend($friend);

    $this->em->persist($member);
    $this->em->flush();

    return $response->withJson([]);
});
