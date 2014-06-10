<?php

namespace Leopro\TripPlanner\PresentationBundle\Controller;

use Leopro\TripPlanner\Application\Command\CreateTripCommand;
use Leopro\TripPlanner\PresentationBundle\Form\Type\CreateTripType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @return array
     *
     * @Route("/", name="create_trip")
     * @Template
     */
    public function createTripAction(Request $request)
    {
        $form = $this->createForm(new CreateTripType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $trip = $this->get('command_handler')->execute($form->getData());

            return new Response('ok');
        }

        return array(
            'form' => $form->createView(),
        );
    }
} 