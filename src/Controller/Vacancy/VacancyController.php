<?php

namespace App\Controller\Vacancy;

use App\Entity\Vacancy;
use App\Services\VacancyServicesInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VacancyController extends AbstractController
{
    private $vacancyService;

    public function __construct(VacancyServicesInterface $vacancyServices)
    {
      $this->vacancyService = $vacancyServices;
    }

  /**
   * @Route("/", methods={"GET"})
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function index(Request $request)
    {

        $vacancyTitle = $request->query->get('vacancyTittle') ?? null;

        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;



        $vacancies = $this->vacancyService->getAll(['id' => $order], $limit, $offset);

        return $this->render('vacancy/index.html.twig', [
          'vacancies' => $vacancies,
          'vacancyTitle' => $vacancyTitle,
          'controller_name' => 'Vacancy Controller'
        ]);
    }

  /**
   * @Route("/create/show", methods={"GET"})
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function showCreate(Request $request)
    {
      return $this->render('vacancy/showCreate.html.twig', [
        'controller_name' => 'Vacancy Controller'
      ]);
    }

  /**
   * @Route("/create", methods={"POST"})
   * @param Request $request
   *
   */
    public function create(Request $request)
    {
      $requestData = $request->request->all();

      $userName = $this->getUser()->getUsername();
      //$userName = "admin@gmail.com";


      $vacancy = $this->vacancyService->create(
        $userName,
        $requestData["title"],
        $requestData["site"],
        $requestData["address"],
        $requestData["telephone"],
        $requestData["description"]
      );

      $params = $this->json($vacancy);

      return $this->redirectToRoute('index', array('vacancyTittle' => $vacancy->getTitle()));
    }


  /**
   * @Route("/delete/{id}", methods={"POST"})
   * @param int $id
   * @return JsonResponse
   *
   */
    public function delete(int $id): JsonResponse
    {
      $deletedId = $this->vacancyService->delete($id);

      return $this->json(['deletedId' => $deletedId]);
    }
}
