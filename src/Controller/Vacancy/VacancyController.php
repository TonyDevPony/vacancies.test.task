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
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;



        $vacancies = $this->vacancyService->getAll(['id' => $order], $limit, $offset);
        return $this->render('vacancy/index.html.twig', [
          'vacancies' => $vacancies,
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
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
    public function create(Request $request)
    {
      $requestData = $request->request->all();

      $userName = $this->getUser()->getUsername();


      $vacancy = $this->vacancyService->create(
        $userName,
        $requestData["title"],
        $requestData["site"],
        $requestData["address"],
        $requestData["telephone"],
        $requestData["description"]
      );

      return $this->redirectToRoute('index');
    }

  /**
   * @Route("/delete/{id}", methods={"POST"})
   * @param int $id
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
    public function delete(int $id)
    {
      $deletedId = $this->vacancyService->delete($id);

      return $this->redirectToRoute('index');
    }

  /**
   * @Route("/update/show/{id}", methods={"GET"})
   * @param int $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function updateShow(int $id)
    {
      $vacancy = $this->vacancyService->getOne($id);

      return $this->render('vacancy/showUpdate.html.twig', [
        'vacancy' => $vacancy
      ]);
    }

  /**
   * @Route("/update/{id}", methods={"POST"})
   * @param int $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
    public function update(int $id, Request $request)
    {
      $requestData = $request->request->all();

      $this->vacancyService->update($id, $requestData['title'],
                                    $requestData['site'], $requestData['address'],
                                    $requestData['telephone'], $requestData['description']);

      return $this->redirectToRoute('index');
    }
}
