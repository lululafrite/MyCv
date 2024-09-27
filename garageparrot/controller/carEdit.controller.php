<?php

    $checkUrl = preg_match('/goldorak/', $_SERVER['REQUEST_URI']) || preg_match('/garageparrot/', $_SERVER['REQUEST_URI']);
    if($checkUrl){
        require_once('../../garageparrot/model/car.class.php');
        require_once('../../garageparrot/model/brand.class.php');
        require_once('../../garageparrot/model/model.class.php');
        require_once('../../garageparrot/model/motorization.class.php');
        require_once('../../model/utilities.class.php');

    }else{
        require_once('../garageparrot/model/car.class.php');
        require_once('../garageparrot/model/brand.class.php');
        require_once('../garageparrot/model/model.class.php');
        require_once('../garageparrot/model/motorization.class.php');
        require_once('../garageparrot/model/carForm.class.php');
        require_once('../model/utilities.class.php');
    }

    use GarageParrot\Model\Car;
    use GarageParrot\Model\Brand;
    use GarageParrot\Model\Model;
    use GarageParrot\Model\Motorization;
    use GarageParrot\Model\CarForm;
    use MyCv\Model\Utilities;
    
    $MyCar = new Car();
    $MyCarForm = new CarForm();
   
    $cars = array("id_car" => 0);
    $MyBrand = array();
    $MyModel = array();
    $MyMotorization = array();
    
    $btnUpdate = false; settype($btnUpdate, 'boolean');
    $btnImage = false; settype($btnImage, 'boolean');
    $changeImage = false; settype($changeImage, 'boolean');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $MyCarForm->setBtnCarEdit(isset($_POST['btn_userEdit']) ? true : false); //Button in the table to edit a user (user.php)
            
        $MyCarForm->setBtnNavBarInsert(isset($_POST['btn_navBar_new']) ? true : false); //Button in the navigation bar to insert a new user
        
        $MyCarForm->setBtnInsert(isset($_POST['btn_userEdit_new']) ? true : false); //Button in the form to user (userEdit.php)
        $MyCarForm->setBtnDelete(isset($_POST['btn_userEdit_delete']) ? true : false); //Button in the form to user (userEdit.php)
        $MyCarForm->setBtnCancel(isset($_POST['btn_userEdit_cancel']) ? true : false); //Button in the form to user (userEdit.php)

        $MyCarForm->setBtnUpdate(isset($_POST['btn_userEdit_save']) ? true : false); //Button in the form to user (userEdit.php)
        $MyCarForm->setBtnUpdate1(isset($_POST['btn_userEdit_save_1']) ? true : false); //Button in the form to user (userEdit.php)
        $btnUpdate = $MyCarForm->getBtnUpdate1() ? true : $MyCarForm->getBtnUpdate();
        
        $MyCarForm->setBtnImage1(isset($_POST['btn_image1']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        $MyCarForm->setBtnImage2(isset($_POST['btn_image2']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        $MyCarForm->setBtnImage3(isset($_POST['btn_image3']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        $MyCarForm->setBtnImage4(isset($_POST['btn_image4']) ? true : false); //Button in the form to suscribe a new user (adherer.php)
        $MyCarForm->setBtnImage5(isset($_POST['btn_image5']) ? true : false); //Button in the form to suscribe a new user (adherer.php)

        $MyCarForm->setNewError(isset($_GET['newError']) ? filter_input('newError', INPUT_GET) : false);

        $MyCar->setId(isset($_POST["txt_car_id"]) ? Utilities::filterInput('txt_carEdit_id') : 0);
        $MyCar->setBrand(isset($_POST["txt_car_brand"]) ? Utilities::filterInput('txt_car_brand') : '');
        $MyCar->setModel(isset($_POST["txt_car_model"]) ? Utilities::filterInput('txt_car_model') : '');
        $MyCar->setMotorization(isset($_POST["txt_car_motorization"]) ? Utilities::filterInput('txt_car_motorization') : '');
        $MyCar->setYear(isset($_POST["txt_car_year"]) ? Utilities::filterInput('txt_car_year') : '');
        $MyCar->setMileage(isset($_POST['txt_car_mileage']) ? Utilities::filterInput('txt_car_mileage') : '');
        $MyCar->setPrice(isset($_POST["txt_car_price"]) ? Utilities::filterInput('txt_car_price') : '');
        $MyCar->setSold(isset($_POST["txt_car_available"]) ? Utilities::filterInput('txt_car_available') : '');
        $MyCar->setDescription(isset($_POST["txt_car_description"]) ? Utilities::filterInput('txt_car_description') : '');
        
        $MyCar->setImage1(isset($_POST["txt_carEdit_image1"]) ? Utilities::filterInput('txt_carEdit_image1') : '_.webp');
        $MyCar->setImage2(isset($_POST["txt_carEdit_image2"]) ? Utilities::filterInput('txt_carEdit_image2') : '_.webp');
        $MyCar->setImage3(isset($_POST["txt_carEdit_image3"]) ? Utilities::filterInput('txt_carEdit_image3') : '_.webp');
        $MyCar->setImage4(isset($_POST["txt_carEdit_image4"]) ? Utilities::filterInput('txt_carEdit_image4') : '_.webp');
        $MyCar->setImage5(isset($_POST["txt_carEdit_image5"]) ? Utilities::filterInput('txt_carEdit_image5') : '_.webp');

        $btnImage = $MyCarForm->getBtnImage1() || $MyCarForm->getBtnImage2() || $MyCarForm->getBtnImage3() || $MyCarForm->getBtnImage4() || $MyCarForm->getBtnImage5();
    }

    //***********************************************************************************************
    // CRUD
    //***********************************************************************************************
    
    if($MyCarForm->getBtnCarEdit()){

        $cars = $MyCar->getCurrentCar($MyCar->getId());
        $cars['message'] = "";

        $MyBrand = myBrand();
        $MyModel = myModel();
        $MyMotorization = myMotorization();

        return;

    }
    
    if(Utilities::verifCsrf('csrf')){

        if($btnUpdate){

            if($MyCar->getId() === 0){
                    
                $MyCar->InsertCar();
                $newUser = $MyCar->insertCar();

                return;

            }else{

                $updateCar = $MyCar->updateCar($MyCar->getId());
                $cars = initTabUser($cars, $MyCar, $MyCarForm);

                $cars['message'] = $_SESSION['other']['message'];
                
                $MyBrand = myBrand();
                $MyModel = myModel();
                $MyMotorization = myMotorization();

                return;
            }

        }else if($MyUserForm->getBtnInsert() || $MyUserForm->getBtnNavBarInsert()){
            
            resetCarVar($MyCar, $MyCarForm);
            $cars = initTabCar($cars, $MyCar, $MyCarForm);

            $MyBrand = myBrand();
            $MyModel = myModel();
            $MyMotorization = myMotorization();

            return;

        }else if($MyUserForm->getBtnDelete()){
                
            $deleteCar = $MyCar->deleteCar($MyCar->getId());
            Utilities::redirectToPage('car');

        }else if($MyUserForm->getBtnCancel()){
        
            Utilities::redirectToPage('car');
    
        }else if($btnImage){
            
            $uploadDirectory = './img/vehicle/';

            $_SESSION['car']['uploadImage1'] = $MyCar->getImage1();
            $_SESSION['car']['uploadImage2'] = $MyCar->getImage2();
            $_SESSION['car']['uploadImage3'] = $MyCar->getImage3();
            $_SESSION['car']['uploadImage4'] = $MyCar->getImage4();
            $_SESSION['car']['uploadImage5'] = $MyCar->getImage5();

            if (isset($_FILES["fileInput1"]) && $_FILES["fileInput1"]["error"] == UPLOAD_ERR_OK){

                $_SESSION['car']['uploadImage1'] = $_FILES["fileInput1"]["name"];
                $sourceFile = $_FILES["fileInput1"]["tmp_name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput1"]["name"]);
                unset($_FILES["fileInput1"]);

            }else if (isset($_FILES["fileInput2"]) && $_FILES["fileInput2"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput2"]["tmp_name"];
                $_SESSION['car']['uploadImage2'] = $_FILES["fileInput2"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput2"]["name"]);
                unset($_FILES["fileInput2"]);

            }else if (isset($_FILES["fileInput3"]) && $_FILES["fileInput3"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput3"]["tmp_name"];
                $_SESSION['car']['uploadImage3'] = $_FILES["fileInput3"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput3"]["name"]);
                unset($_FILES["fileInput3"]);

            }else if (isset($_FILES["fileInput4"]) && $_FILES["fileInput4"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput4"]["tmp_name"];
                $_SESSION['car']['uploadImage4'] = $_FILES["fileInput4"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput4"]["name"]);
                unset($_FILES["fileInput4"]);

            }else if (isset($_FILES["fileInput5"]) && $_FILES["fileInput5"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput5"]["tmp_name"];
                $_SESSION['car']['uploadImage5'] = $_FILES["fileInput5"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput5"]["name"]);
                unset($_FILES["fileInput5"]);

            }else{

                echo "<script>alert('Aucune image n'a été sélectionnée ou une erreur s'est produite.');</script>";
                
            }

            if(move_uploaded_file($sourceFile, $destinationFile)){

                echo "<script>alert('L\'image a été uploadée avec succès.');</script>";

            }else{

                echo "<script>alert('Désolé, une erreur s'est produite lors de l'upload de l'image.');</script>";
            
            }

            $changeImage = true;
        }

    }else{
        $_SESSION['other']['errorForm'] = true;
        $_SESSION['other']['errorFormMessage'] = "Erreur de vérification CSRF";
        $cars['message'] = "Erreur de vérification CSRF";
    }
/*
    $MyBrand = myBrand();
    $MyModel = myModel();
    $MyMotorization = myMotorization();
*/
    
    //Fonction traitement de la BD pour récupérer les données destinées à l'input liste brand
    function myBrand():array{
        
        $Brand = new Brand();
        $myBrand = array();

        $myBrand = $Brand->getBrandList(1,'name', 'ASC', 0, 50);
        unset($Brand);

        return $myBrand;
    }
    //Fonction traitement de la BD pour récupérer les données destinées à l'input liste model
    function myModel():array{
        
        $Model = new Model();
        $myModel = array();

        $myModel = $Model->getModelList(1,'name', 'ASC', 0, 50);
        unset($Model);

        return $myModel;
    }
    //Fonction traitement de la BD pour récupérer les données destinées à l'input liste motorization
    function myMotorization():array{
        
        $Motorization = new Motorization();
        $myMotorization = array();

        $myMotorization = $Motorization->getMotorizationList(1,'name', 'ASC', 0, 50);
        unset($Motorization);

        return $myMotorization;
    }
    
    //Fonction d'initialisation du tableau des données de l'utilisateur
    function initTabCar(array $cars, object $MyCar, object $MyCarForm):array{        
        
        $cars['Id'] = $MyCar->getId();
        $cars['brand'] = $MyCar->getBrand();
        $cars['model'] = $MyCar->getModel();
        $cars['motorization'] = $MyCar->getMotorization();
        $cars['year'] = $MyCar->getYear();
        $cars['mileage'] = $MyCar->getMileage();
        $cars['price'] = $MyCar->getPrice();
        $cars['sold'] = $MyCar->getSold();
        $cars['description'] = $MyCar->getDescription();
        $cars['image1'] = $MyCar->getImage1();
        $cars['image2'] = $MyCar->getImage2();
        $cars['image3'] = $MyCar->getImage3();
        $cars['image4'] = $MyCar->getImage4();
        $cars['image5'] = $MyCar->getImage5();

        return $cars;
    }

    //Fonction de réinitialisation des variables de l'utilisateur
    function resetCarVar(object $MyCar, object $MyCarForm):void{
        
        $MyCar->setId(0);
        $MyCar->setBrand('_');
        $MyCar->setModel('_');
        $MyCar->setMotorization('_');
        $MyCar->setYear(2000);
        $MyCar->setMileage(0);
        $MyCar->setPrice(0);
        $MyCar->setSold('Yes');
        $MyCar->setDescription('_');
        $MyCar->setImage1('_.webp');
        $MyCar->setImage2('_.webp');
        $MyCar->setImage3('_.webp');
        $MyCar->setImage4('_.webp');
        $MyCar->setImage5('_.webp');
    }

?>