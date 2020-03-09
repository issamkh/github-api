<?php

namespace App\Services;


use App\GitHubApi\GitHubApi;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Utils
 * @package App\Services
 */
class Utils extends AbstractFOSRestController
{
    /** @var mixed[] */
    private $data;

    public function __construct()
    {
        $this->data = GitHubApi::callApi();
    }

    /**
     * get a list of github repositories languages
     * @return  View
     */
    public function listLanguages(): View{

        try {
            $languages = [];
            foreach ($this->data['items'] as $item){
                if(!in_array($item['language'],$languages)){
                    $languages[] = $item['language'];
                }
            }
            return $this->view($languages, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->view(
                [
                    'message' => 'Impossible to get languages',
                    'errorCode' => $e->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * count a number of repositories by specific language
     * @param string $lang
     * @return View
     */
    public function numberOfReposByLanguage($lang): View{

        try{
            $number = 0;
            foreach ($this->data['items'] as $item){
                if($item['language'] == $lang){
                    $number ++;
                }
            }
            return $this->view($number, Response::HTTP_OK);

        } catch(\Exception $e){

            return $this->view(
                [
                    'message' => 'Impossible to get count of repositories',
                    'errorCode' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * list of repositories by specific language
     * @param $lang
     * @return View
     */
    public function listReposByLanguage($lang): View{

        try{

            $repos = array_filter($this->data['items'], function ($item) use ($lang){

                return $item['language'] == $lang ;
            });

            return $this->view($repos, Response::HTTP_OK);

        } catch(\Exception $e){

            return $this->view(
                [
                    'message' => 'Impossible to get list of repositories',
                    'errorCode' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}