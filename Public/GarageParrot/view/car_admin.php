<?php
    include_once('../../common/utilies.php');
    include_once('../../garageparrot/controller/car.controller.php');
    include_once('../../garageparrot/module/searchCarAdmin.php');
    include_once('../../module/select_page.php');
?>

<section class="m-5 d-flex flex-wrap justify-content-center">

<?php for($i=0; $i < count($Cars);$i++) { ?>

<article class="mb-5 p-3 border rounded-4">
    
    <form action="/index.php?page=car_edit" method="post">

    <!-- input hidden csrf -->
    <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">
        
        <div class="d-flex justify-content-center div__Car--img">

            <a
                href="../img/vehicle/<?php echo escapeInput($Cars[$i]['image1']); ?>"
                class="popup-gallery"
                data-fancybox="car-gallery-<?php echo $i; ?>"
            >
                <img
                    src="../img/vehicle/<?php echo $Cars[$i]['image1']; ?>"
                    alt="Image du véhicule"
                    style="width:350px;"
                >
            </a>

            <a
                href="../img/vehicle/<?php echo escapeInput($Cars[$i]['image2']); ?>"
                class="popup-gallery"
                data-fancybox="car-gallery-<?php echo $i; ?>"
            ></a>

            <a
                href="../img/vehicle/<?php echo escapeInput($Cars[$i]['image3']); ?>"
                class="popup-gallery"
                data-fancybox="car-gallery-<?php echo $i; ?>"
            ></a>

            <a
                href="../img/vehicle/<?php echo escapeInput($Cars[$i]['image4']); ?>"
                class="popup-gallery"
                data-fancybox="car-gallery-<?php echo $i; ?>"
            ></a>

            <a
                href="../img/vehicle/<?php echo escapeInput($Cars[$i]['image5']); ?>"
                class="popup-gallery"
                data-fancybox="car-gallery-<?php echo $i; ?>"
            ></a>

        </div>

        <div class="div__Car--data">

            <table class='table__Car--data'>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">ID:</td>

                    <td class="tdText border border-0">
                        <input
                            type="text"
                            id='txt_carEdit_id'
                            name='txt_carEdit_id'
                            class="bgDark text-light text-start ps-2"
                            readonly
                            value='<?php echo escapeInput($Cars[$i]['id_car']);?>'
                        >
                    </td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Marque:</td>

                    <td class="tdText border border-0">
                        <input
                            type="text"
                            name="txt__Car--Brand"
                            class="bg-secondary text-light text-start ps-2"
                            readonly
                            value='<?php echo escapeInput($Cars[$i]['brand']);?>'
                        >
                    </td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Modèle:</td>

                    <td class="tdText border border-0">
                        <input
                            type="text"
                            name="txt__Car--Model"
                            class="bg-secondary text-light text-start ps-2"
                            readonly
                            value='<?php echo escapeInput($Cars[$i]['model']);?>'
                        >
                    </td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Moteur:</td>
                    <td class="tdText border border-0"><input type="text" name="txt__Car--Motorization" class="bg-secondary text-light text-start ps-2" readonly value='<?php echo escapeInput($Cars[$i]['motorization']);?>'></td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Année:</td>
                    <td class="tdText border border-0"><input type="text" name="txt__Car--year" class="bg-secondary text-light text-start ps-2" readonly value='<?php echo escapeInput($Cars[$i]['year']);?>'></td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Kilomètrage:</td>
                    <td class="tdText border border-0"><input type="text" name="txt__Car--mileage" class="bg-secondary text-light text-start ps-2" readonly value='<?php echo escapeInput($Cars[$i]['mileage']);?> kms'></td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Prix:</td>
                    <td class="tdText border border-0"><input type="text" name="txt__Car--price" class="bg-secondary text-light text-start ps-2" readonly value='<?php echo escapeInput($Cars[$i]['price']);?> € TTC'></td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Disponible:</td>
                    <td class="tdText border border-0"><input type="text" name="txt__Car--sold" class="bg-secondary text-light text-start ps-2" readonly value='<?php echo escapeInput($Cars[$i]['sold']);?>'></td>

                </tr>

                <tr>

                    <td class="tdLabel text-end border border-0 pe-1">Description:</td>
                    <td class="tdText border border-0"><textarea class="bg-secondary text-light text-start ps-2" id="txt__Car--description" name="txt__Car--description" rows="3" placeholder="Options et description" readonly><?php echo escapeInput($Cars[$i]['description']);?></textarea></td>

                </tr>

            </table>

        </div>

        <?php
        if($_SESSION['typeConnect'] != 'Guest'){

        ?>

            <div class="d-flex justify-content-center my-2">

                <button type="submit" class='btn btn-primary fs-3 mt-3' name='bt__Car--edit'>Editer</button>

            </div>

        <?php
        }
        ?>

    </form>

        <?php
        if($_SESSION['typeConnect'] === 'Guest'){

        ?>

            <div class="d-flex justify-content-center my-2">

                <button type="button" class="btn btn-lg btn-primary" id="bt_car_contact" onclick="focusOnInput()">Nous contacter</button>

            </div>

        <?php
        }
        ?>

</article>

<?php } ?>

</section>

<?php include('../../module/select_page.php');?>

<script>

    function focusOnInput(){

        document.getElementById('contact_description').value = "Bonjour, je souhaite prendre rendez-vous pour une présentation détaillé et un essai du véhicule xxxxxxxx ";
        document.getElementById('contact_name').focus();
        document.getElementById('bottom').scrollIntoView({ behavior: 'smooth' });
        
    }

</script>