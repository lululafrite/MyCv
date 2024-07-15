let pageTitle = document.title;
let pageIcon = document.getElementById("pageIcon");

if (window.location.href.includes("mycv/index.php?page=home")) {

    pageTitle = "Ludovic FOLLACO - Accueil";
    pageIcon = pageIcon.href = "img/icon/white_house.svg";

}else if(window.location.href.includes("mycv/index.php?page=mycv")) {

    pageTitle = "Ludovic FOLLACO - Mon CV";
    pageIcon = pageIcon.href = "img/icon/white_calendar2-event.svg";

}else if(window.location.href.includes("mycv/index.php?page=connexion")) {

    pageTitle = "Ludovic FOLLACO - Connexion";
    pageIcon = pageIcon.href = "img/icon/white_person.svg";

}

document.getElementById("pageTitle").innerText = pageTitle;