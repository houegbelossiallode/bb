document.getElementById("type").addEventListener("change", function () {
    var blocType = document.getElementById("blocType");
    if (this.value === "Personne morale") {
        blocType.style.display = "block";
    } else {
        blocType.style.display = "none";
    }
});

document.getElementById("typechamp").addEventListener("change", function () {
    var blocChamp = document.getElementById("blocChamp");
    if (this.value === "select") {
        blocChamp.style.display = "block";
    } else {
        blocChamp.style.display = "none";
    }
});

document.getElementById("role").addEventListener("change", function () {
    var blocRole = document.getElementById("blocRole");
    if (this.value === "Personnel") {
        blocRole.style.display = "block";
    } else {
        blocRole.style.display = "none";
    }
});
