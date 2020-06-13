<?php

namespace App\Controller\Vacancy;

use App\Entity\Vacancy;
use App\Services\ResumeService\ResumeService;
use App\Services\ResumeStatusService\ResumeStatusService;
use App\Services\VacancyService\VacancyServicesInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class VacancyController extends AbstractController
{
    private $vacancyService;

    private $userRepository;

    private $resumeService;

    private $resumeStatusService;

    public function __construct(VacancyServicesInterface $vacancyServices, UserRepository $userRepository,
                                ResumeService $resumeService, ResumeStatusService $resumeStatusService)
    {
      $this->vacancyService = $vacancyServices;
      $this->userRepository = $userRepository;
      $this->resumeService = $resumeService;
      $this->resumeStatusService = $resumeStatusService;
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

        $userName = $this->getUser()->getUsername();



        $vacancies = $this->vacancyService->getAll([], ['id' => $order],$limit, $offset);
        return $this->render('vacancy/index.html.twig', [
          'vacancies' => $vacancies,
          'userName'  => $userName
        ]);
    }

    /**
     * @Route("/show/{id}", name="showVacancy", methods={"GET"})
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(int $id)
    {
      $vacancy = $this->vacancyService->getOne($id);
      $userLogin = $this->getUser()->getUsername();
      $userId = $this->userRepository->getUserId($userLogin);

      $usersResumeList = $this->resumeService->getAll(['creatorId' => $userId]);
      $pendingResumeList = $this->resumeStatusService->getPendingResumeList($id);

      return $this->render('vacancy/vacancyShow.html.twig', [
        'vacancy'           => $vacancy,
        'resumeList'        => $usersResumeList,
        'userLogin'         => $userLogin,
        'pendingResumeList' => $pendingResumeList,
      ]);
    }

    /**
     * @Route("/vacancy/list/user/", name="vacanciesUser", methods={"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showVacancyForUser()
    {
      $userLogin = $this->getUser()->getUsername();

      $vacancyList = $this->vacancyService->getAll(['creatorName' => $userLogin]);

      return $this->render('vacancy/listUserVacancy.html.twig', [
        'vacancies'      => $vacancyList,
      ]);
    }

  /**
   * @Route("/create/show", name="createVacancy",methods={"GET"})
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
