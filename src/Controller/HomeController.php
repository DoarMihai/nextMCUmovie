<?php

namespace App\Controller;

use App\Service\MovieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** @var MovieService */
    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $movieInfo = $this->movieService->getMovieInfo();

        //dump($movieInfo); die;

        return $this->render('home.html.twig', compact('movieInfo'));
    }
}
