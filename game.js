let totalClicks = 0;
let gameState = 0;
let interval;

document.getElementById("click-counter").onclick = function() {
    console.log("here " + gameState + " " + totalClicks);
    switch (gameState){
        case 0: // primed to start playing game
            totalClicks++;
            gameState = 1;
            interval = setInterval(logGame, 5000);
            document.getElementById("clicks").innerText = totalClicks;
            break;
        case 1: // playing game
            totalClicks++;
            document.getElementById("clicks").innerText = totalClicks;
            break;
        case 2: // no game. waiting for player to click restart
            break;
        default:
            break;
    }
}

function getUsername(){
    return sessionStorage.getItem("User");
}

function getDate(){
    let date = new Date();
    let actualDate = (date.getMonth()+1) + "-" + (date.getDate()) + "-" + (date.getFullYear());
    return actualDate;
}

function logGame(){
    clearInterval(interval);
    gameState = 2;

    // totalClicks divided by deltaTime
    var cps = totalClicks/5.0;
    
    document.getElementById("cps").innerText = cps + " clicks/sec";
    //somehow send score to php
    buildForm(cps);
    
    totalClicks = 0;
}

function buildForm(cps){
    document.getElementById("f-username").setAttribute("value", getUsername());
    document.getElementById("f-clicks").setAttribute("value", totalClicks);
    document.getElementById("f-cps").setAttribute('value', cps);
    document.getElementById("f-date").setAttribute("value", getDate());
}