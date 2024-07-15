var pageTitle = document.title;

if (window.location.href.includes("home")) {
    pageTitle = "Garage V.PARROT - Accueil";
} else if (window.location.href.includes("user")) {
    pageTitle = "Garage V.PARROT - contacts";
} else if (window.location.href.includes("user_edit")) {
    pageTitle = "Garage V.PARROT - Editer Contact";
} else if (window.location.href.includes("car")) {
    pageTitle = "Garage V.PARROT - Nos occasions";
} else if (window.location.href.includes("car_edit")) {
    pageTitle = "Garage V.PARROT - Editer occasion";
} else if (window.location.href.includes("contact_us")) {
    pageTitle = "Garage V.PARROT - Nous contacter";
} else if (window.location.href.includes("connexion")) {
    pageTitle = "Garage V.PARROT - connexion";
} else if (window.location.href.includes("disconnect")) {
    pageTitle = "Garage V.PARROT - Déconnexion";
} else if (window.location.href.includes("error_page")) {
    pageTitle = "Garage V.PARROT - Page inaccessible";
} else if (window.location.href.includes("error_unknown_page")) {
    pageTitle = "Garage V.PARROT - Page inéxistante";
} 

document.getElementById("pageTitle").innerText = pageTitle;