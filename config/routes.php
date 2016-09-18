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

$app->post('/user/{email}/friends', function ($request, $response, $args) {
    $repository = $this->em->getRepository(\Application\Entity\Member::class);

    $member = $repository->findOneBy('email', $args['email']);

    $friend = $repository->findOneBy('email', $request->getParam('email'));

    $friendRequest = new \Application\Entity\FriendRequest($member, $friend);

    $this->em->persist($friendRequest);
    $this->em->flush();

    return $response->withJson([]);
});

$app->get('/user/{email}/friends/accept/{id}', function ($request, $response, $args) {
    $repository = $this->em->getRepository(\Application\Entity\FriendRequest::class);
    $memberRepository = $this->em->getRepository(\Application\Entity\Member::class);

    $friendRequest = $repository->findOneById((int)$args['id']);

    $member = $memberRepository->findOneBy('email', $args['email']);

    if ($friendRequest->getTo() !== $member || $friendRequest->getStatus() !== null) {
        throw new \Symfony\Component\Finder\Exception\AccessDeniedException();
    }

    $member->addFriend($friendRequest->getFrom());
    $friend = $friendRequest->getFrom();
    $friend->addFriend($member);
    $friendRequest->accept();

    $this->em->persist($friendRequest);
    $this->em->persist($friend);
    $this->em->persist($member);
    $this->em->flush();

    return $response->withJson([]);
});
