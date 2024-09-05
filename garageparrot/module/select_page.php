<section class="d-flex flex-column flex-sm-row justify-content-center align-items-center p-3 mx-md-5 mx-2  bgDark border border-secondary border-3 rounded-4">

    <form class="d-flex align-items-center" id="form__nbOfLine" method="post" action=<?php $pageActive ?>>

        <!-- input hidden csrf -->
        <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

        <label class="form-label text-light me-3" for="nbOfLine">Réf.<span style="color:#343a40">_</span>par<span style="color:#343a40">_</span>page<span style="color:#343a40">_</span>:</label>

        <select class="form-select me-0 me-md-3" id="nbOfLine" name="nbOfLine" onchange="this.form.submit()" style="font-size: 1.6rem;">

            <option value="<?php
                if(isset($_POST['nbOfLine']) && !isset($_POST['nbOfLine'])){
                    $value = $_POST['nbOfLine'];
                    $_SESSION['ligneParPage'] = $_POST['nbOfLine'];
                }else{
                    $value = $_SESSION['ligneParPage'];
                }
                echo $value ;
            ?>">
                <?php echo $value; ?>
            </option>
            <option value="1">1</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </form>

    <form class="d-flex mt-3 mt-sm-0" method="post">
        
        <!-- input hidden csrf -->
        <input type="hidden" name="tokenCsrf" value="<?php echo $_SESSION['tokenCsrf'];?>">

        <input class="BtPage rounded-2" type="submit" name="previous" value="<"/>
        <label class="labelPage text-light text-end ps-3"><?php echo $laPage; ?></label>
        <label class="labelPage text-light pe-3">&nbsp/&nbsp<?php echo $nbOfPage;?>&nbsp</label>
        <input class="BtPage rounded-2" type="submit" name="next" value=">"/>
    </form>

    <div class="d-flex justify-content-center align-items-center p-0 m-0 ps-md-3 mt-3 mt-md-0">
        <label class="text-light text-center text-end p-0 m-0">Total réf. <?php echo $_SESSION['nbOfProduct']; ?></label> 
    </div>
    
</section>
