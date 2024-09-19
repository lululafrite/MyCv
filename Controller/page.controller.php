<?php

    use MyCv\Model\Page;

    require('../model/page.class.php');
    
    $MyPage = new Page();

    if(isset($_POST['next']))
    {
        if ($_SESSION['pagination']['thePage'] >= $_SESSION['pagination']['nbOfPage'])
        {
            $MyPage->setLaPage($_SESSION['pagination']['nbOfPage']);
        }
        else
        {
            $MyPage->setFirstLine($_SESSION['pagination']['firstLine'] + $_SESSION['pagination']['productPerPage']);
            $_SESSION['pagination']['thePage'] = $_SESSION['pagination']['thePage'] + 1;
            $MyPage->setLaPage($_SESSION['pagination']['thePage']);
        }
        $_SESSION['pagination']['NextOrPrevious'] = true;
    }
    elseif (isset($_POST['previous']))
    {
        if ($MyPage->getLaPage() <= 1)
        {               
            $MyPage->setFirstLine(0);
            $MyPage->setLaPage(1);
        }
        else
        {
            $MyPage->setFirstLine($_SESSION['pagination']['firstLine'] - $_SESSION['pagination']['productPerPage']);
            $MyPage->setLaPage($MyPage->getLaPage() - 1);
        }
        $_SESSION['pagination']['NextOrPrevious'] = true;
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    
    $theTable = $_SESSION['theTable'];

    if (isset($_POST['nbOfLine'])){

        FctNbPage ($_POST['nbOfLine'], $MyPage, $theTable);

        $MyPage->setFirstLine(0);
        $MyPage->setLaPage(1);

    }else{

        FctNbPage ($_SESSION['pagination']['productPerPage'], $MyPage, $theTable);

    }

    $laPage = $_SESSION['pagination']['thePage'];
    $nbOfPage = $_SESSION['pagination']['nbOfPage'];

    //-----------------------------------------------------------------------------------
    
    function FctNbPage ($leNbDeLigneParPage, $MyPage_, $theTable_){

        $MyPage_->setNbDeLigneParPage($leNbDeLigneParPage);
        $MyPage_->setCountLine($theTable_);
        $_SESSION['pagination']['nbOfProduct'] = $MyPage_->getCountLine();

        $totalLigne = $MyPage_->getCountLine();
        
        if ($totalLigne < $leNbDeLigneParPage){
            $nbOfPage = 1;
            $MyPage_->setLaPage(1);            
        }else{
            $nbOfPage = ceil($totalLigne / $leNbDeLigneParPage);
            if ($nbOfPage < $MyPage_->getLaPage()){
                $MyPage_->setLaPage(1);
            }
        }
        $MyPage_->setnbOfPage($nbOfPage);
        
    }

?>