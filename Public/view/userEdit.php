<?php include_once('../../controller/userEdit.controller.php'); ?>

<section class="container">
    
    <div id="sessionValue" data-local="<?php echo isset($_SESSION['local']) ? $_SESSION['local'] : ''; ?>"></div>

    <form method="post" id="formUserEdit" enctype="multipart/form-data">
                
        <table class="w-100">
            
            <!-- input hidden csrf -->
            <tr style="display: none;">
                <td colspan="2">
                    <input type="hidden" name="csrfUSer" value="<?php echo $_SESSION['csrfUSer'];?>">
                </td>
            </tr>

            <tr class="m-0 p-0">
                <td class="">
                </td>

                <td class="py-5">

                    <div class="d-flex flex-column flex-sm-row">

                        <div class="me-2">

                        <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
                            <button class="btn btn-lg btn-warning fs-4 mb-2 mb-md-0" type="submit" name="bt_userEdit_cancel" style="width: 100px;" onclick="retour();">Retour</button>
                        <?php } ?>
                        
                            <input class="btn btn-lg btn-success fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_save" id="bt_userEdit_save" style="width: 100px;" value="Enregistrer">
                        
                        </div>

                    <?php if($_SESSION['typeConnect'] != 'Administrator' && $_SESSION['typeConnect'] != 'Guest'){ ?>
                        <div>

                            <button class="btn btn-lg btn-danger fs-4 mb-2 mb-md-0" type="submit" name="bt_userEdit_delete">Supprimer mon compte</button>
                        
                        </div>
                    <?php } ?>

                    <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
                        <div>

                            <input class="btn btn-lg btn-info fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_new" id="bt_userEdit_new" style="width: 100px;" value="Nouveau">
                            <button class="btn btn-lg btn-danger fs-4 mb-2 mb-md-0" type="submit" name="bt_userEdit_delete"style="width: 100px;">Supprimer</button>
                        
                        </div>
                    <?php } ?>

                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="text-center text-black bg-warning px-5 rounded-5" name="message1" id="message1"><?php if(!empty($users[0]['message'])){echo $users[0]['message'];} ?></div>
                </td>
            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_id">ID</label>
                </td>

                <td class="m-0 p-0">
                    <input class="form-control-lg m-0 p-0 ps-3 bg-dark text-light" id="txt_userEdit_id" name="txt_userEdit_id" type="text" readonly style="font-size: 1.6rem;"
                        value=
                        "<?php
                            if(!empty($MyUser->getId())){
                                echo $MyUser->getId();
                            }else{
                                echo escapeInput($users[0]['id_user']);
                            }
                        ?>"
                    >
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0">
                        Numéro d'identifiant. Ce numèro est incrémenté automatiquement par la robot.
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="list_userEdit_subscription">Formule<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input list="datalist_userEdit_subscription" name="list_userEdit_subscription" id="list_userEdit_subscription" class="form-control-lg m-0 p-0 ps-3 border border-black fs-4" placeholder="Selectionnez une formule" oninput="validateInput('list_userEdit_subscription','datalist_userEdit_subscription','labelMessageSubscription','Selectionnez votre formule dans la liste de choix.')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['subscription']);
                        ?>"
                    >
                    <datalist id="datalist_userEdit_subscription">
                        <?php
                            for($i=0;$i != count($MySubscription)-1;$i++) { ?>
                            <option value="<?php echo $MySubscription[$i]['subscription']; ?>">
                        <?php } ?>
                    </datalist>
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageSubscription" name="labelMessageSubscription">
                        Selectionnez votre formule dans la liste de choix, ou supprimer le contenu pour changer de formule.
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_name">Nom<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0" readonly>
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black" id="txt_userEdit_name" name="txt_userEdit_name" type="text" placeholder="Saisissez votre NOM" style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_name','','labelMessageName','Saisissez votre Nom d\'une longueur de 50 caractères maximum.')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['name']);
                        ?>"
                    >
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageName">
                        Saisissez le Nom (entre 1 et 50 caractères maximum).
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_surname">Prénom<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black" id="txt_userEdit_surname" name="txt_userEdit_surname" type="text" placeholder="Saisissez votre Prénom" style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_surname','','labelMessageSurname','Saisissez votre Prénom d\'une longueur de 50 caractères maximum.')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['surname']);
                        ?>"
                    >
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageSurname">
                        Saisissez le Prénom (entre 1 et 50 caractères maximum).
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_pseudo">Pseudo<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black <?php echo ($_SESSION['typeConnect'] === 'Member' || $_SESSION['typeConnect'] === 'User') ? 'bg-dark text-light' : ''; ?>" id="txt_userEdit_pseudo" name="txt_userEdit_pseudo" type="text" placeholder="Saisissez votre Pseudo" <?php echo ($_SESSION['typeConnect'] === 'Member' || $_SESSION['typeConnect'] === 'User') ? 'readonly' : ''; ?> style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_pseudo')"
                    value=
                        "<?php
                            echo escapeInput($users[0]['pseudo']);
                        ?>"
                    >
                </td>

            </tr>

            <tr>
                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessagePseudo" name="labelMessagePseudo">
                        Saisissez le pseudonyme (entre 4 et 20 caractères maximum. Aucun caratères spéciaux sauf # et _).
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3 " for="txt_userEdit_email">Email<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black <?php echo ($_SESSION['typeConnect'] === 'Member' || $_SESSION['typeConnect'] === 'User') ? 'bg-dark text-light' : ''; ?>" id="txt_userEdit_email" name="txt_userEdit_email" type="email" placeholder="Saisissez votre courriel" <?php echo ($_SESSION['typeConnect'] === 'Member' || $_SESSION['typeConnect'] === 'User') ? 'readonly' : ''; ?> style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_email','','labelMessageEmail','Saisissez votre adresse de courriel d\'une longueur maximum de 255 caractères.')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['email']);
                        ?>"
                    > 
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageEmail" name="labelMessageEmail">
                        Saisissez l'adresse email (entre 6 et 255 caractères maximum).
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_phone">Phone<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black" id="txt_userEdit_phone" name="txt_userEdit_phone" type="tel" placeholder="## ## ## ## ##" style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_phone','','labelMessagePhone','Saisissez votre N° de téléphone.')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['phone']);
                        ?>"
                    >
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessagePhone" name="labelMessagePhone">
                        Saisissez le N° de téléphone (entre 6 et 18 caractères maximum).
                    </label>
                </td>

            </tr>

    <?php if($_SESSION['typeConnect'] ==='Administrator'){ ?>
            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="list_userEdit_type">Utilisateur<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input list="datalist_userEdit_type" name="list_userEdit_type" id="list_userEdit_type" class="form-control-lg m-0 p-0 ps-3 border border-black fs-4" placeholder="Selectionnez un type" oninput="validateInput('list_userEdit_type','datalist_userEdit_type','labelMessageType','Selectionnez le type d\'utilisateur dans la liste de choix.')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['type']);
                        ?>"
                    >
                    <datalist id="datalist_userEdit_type">
                        <?php
                            for($i=0;$i != count($MyType);$i++) { ?>
                            <option value="<?php echo $MyType[$i]['type']; ?>">
                        <?php } ?>
                    </datalist>
                </td>

            </tr>

            <tr>
                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageType" name="labelMessageType">
                        Selectionnez le type d'utilisateur dans la liste de choix.
                    </label>
                </td>

            </tr>

    <?php } ?>
            <tr class="m-0 p-0">

                <div class="container">  

                    <div class="row">

                        <td class="col-1 text-end">
                            <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_avatar">Avatar<span style="color:red;">*</span></label>
                        </td>

                        <td class="col-11"> 
                            <div class="container m-0 p-0">

                                <div class="row">

                                    <div class="col-12 col-lg-3 pb-3 pb-lg-0">

                                        <input class="form-control-lg bg-dark text-light border border-black m-0 p-0 " id="txt_userEdit_avatar" name="txt_userEdit_avatar" type="text" placeholder="Saisissez le nom de l'avatar" readonly style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_avatar','','labelMessageavatar','Saisissez le nom de l\'avatar (sans useractères spéciaux sauf - et _) aux formats *.png ou *.jpg ou *.webp. Sinon, téléchargez une avatar depuis votre disque local. ATTENTION!!! Dimmentions avatar au ratio de 70px sur 70px.')"
                                            value=
                                            "<?php
                                                echo escapeInput($users[0]['avatar']);
                                            ?>"
                                        >
                                    </div>

                                    <div class="col-12 col-lg-5 d-flex align-items-center pb-3 pb-lg-0">
                                        <input class="fs-4" type="file" name="fileAvatar" id="fileAvatar" accept="image/jpeg, image/png, image/webp" directory="./img/avatar/">
                                    </div>

                                    <div class="col-12 col-lg-4 d-flex align-items-center pb-3 pb-lg-0">
                                        <input class="btn btn-lg btn-primary fs-4" type="submit" name="btn_avatar" id="btn_avatar" value="Télécharger">
                                    </div>

                                </div>  

                            </div>

                        </td>

                    </div>

                </div>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageavatar">
                        Saisissez le nom de l'avatar (sans caractères spéciaux sauf - et _) aux formats png, jpg et webp. Sinon, téléchargez une avatar depuis votre disque local.
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_password">Mot de passe<span style="color:red;">*</span></label>
                </td>

                <td class="m-0 p-0">
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black" id="txt_userEdit_password" name="txt_userEdit_password" type="password" placeholder="" style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_password')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['password']);
                        ?>"
                    >
                </td>

            </tr>

            <tr>

                <td class="m-0 p-0">
                </td>

                <td class="m-0 p-0">
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessagePassword"  name="labelMessagePassword">
                        Saisissez un mot de passe de 255 caractères maximum et 8 caractères minimun comprenant au moins : 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spéciale parmi les suivants /*-.!?@
                    </label>
                </td>

            </tr>

            <tr class="m-0 p-0">

                <td class="text-end m-0 p-0">
                    <label class="form-label m-0 p-0 pe-3" for="txt_userEdit_confirm">
                        Confirmation<span style="color:red;">*</span>
                    </label>
                </td>

                <td class="m-0 p-0 w-90">
                    <input class="form-control-lg m-0 p-0 ps-3 border border-black" id="txt_userEdit_confirm" name="txt_userEdit_confirm" type="password" placeholder="" style="font-size: 1.6rem;" oninput="validateInput('txt_userEdit_confirm')"
                        value=
                        "<?php
                            echo escapeInput($users[0]['password']);
                        ?>"
                    >
                </td>

            </tr>

            <tr>

                <td>
                </td>

                <td>
                    <label class="form-control-lg m-0 mb-2 p-0" id="labelMessageConfirm" name="labelMessageConfirm">
                        Confirmez le mot de passe.
                    </label>
                </td>

            </tr>

            <tr>
                <td>
                </td>

                <td class="pb-5">
                    <div class="d-flex flex-column flex-sm-row">

                        <div class="me-2">

                        <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
                            <button class="btn btn-lg btn-warning fs-4 mb-2 mb-md-0" type="submit" name="bt_userEdit_cancel" style="width: 100px;" onclick="retour();">Retour</button>
                        <?php } ?>
                        
                            <input class="btn btn-lg btn-success fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_save" id="bt_userEdit_save_1" style="width: 100px;" value="Enregistrer">
                        
                        </div>

                    <?php if($_SESSION['typeConnect'] != 'Administrator' && $_SESSION['typeConnect'] != 'Guest'){ ?>
                        <div>

                            <button class="btn btn-lg btn-danger fs-4 mb-2 mb-md-0" type="submit" name="bt_userEdit_delete">Supprimer mon compte</button>
                        
                        </div>
                    <?php } ?>

                    <?php if($_SESSION['typeConnect'] === 'Administrator'){ ?>
                        <div>

                            <input class="btn btn-lg btn-info fs-4 mb-2 mb-md-0" type="button" name="bt_userEdit_new" id="bt_userEdit_new_1" style="width: 100px;" value="Nouveau">
                            <button class="btn btn-lg btn-danger fs-4 mb-2 mb-md-0" type="submit" name="bt_userEdit_delete"style="width: 100px;">Supprimer</button>
                        
                        </div>
                    <?php } ?>

                    </div>
                </td>

            </tr>

            <tr>
                <td colspan="2">
                    <div class="text-center text-black bg-warning px-5 rounded-5" name="message2" id="message2"><?php if(!empty($users[0]['message'])){echo $users[0]['message'];} ?></div>
                </td>
            </tr>

        </table>

    </form>

</section>

<?php $_SESSION['message'] =''; ?>

<script src="js/function.js"></script>
<script src="js/fetch.js"></script>
<script src="js/user_edit.js"></script>

