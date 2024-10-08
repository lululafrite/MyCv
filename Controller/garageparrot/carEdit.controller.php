<?php

    require_once('../model/garageparrot/car.class.php');
    require_once('../model/garageparrot/brand.class.php');
    require_once('../model/garageparrot/model.class.php');
    require_once('../model/garageparrot/motorization.class.php');
    require_once('../model/garageparrot/carForm.class.php');
    require_once('../model/common/utilities.class.php');

    use Model\Car\Car;
    use Model\Car\Brand;
    use Model\Car\Model;
    use Model\Car\Motorization;
    use Model\Car\CarForm;
    use Model\Utilities\Utilities;
    
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
        
        $MyCarForm->setBtnCarEdit(isset($_POST['btn_carEdit']) ? true : false); //Button in the table to edit a car (car.php)
            
        $MyCarForm->setBtnNavBarInsert(isset($_POST['btn_navBar_new']) ? true : false); //Button in the navigation bar to insert a new car
        
        $MyCarForm->setBtnInsert(isset($_POST['btn_carEdit_new']) ? true : false); //Button in the form to car (carEdit.php)
        $MyCarForm->setBtnDelete(isset($_POST['btn_carEdit_delete']) ? true : false); //Button in the form to car (carEdit.php)
        $MyCarForm->setBtnCancel(isset($_POST['btn_carEdit_cancel']) ? true : false); //Button in the form to car (carEdit.php)

        $MyCarForm->setBtnUpdate(isset($_POST['btn_carEdit_save']) ? true : false); //Button in the form to car (carEdit.php)
        $MyCarForm->setBtnUpdate1(isset($_POST['btn_carEdit_save_1']) ? true : false); //Button in the form to car (carEdit.php)
        $btnUpdate = $MyCarForm->getBtnUpdate1() ? true : $MyCarForm->getBtnUpdate();
        
        $MyCarForm->setBtnImage1(isset($_POST['btn_image1']) ? true : false); //Button in the form to suscribe a new car (adherer.php)
        $MyCarForm->setBtnImage2(isset($_POST['btn_image2']) ? true : false); //Button in the form to suscribe a new car (adherer.php)
        $MyCarForm->setBtnImage3(isset($_POST['btn_image3']) ? true : false); //Button in the form to suscribe a new car (adherer.php)
        $MyCarForm->setBtnImage4(isset($_POST['btn_image4']) ? true : false); //Button in the form to suscribe a new car (adherer.php)
        $MyCarForm->setBtnImage5(isset($_POST['btn_image5']) ? true : false); //Button in the form to suscribe a new car (adherer.php)

        $MyCarForm->setNewError(isset($_GET['newError']) ? Utilities::filterInput('newError', INPUT_GET) : false);

        $MyCar->setId(isset($_POST["txt_car_id"]) ? Utilities::filterInput("txt_car_id") : 0);
        $MyCar->setBrand(isset($_POST["list_carEdit_brand"]) ? Utilities::filterInput("list_carEdit_brand") : '');
        $MyCar->setModel(isset($_POST["list_carEdit_model"]) ? Utilities::filterInput("list_carEdit_model") : '');
        $MyCar->setMotorization(isset($_POST["list_carEdit_motorization"]) ? Utilities::filterInput("list_carEdit_motorization") : '');
        $MyCar->setYear(isset($_POST["txt_carEdit_year"]) ? Utilities::filterInput("txt_carEdit_year") : 2000);
        
        $mileage = isset($_POST['txt_carEdit_mileage']) ? Utilities::filterInput('txt_carEdit_mileage') : '0 kms';
        $mileage = str_replace(" kms", "", $mileage);
        $MyCar->setMileage(intval($mileage));

        $price = isset($_POST["txt_carEdit_price"]) ? Utilities::filterInput("txt_carEdit_price") : '0 € TTC';
        $price = str_replace(" € TTC", "", $price);
        $MyCar->setPrice(intval($price));

        $MyCar->setSold(isset($_POST["list_carEdit_sold"]) ? Utilities::filterInput("list_carEdit_sold") : 'Oui');
        $MyCar->setDescription(isset($_POST["txt_carEdit_description"]) ? Utilities::filterInput("txt_carEdit_description") : '');
        
        $MyCar->setImage1(isset($_POST["txt_carEdit_image1"]) ? Utilities::filterInput("txt_carEdit_image1") : '_.webp');
        $MyCar->setImage2(isset($_POST["txt_carEdit_image2"]) ? Utilities::filterInput("txt_carEdit_image2") : '_.webp');
        $MyCar->setImage3(isset($_POST["txt_carEdit_image3"]) ? Utilities::filterInput("txt_carEdit_image3") : '_.webp');
        $MyCar->setImage4(isset($_POST["txt_carEdit_image4"]) ? Utilities::filterInput("txt_carEdit_image4") : '_.webp');
        $MyCar->setImage5(isset($_POST["txt_carEdit_image5"]) ? Utilities::filterInput("txt_carEdit_image5") : '_.webp');

        $btnImage = $MyCarForm->getBtnImage1() || $MyCarForm->getBtnImage2() || $MyCarForm->getBtnImage3() || $MyCarForm->getBtnImage4() || $MyCarForm->getBtnImage5();
    }

    //***********************************************************************************************
    // CRUD
    //***********************************************************************************************
    
    if($MyCarForm->getBtnCarEdit()){

        $cars = $MyCar->getCurrentCar($MyCar->getId());
        $cars['message'] = $_SESSION['other']['message'];

        $MyBrand = myBrand();
        $MyModel = myModel();
        $MyMotorization = myMotorization();

        return;

    }
    
    if(Utilities::ckeckCsrf()){

        if($btnUpdate){

            if($MyCar->getId() === 0){
                    
                $MyCar->setId($MyCar->insertCar());
                $cars = initTabcar($cars, $MyCar, $MyCarForm);

                return;

            }else{

                $updateCar = $MyCar->updateCar($MyCar->getId());
                $cars = initTabcar($cars, $MyCar, $MyCarForm);

                $cars['message'] = $_SESSION['other']['message'];
                
                $MyBrand = myBrand();
                $MyModel = myModel();
                $MyMotorization = myMotorization();

                return;
            }

        }elseif($MyCarForm->getBtnInsert() || $MyCarForm->getBtnNavBarInsert()){
            
            resetCarVar($MyCar, $MyCarForm);
            $cars = initTabCar($cars, $MyCar, $MyCarForm);

            $MyBrand = myBrand();
            $MyModel = myModel();
            $MyMotorization = myMotorization();

            return;

        }elseif($MyCarForm->getBtnDelete()){
                
            $deleteCar = $MyCar->deleteCar($MyCar->getId());
            Utilities::redirectToPage('car');

        }elseif($MyCarForm->getBtnCancel()){
        
            Utilities::redirectToPage('car');
    
        }elseif($btnImage){
            
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
                
                $MyCar->setImage1($_SESSION['car']['uploadImage1']);

            }elseif (isset($_FILES["fileInput2"]) && $_FILES["fileInput2"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput2"]["tmp_name"];
                $_SESSION['car']['uploadImage2'] = $_FILES["fileInput2"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput2"]["name"]);
                unset($_FILES["fileInput2"]);
                
                $MyCar->setImage2($_SESSION['car']['uploadImage2']);

            }elseif (isset($_FILES["fileInput3"]) && $_FILES["fileInput3"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput3"]["tmp_name"];
                $_SESSION['car']['uploadImage3'] = $_FILES["fileInput3"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput3"]["name"]);
                unset($_FILES["fileInput3"]);
                
                $MyCar->setImage3($_SESSION['car']['uploadImage3']);

            }elseif (isset($_FILES["fileInput4"]) && $_FILES["fileInput4"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput4"]["tmp_name"];
                $_SESSION['car']['uploadImage4'] = $_FILES["fileInput4"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput4"]["name"]);
                unset($_FILES["fileInput4"]);
                
                $MyCar->setImage4($_SESSION['car']['uploadImage4']);

            }elseif (isset($_FILES["fileInput5"]) && $_FILES["fileInput5"]["error"] == UPLOAD_ERR_OK){

                $sourceFile = $_FILES["fileInput5"]["tmp_name"];
                $_SESSION['car']['uploadImage5'] = $_FILES["fileInput5"]["name"];
                $destinationFile = $uploadDirectory . basename($_FILES["fileInput5"]["name"]);
                unset($_FILES["fileInput5"]);
                
                $MyCar->setImage5($_SESSION['car']['uploadImage5']);

            }else{

                echo "<script>alert('Aucune image n'a été sélectionnée ou une erreur s'est produite.');</script>";
                
            }

            if(move_uploaded_file($sourceFile, $destinationFile)){

                echo "<script>alert('L\'image a été uploadée avec succès.');</script>";

            }else{

                echo "<script>alert('Désolé, une erreur s'est produite lors de l'upload de l'image.');</script>";
            
            }

            $cars = initTabCar($cars, $MyCar, $MyCarForm);
            $changeImage = true;
        }

    }else{
        $_SESSION['other']['errorForm'] = true;
        $_SESSION['other']['errorFormMessage'] = "Erreur de vérification CSRF";
        $cars['message'] = "Erreur de vérification CSRF";
    }
    
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
        
        $cars['id_car'] = $MyCar->getId();
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