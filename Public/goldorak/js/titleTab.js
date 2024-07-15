let pageTitle = document.title;

if (window.location.href.includes("home")){

    pageTitle = "Club Goldorak - Accueil";

}else if (window.location.href.includes("userEdit")){

    pageTitle = "Club Goldorak - Editer utilisateurs";

}else if (window.location.href.includes("user")){

    pageTitle = "Club Goldorak - Utilisateurs";

}else if (window.location.href.includes("product")){

    pageTitle = "Club Goldorak - Produits";

}else if (window.location.href.includes("productEdit")){

    pageTitle = "Club Goldorak - Editer les produits";

}else if (window.location.href.includes("events")){

    pageTitle = "Club Goldorak - Evénements";

}else if (window.location.href.includes("media")){

    pageTitle = "Club Goldorak - Médias";

}else if (window.location.href.includes("goldorakgo")){

    pageTitle = "Club Goldorak - Goldorak Go!";

}else if (window.location.href.includes("commander")){

    pageTitle = "Club Goldorak - My Commander!";

}else if (window.location.href.includes("connexion")){

    pageTitle = "Club Goldorak - Connexion";

}else if (window.location.href.includes("disconnect")){

    pageTitle = "Club Goldorak - Déconnexion";

}else if (window.location.href.includes("errorPage")){

    pageTitle = "Club Goldorak - Page inaccessible";

}else if (window.location.href.includes("UnknownPage")){

    pageTitle = "Club Goldorak - Page inéxistante";

} 

document.getElementById("pageTitle").innerText = pageTitle;