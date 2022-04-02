var table ="";
function getTable() {
    var tableBac = document.getElementById("tableBac");
    table = tableBac.value;
    if (table == "entier") {
        document.getElementById("entier").hidden = false;
        document.getElementById("pro").hidden = true;
        document.getElementById("reste").hidden = true;

        document.getElementById("CsvEntier").hidden = false;
        document.getElementById("CsvPro").hidden = true;
        document.getElementById("CsvReste").hidden = true;
    }
    else if(table == "pro") {
        document.getElementById("entier").hidden = true;
        document.getElementById("pro").hidden = false;
        document.getElementById("reste").hidden = true;

        document.getElementById("CsvEntier").hidden = true;
        document.getElementById("CsvPro").hidden = false;
        document.getElementById("CsvReste").hidden = true;
    }
    else if (table == "reste") {
        document.getElementById("entier").hidden = true;
        document.getElementById("pro").hidden = true;
        document.getElementById("reste").hidden = false;

        document.getElementById("CsvEntier").hidden = true;
        document.getElementById("CsvPro").hidden = true;
        document.getElementById("CsvReste").hidden = false;
    }
}

function resetForm() {
    document.getElementById("tableBac").value = "entier";
}

function resetStats() {
    document.getElementById("year").value = "en cours";
}

