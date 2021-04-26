
//grab cost per item, the id in the html to get the counter value from, and the id to change with the new input
function getTotalPrice(costPer, idToCheck, idToMod) {
    console.log(idToCheck);
    var count = document.getElementById(idToCheck).value;
    console.log(count);
    document.getElementById(idToMod).innerHTML = '$' + (count ? (costPer * count) : costPer) + '.00';
}

var count9 = document.getElementById("quantity9");

