<?php

namespace App\Controller;


use App\Services\Utils;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;


/**
 * Class ApiController
 * @package App\Controller
 */
class ApiController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/languages" , name="list_languages")
     * @param Utils $utils
     * @return View
     */
    public function listLanguagesAction(Utils $utils): View{

        return  $utils->listLanguages();

    }


    /**
     * @Rest\Get("/repos/language/{lang}/count", name="count_repos")
     * @param Utils $utils
     * @param string $lang
     * @return View
     */
    public function numberRepoByLanguageAction(Utils $utils, string $lang): View{

        return $utils->numberOfReposByLanguage($lang);

    }

    /**
     * @Rest\Get("/repos/language/{lang}" , name="list_repos")
     * @param Utils $utils
     * @param string $lang
     * @return View
     */
    public function listRepoByLanguageAction(Utils $utils, string $lang): View{

        return $utils->listReposByLanguage($lang);
    }

}