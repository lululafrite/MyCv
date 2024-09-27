<?php

    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
		require_once('../../model/page.class.php');
    }else{
		require_once('../model/page.class.php');
    }

    use MyCv\Model\Page;
    $MyPage = new Page();

    //-----------------------------------------------------------------------------------

    $MyPage->setThePage($_SESSION['pagination']['thePage']);
    $MyPage->setNbOfPage($_SESSION['pagination']['nbOfPage']);
    $MyPage->setFirstProduct($_SESSION['pagination']['firstProduct']);
    $MyPage->setProductPerPage($_SESSION['pagination']['productPerPage']);
    $MyPage->setNbOfProduct($_SESSION['pagination']['nbOfProduct']);
    $MyPage->setNextOrPrevious($_SESSION['pagination']['NextOrPrevious']);

    //-----------------------------------------------------------------------------------
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $next = isset($_POST['next']) ? true : false;
        $previous = isset($_POST['previous']) ? true : false;

        if($next)
        {
            if ($MyPage->getThePage() >= $MyPage->getNbOfPage()){
                $MyPage->setThePage($MyPage->getNbOfPage());
            }else{
                $MyPage->setFirstProduct($MyPage->getFirstProduct() + $MyPage->getProductPerPage());
                $MyPage->setThePage($MyPage->getThePage() + 1);
            }
            $MyPage->setNextOrPrevious(true);

        }elseif ($previous){

            if ($MyPage->getThePage() <= 1)
            {               
                $MyPage->setFirstProduct(0);
                $MyPage->setThePage(1);
            }else{
                $MyPage->setFirstProduct($MyPage->getFirstProduct() - $MyPage->getProductPerPage());
                $MyPage->setThePage($MyPage->getThePage() - 1);
            }
            $MyPage->setNextOrPrevious(true);
        }

        //-----------------------------------------------------------------------------------
        
        if(isset($_POST['nbOfProduct'])){
            $MyPage->setProductPerPage($_POST['nbOfProduct']);
            $MyPage->setFirstProduct(0);
            $MyPage->setThePage(1);
        }

        Page::FctNbPage($MyPage->getProductPerPage(), $MyPage, "user");
    }

    //-----------------------------------------------------------------------------------

    $_SESSION['pagination']['thePage'] = $MyPage->getThePage();
    $_SESSION['pagination']['nbOfPage'] = $MyPage->getNbOfPage();
    $_SESSION['pagination']['firstProduct'] = $MyPage->getFirstProduct();
    $_SESSION['pagination']['productPerPage'] = $MyPage->getProductPerPage();
    $_SESSION['pagination']['nbOfProduct'] = $MyPage->getNbOfProduct();
    $_SESSION['pagination']['NextOrPrevious'] = $MyPage->getNextOrPrevious();


    //-----------------------------------------------------------------------------------

    $page = array(
        'thePage' => $MyPage->getThePage(),
        'nbOfPage' => $MyPage->getNbOfPage(),
        'firstProduct' => $MyPage->getFirstProduct(),
        'productPerPage' => $MyPage->getProductPerPage(),
        'nbOfProduct' => $MyPage->getNbOfProduct(),
        'NextOrPrevious' => $MyPage->getNextOrPrevious()
    );

?>