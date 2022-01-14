let niveauM = ["-------------------", "EUF", "L1", "L2", "L3", "L4", "L5", "L6"],
    niveauG = ["-------------------", "EUF", "L1", "L2", "L3", "L4"],
    niv = ["-------------------", "EUF", "L1", "L2", "L3"];
let nivFiliere = {
    "-------------------": ['-------------------'],
    "Medecine": niveauM,
    "Agronomie": niveauG,
    "Génie": niveauG,
    "Informatique": niv,
    "Education bio": niv,
    "Education chimie": niv,
    "Education Math-phy": niv,
    "Sociologie": niv,
    "Psychologie": niv,
    "Beaux-arts": niv,
    "Environnement": niv,
    "Travail social": niv,
    "Psycho-éducation": niv,
    "Amménagement": niv,
    "Science politique": niv
}
const activePage = window.location.pathname;
let links = document.querySelectorAll('ul li a');
if (links !== null) {
    let tab = activePage.split('/');
    links.forEach(link => {
        if (link.href.includes(`${tab[1]}`)) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    })
}

let filiere = document.querySelector('#filiere');
if (filiere !== null) {
    let niveau = document.querySelector('#niveau');
    if (niveau !== null) {
        filiere.addEventListener('change', function (e) {
            niveau.innerHTML = "";
            if (nivFiliere[e.target.value] != undefined) {
                niveau.innerHTML = "";
                for (let j = 0; j < nivFiliere[e.target.value].length; j++) {
                    let option = document.createElement('option');
                    option.innerText = nivFiliere[e.target.value][j];
                    option.value = nivFiliere[e.target.value][j];
                    niveau.appendChild(option);
                }
            }
        })
    }
}

let categorie = document.querySelector('#categorie');
if (categorie !== null) {
    let div = document.querySelector('#code_div');
    if (div !== null) {
        categorie.addEventListener('change', function (e) {
            if (e.target.value === 'Ancien') {
                if (div.classList.contains('display-none')) {
                    div.classList.remove('display-none');
                }
            } else {
                div.classList.add('display-none');
            }
        })
    }

}

let jours = document.querySelectorAll('.jours');
if (jours !== null) {
    for (let i = 0; i < jours.length; i++) {
        jours[i].addEventListener('change', function (e) {
            if (e.target.checked == true) {
                let div = document.querySelectorAll('.' + e.target.value);
                if (div !== null) {
                    for (let j = 0; j < div.length; j++) {
                        if (div[j].classList.contains('display-none')) {
                            div[j].classList.remove('display-none');
                        }
                    }
                }
            } else {
                let div = document.querySelectorAll('.' + e.target.value);
                if (div !== null) {
                    for (let j = 0; j < div.length; j++) {
                        div[j].classList.add('display-none');
                    }
                }
            }
        });
    }
}

function modaleDelete(classe) {
    const del = document.querySelectorAll("." + classe);
    if (del != null) {
        for(let j = 0; j < del.length; j++){
            del[j].addEventListener('submit', e => {
                e.preventDefault();
                let cover = document.querySelector('.cover');
                if (!cover.classList.contains('modale-open')) {
                    cover.classList.add('modale-open');
                }
                let confirmation = document.querySelector('#confirmation');
                if (!confirmation.classList.contains('modale-open')) {
                    confirmation.classList.add('modale-open');
                    let cancel = document.querySelector('#cancel');
                    cancel.addEventListener('click', ev => {
                        confirmation.classList.remove('modale-open');
                        cover.classList.remove('modale-open');
                        e.preventDefault();
                    })
                }
                let conf = document.querySelector('#conf');
                conf.addEventListener('click', even => {
                    e.preventDefault();
                    del[j].submit();
                })
            })
        }
    }

}
modaleDelete('delete');

function imprimer(divName) {
    let printContents = document.querySelector(divName).innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

let print = document.querySelector('#print');
if (print != null) {
    print.addEventListener('click', function (e) {
        imprimer('#for-print');
    })
}

let noPhoto = document.querySelector('#no-photo');
let havePhoto = document.querySelector('#have-photo');

if(noPhoto != null && havePhoto != null){
    console.log(havePhoto);
}

$(document).ready(function(){
    $('#utilisateur').DataTable();
});

$(document).ready(function () {
    $('#note').DataTable();
});

$(document).ready(function () {
    $('#cours').DataTable();
});

$(document).ready(function () {
    $('#professeur').DataTable();
});

$(document).ready(function () {
    $('#annee').DataTable();
});
$(document).ready(function () {
    $('#etudiant').DataTable();
});

