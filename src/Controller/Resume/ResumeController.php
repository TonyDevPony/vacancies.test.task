<?php

namespace App\Controller\Resume;

use App\Entity\Resume;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\ResumeService\ResumeService;
use App\Services\ResumeStatusService\ResumeStatusService;
use App\Services\VacancyService\VacancyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResumeController extends AbstractController
{
    private $resumeService;

    private $userRepository;

    private $resumeStatusService;

    private $vacancyService;


    public function __construct(ResumeService $resumeService, UserRepository $userRepository,
                                ResumeStatusService $resumeStatusService, VacancyService $vacancyService)
    {
      $this->resumeService = $resumeService;
      $this->userRepository = $userRepository;
      $this->resumeStatusService = $resumeStatusService;
      $this->vacancyService = $vacancyService;
    }

  /**
   * @Route("/resume/list", name="resumeList")
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function index()
    {
        $userLogin = $this->getUser()->getUsername();
        $userId = $this->userRepository->getUserId($userLogin);

        $resumeList = $this->resumeService->getAll(['creatorId' => $userId]);

        return $this->render('resume/index.html.twig', [
            'resumeList'      => $resumeList,
        ]);
    }


    /**
     * @Route("/resume/show/create", name="showCreate", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCreate()
    {
      return $this->render('resume/showCreate.html.twig', []);
    }

    /**
     * @Route("/resume/create/", name="resumeCreate", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function create(Request $request)
    {
      $requestData = $request->request->all();

      $userLogin = $this->getUser()->getUsername();
      $userId = $this->userRepository->getUserId($userLogin);

      $resume = $this->resumeService->create(
        $userId,
        $requestData["positionTitle"],
        $requestData["resumeText"]
      );

      return $this->redirectToRoute('resumeList');

    }

    /**
     * @Route("resume/show/update/{id}", name="showUpdate", methods={"GET"})
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showUpdate(int $id, Request $request)
    {
      $resume = $this->resumeService->getOne(['resumeId' => $id]);

      return $this->render('resume/showUpdate.html.twig', [
        'resume' => $resume
      ]);
    }

  /**
   * @Route("resume/update/{id}", name="resumeUpdate", methods={"POST"})
   * @param int $id
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
    public function update(int $id, Request $request)
    {
      $requestData = $request->request->all();
      $userLogin = $this->getUser()->getUsername();
      $userId = $this->userRepository->getUserId($userLogin);

      $this->resumeService->update($id, $userId, $requestData['positionTitle'], $requestData['resumeText']);

      return $this->redirectToRoute('resumeList');

    }

  /**
   * @Route("resume/delete/{id}", name="resumeDelete", methods={"POST"})
   * @param int $id
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
    public function delete(int $id)
    {
      $this->resumeService->delete($id);

      return $this->redirectToRoute('resumeList');
    }

  /**
   * @Route("resume/show/{id}", name="resumeShow", methods={"GET"})
   * @param int $id
   * @return \Symfony\Component\HttpFoundation\Response
   */
    public function show(int $id)
    {
      $resume = $this->resumeService->getOne(['resumeId' => $id]);

      return $this->render('resume/resumeShow.html.twig', [
        'resume' => $resume
      ]);
    }

  /**
   * @Route("resume/send/{resumeId}/{vacancyId}", name="resumeSend", methods={"POST"})
   * @param int $resumeId
   * @param int $vacancyId
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
    public function sendResume(int $resumeId, int $vacancyId)
    {
        $this->resumeService->send($vacancyId, $resumeId);


        return $this->redirectToRoute('index');
    }

    /**
     * @Route("resume/approve/{resumeId}/{vacancyId}", name="resumeApprove", methods={"POST"})
     * @param int $resumeId
     * @param int $vacancyId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function approve(int $resumeId, int $vacancyId)
    {
      $this->resumeService->approve($resumeId);


      return $this->redirectToRoute('showVacancy', ['id' => $vacancyId]);
    }

    /**
     * @Route("resume/reject/{resumeId}/{vacancyId}", name="resumeReject", methods={"POST"})
     * @param int $resumeId
     * @param int $vacancyId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function reject(int $resumeId, int $vacancyId)
    {
      $this->resumeService->reject($resumeId);

      return $this->redirectToRoute('showVacancy', ['id' => $vacancyId]);
    }

}
