    <link rel="stylesheet" type="text/css" href="../css/reset.css">

    <!-- ----------------------- LIBRARY JQUERY AND BOOTSTRAP ---------------------- -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"> -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- ------------------------------- STYLE SHEETS ------------------------------- -->
    <link rel="stylesheet" type="text/css" href="../css/rating_comment.css">
    
    <?php
        
        $current_url = $_SERVER['REQUEST_URI'];
        $goldorak = '/goldorak/';
        $garageParrot = '/garageparrot/';
    ?>

    <?php
        if(preg_match($goldorak, $current_url)){
    ?>
            <link rel='stylesheet' type='text/css' href='../css/goldorak_style.css'>
            <link rel='stylesheet' type='text/css' href='../css/goldorak_commander.css'>
    <?php
        }else if(preg_match($garageParrot, $current_url)){
    ?>
            <link rel='stylesheet' type='text/css' href='../css/style_navbar.css'>
            <link rel='stylesheet' type='text/css' href='../css/garage_parrot_style.css'>
    <?php
        }else{
    ?>
            <link rel="stylesheet" type="text/css" href="../css/style_navbar.css">
            <link rel="stylesheet" type="text/css" href="../css/myCv_style.css">
    <?php
        }
    ?>