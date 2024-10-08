    <link rel="stylesheet" type="text/css" href="../css/common/reset.css">

    <!-- ------------------------------- LIBRARY CSS -------------------------------- -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- ------------------------------- STYLE SHEETS ------------------------------- -->
    <link rel="stylesheet" type="text/css" href="../css/common/rating_comment.css">
    
    <?php
        
        $current_url = $_SERVER['REQUEST_URI'];
        $goldorak = '/goldorak/';
        $garageParrot = '/garageparrot/';
        $dragAndDrop = '/draganddrop/';
    ?>

    <?php
        if(preg_match($goldorak, $current_url)){
    ?>
            <link rel='stylesheet' type='text/css' href='../css/goldorak/style_navbar.css'>
            <link rel='stylesheet' type='text/css' href='../css/goldorak/goldorak_style.css'>
            <link rel='stylesheet' type='text/css' href='../css/goldorak/goldorak_commander.css'>
    <?php
        }elseif(preg_match($garageParrot, $current_url)){
    ?>
            <link rel='stylesheet' type='text/css' href='../css/garageparrot/style_navbar.css'>
            <link rel='stylesheet' type='text/css' href='../css/garageparrot/garage_parrot_style.css'>
    <?php
        }else{
    ?>
            <link rel="stylesheet" type="text/css" href="../css/mycv/style_navbar.css">
            <link rel="stylesheet" type="text/css" href="../css/mycv/myCv_style.css">
    <?php
        }
    ?>