<?php
    
    require('../../goldorak/model/page.class.php');
    
    $MyPage = new Page();

    if(isset($_POST['next']))
    {
        if ($_SESSION['laPage'] >= $_SESSION['nbOfPage'])
        {
            $MyPage->setLaPage($_SESSION['nbOfPage']);
        }
        else
        {
            $MyPage->setFirstLine($_SESSION['firstLine'] + $_SESSION['ligneParPage']);
            $_SESSION['laPage'] = $_SESSION['laPage'] + 1;
            $MyPage->setLaPage($_SESSION['laPage']);
        }
        $_SESSION['NextOrPrevious'] = true;
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
            $MyPage->setFirstLine($_SESSION['firstLine'] - $_SESSION['ligneParPage']);
            $MyPage->setLaPage($MyPage->getLaPage() - 1);
        }
        $_SESSION['NextOrPrevious'] = true;
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    
    $theTable = $_SESSION['theTable'];

    if (isset($_POST['nbOfLine'])){

        FctNbPage ($_POST['nbOfLine'], $MyPage, $theTable);

        $MyPage->setFirstLine(0);
        $MyPage->setLaPage(1);

    }else{

        FctNbPage ($_SESSION['ligneParPage'], $MyPage, $theTable);

    }

    $laPage = $_SESSION['laPage'];
    $nbOfPage = $_SESSION['nbOfPage'];

    //-----------------------------------------------------------------------------------
    
    function FctNbPage ($leNbDeLigneParPage, $MyPage_, $theTable_){

        $MyPage_->setNbDeLigneParPage($leNbDeLigneParPage);
        $MyPage_->setCountLine($theTable_);
        $_SESSION['nbOfProduct'] = $MyPage_->getCountLine();

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