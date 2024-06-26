/*
var waitingList = [
    {
        Name: "Lucian",
        Number: 573,
        InvNumber: 573-1000,
        Diff: 0
    },
    {
        Name: "Niiraitsu",
        Number: 765,
        InvNumber: 765-1000,
        Diff: 0
    },
    {
        Name: "cath_na",
        Number: 933,
        InvNumber: 933-1000,
        Diff: 0
    },
    {
        Name: "Ota_PP48",
        Number: 48,
        InvNumber: 48-1000,
        Diff: 0
    },
];
*/
var waitingList = [];
var playingList = [];
var writeHTML = "";
var playing = 0;

const nextRandom =
    '<br><div class="my-3"></div><br><button class="btn btn-outline-dark mx-1 my-2" onClick="random()"><i class="bi bi-dice-5 me-2"></i>Next</button><button class="btn btn-outline-success mx-1 my-2" onClick="result()"><i class="bi bi-trophy me-2"></i>Go to Result</button>';
const lastRandom =
    '<br><div class="my-3"></div><br><button class="btn btn-outline-success mx-1 my-2" onClick="result()"><i class="bi bi-trophy me-2"></i>Go to Result</button>';

function switchPanel(from, to) {
    document.getElementById(from).classList.add("d-none");
    document.getElementById(to).classList.remove("d-none");

    if (from == "input-panel" && to == "random-panel") {
        document.getElementById("random-display").classList.add("d-none");
        document.getElementById("result-display").classList.add("d-none");
        document.getElementById("confirm-message").classList.remove("d-none");
        document
            .getElementById("first-random-button")
            .classList.remove("d-none");
    }
    if (from == "random-panel" && to == "input-panel") {
        document.getElementById("destiny-number").innerHTML = "";
        document.getElementById("result-message").innerHTML = "";
        document.getElementById("winner-list").innerHTML = "";
        document.getElementById("confirm-message").classList.add("d-none");
        document.getElementById("first-random-button").classList.add("d-none");
        document.getElementById("random-display").classList.add("d-none");
        document.getElementById("result-display").classList.add("d-none");
        playing = 0;
        playingList = [];
        checkSorting();
        checkWaitingList();
    }
}

function getItemFromWaitingList(item) {
    writeHTML +=
        '<p><button type="button" class="btn btn-sm btn-outline-danger me-2 mb-1" aria-label="Delete" id="' +
        item.Name +
        "-" +
        item.Number +
        '" onClick="deletePerson(' +
        item.Number +
        ')">';
    writeHTML +=
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg>';
    writeHTML +=
        '</button><span class="lead fw-bold">' +
        item.Name +
        "</span> <small>#" +
        item.Number +
        "</small></p>";
}

function getItemFromPlayingList(item) {
    writeHTML +=
        '<p><button type="button" disabled class="btn btn-sm btn-outline-secondary me-2 mb-1" aria-label="Delete">';
    writeHTML +=
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg>';
    writeHTML +=
        '</button><span class="lead fw-bold">' +
        item.Name +
        "</span> <small>#" +
        item.Number +
        "</small></p>";
}

function getWinnerFromPlayingList(item) {
    document.getElementById("winner-list").innerHTML +=
        '<br /><strong class="text-success">' + item.Name + "</strong>";
}

function printWaitingList() {
    if (waitingList.length != 0) {
        waitingList.forEach(getItemFromWaitingList);
    } else {
        writeHTML = '<p class="lead text-muted text-center">- Empty -</p>';
    }
    document.getElementById("name-list").innerHTML = writeHTML;
}

function printPlayingList() {
    if (playingList.length != 0) {
        playingList.forEach(getItemFromPlayingList);
    } else {
        writeHTML = '<p class="lead text-muted text-center">- Empty -</p>';
    }
    document.getElementById("name-list").innerHTML = writeHTML;
}

function pickanumber() {
    let i = 0;
    let repeat = false;
    const picked = Math.floor(Math.random() * 1000 + 1);
    for (i = 0; i < waitingList.length; i++) {
        if (picked == waitingList[i].Number) {
            repeat = true;
        }
    }
    if (repeat) {
        pickanumber();
    } else {
        document.getElementById("inputNumber").value = picked;
        checkInputs();
    }
}

function compareName(a, b) {
    const name1 = a.Name.toUpperCase();
    const name2 = b.Name.toUpperCase();

    let comparison = 0;

    if (name1 > name2) {
        comparison = 1;
    } else if (name1 < name2) {
        comparison = -1;
    }
    return comparison;
}

function compareNumber(a, b) {
    const number1 = a.Number;
    const number2 = b.Number;

    let comparison = 0;

    if (number1 > number2) {
        comparison = 1;
    } else if (number1 < number2) {
        comparison = -1;
    }
    return comparison;
}

function compareDiff(a, b) {
    const num1 = a.Diff;
    const num2 = b.Diff;

    let comparison = 0;

    if (num1 > num2) {
        comparison = -1;
    } else if (num1 < num2) {
        comparison = 1;
    }
    return comparison;
}

function checkInputName() {
    var value = document.getElementById("inputName").value;
    return /^[a-zA-Z0-9_-]{1,}$/.test(value);
}

function checkInputNumber() {
    var value = document.getElementById("inputNumber").value;
    if (
        !value ||
        isNaN(value) ||
        parseInt(value, 10) < 1 ||
        parseInt(value, 10) > 1000
    ) {
        return false;
    } else {
        return true;
    }
}

function checkInputs() {
    validName = checkInputName();
    validNumber = checkInputNumber();
    if (validName && validNumber) {
        document.getElementById("addButton").classList.remove("disabled");
        document.getElementById("addButton").classList.remove("btn-light");
        document.getElementById("addButton").classList.add("btn-dark");
        document.getElementById("addButton").removeAttribute("disabled");
    } else {
        document.getElementById("addButton").classList.remove("btn-dark");
        document.getElementById("addButton").classList.add("disabled");
        document.getElementById("addButton").classList.add("btn-light");
        document
            .getElementById("addButton")
            .setAttribute("disabled", "disabled");
    }
}

function checkDuplicate() {
    if (waitingList.length != 0) {
        for (var entry = 0; entry < waitingList.length; entry++) {
            var hasNameDupe = checkNameDuplicate(waitingList[entry]);
            var hasNumberDupe = checkNumberDuplicate(waitingList[entry]);
            if (hasNameDupe) {
                document.getElementById("inputErrorMessage").innerHTML =
                    "Duplicate Name / ชื่อซ้ำ";
                document
                    .getElementById("inputErrorMessage")
                    .classList.remove("d-none");
                break;
            } else if (hasNumberDupe) {
                document.getElementById("inputErrorMessage").innerHTML =
                    "Duplicate Number / เลขซ้ำ";
                document
                    .getElementById("inputErrorMessage")
                    .classList.remove("d-none");
                break;
            }
        }
        if (!hasNameDupe && !hasNumberDupe) {
            document
                .getElementById("inputErrorMessage")
                .classList.add("d-none");
            addPerson();
            document.getElementById("inputName").value = "";
            document.getElementById("inputNumber").value = "";
            document.getElementById("addButton").classList.remove("btn-dark");
            document.getElementById("addButton").classList.add("disabled");
            document.getElementById("addButton").classList.add("btn-light");
            document
                .getElementById("addButton")
                .setAttribute("disabled", "disabled");
        }
    } else {
        document.getElementById("inputErrorMessage").classList.add("d-none");
        addPerson();
        document.getElementById("inputName").value = "";
        document.getElementById("inputNumber").value = "";
        document.getElementById("addButton").classList.remove("btn-dark");
        document.getElementById("addButton").classList.add("disabled");
        document.getElementById("addButton").classList.add("btn-light");
        document
            .getElementById("addButton")
            .setAttribute("disabled", "disabled");
    }
}

function checkNameDuplicate(entry) {
    if (document.getElementById("inputName").value == entry.Name) {
        return true;
    } else {
        return false;
    }
}

function checkNumberDuplicate(entry) {
    if (document.getElementById("inputNumber").value == entry.Number) {
        return true;
    } else {
        return false;
    }
}

function addPerson() {
    var obj = {
        Name: document.getElementById("inputName").value,
        Number: parseInt(document.getElementById("inputNumber").value),
        InvNumber:
            parseInt(document.getElementById("inputNumber").value) - 1000,
        Diff: 0,
    };
    waitingList.push(obj);
    checkSorting();
    checkWaitingList();
}

function deletePerson(entry) {
    for (var count = 0; count < waitingList.length; count++) {
        if (waitingList[count].Number == entry) {
            waitingList.splice(count, 1);
            break;
        }
    }
    checkSorting();
    checkWaitingList();
}

function checkWaitingList() {
    if (waitingList.length > 1) {
        document.getElementById("startButton").classList.remove("btn-light");
        document.getElementById("startButton").classList.remove("disabled");
        document.getElementById("startButton").classList.add("btn-success");
        document.getElementById("startButton").removeAttribute("disabled");
    } else {
        document.getElementById("startButton").classList.remove("btn-success");
        document.getElementById("startButton").classList.add("disabled");
        document.getElementById("startButton").classList.add("btn-light");
        document
            .getElementById("startButton")
            .setAttribute("disabled", "disabled");
    }
}

function deleteFromPlayingList(number) {
    for (var count = 0; count < playingList.length; count++) {
        playingList[count].Diff = Math.abs(playingList[count].Number - number);
        if (playingList[count].Diff > 500) {
            playingList[count].Diff = Math.abs(
                playingList[count].InvNumber - number
            );
            if (playingList[count].Diff > 500) {
                playingList[count].Diff = Math.abs(
                    playingList[count].Number - (number - 1000)
                );
            }
        }
    }
    playingList = playingList.sort(compareDiff);
    if (
        playingList[playingList.length - 1].Diff ==
        playingList[playingList.length - 2].Diff
    ) {
        return null;
    } else {
        deletedUser = playingList.pop();
        playingList = playingList.sort(compareName);

        checkSorting();

        return deletedUser;
    }
}

function firstRandom() {
    document.getElementById("confirm-message").classList.add("d-none");
    document.getElementById("first-random-button").classList.add("d-none");
    document.getElementById("random-display").classList.remove("d-none");
    for (var count = 0; count < waitingList.length; count++) {
        playingList.push(waitingList[count]);
    }
    playing = 1;

    checkSorting();
    random();
}

function random() {
    var destinyNumber = 0;
    var showNumberDiv = document.getElementById("destiny-number");
    var resultDiv = document.getElementById("result-message");
    const fastSpeedIteration = 50;
    const midSpeedIteration = Math.floor(Math.random() * 12 + 8);
    const slowSpeedIteration = Math.floor(Math.random() * 7 + 1);
    var i = 0;

    showNumberDiv.style.color = "black";
    showNumberDiv.innerHTML = "";
    resultDiv.innerHTML = "";

    for (
        i = 0;
        i < fastSpeedIteration + midSpeedIteration + slowSpeedIteration;
        i++
    ) {
        if (i < fastSpeedIteration)
            setTimeout(function () {
                destinyNumber = Math.floor(Math.random() * 1000 + 1);
                showNumberDiv.innerHTML = destinyNumber;
            }, 50 * i);
        else if (i < fastSpeedIteration + midSpeedIteration - 1)
            setTimeout(function () {
                destinyNumber = Math.floor(Math.random() * 1000 + 1);
                showNumberDiv.innerHTML = destinyNumber;
            }, 50 * fastSpeedIteration + 150 * (i - fastSpeedIteration - 1));
        else
            setTimeout(function () {
                destinyNumber = Math.floor(Math.random() * 1000 + 1);
                showNumberDiv.innerHTML = destinyNumber;
            }, 50 * fastSpeedIteration +
                150 * midSpeedIteration +
                650 * (i - (midSpeedIteration + fastSpeedIteration - 1)));
        if (
            i ==
            fastSpeedIteration + midSpeedIteration + slowSpeedIteration - 1
        ) {
            setTimeout(function () {
                showNumberDiv.style.color = "red";
                var deletedUser = deleteFromPlayingList(destinyNumber);

                if (deletedUser != null) {
                    resultDiv.innerHTML =
                        '<span class="lead fw-bold">' +
                        deletedUser.Name +
                        "</span> <small>#" +
                        deletedUser.Number +
                        "</small><br><small>Eliminated!</small><br><span>Difference = " +
                        deletedUser.Diff +
                        "</span>";
                } else {
                    resultDiv.innerHTML =
                        '<span class="lead fw-bold">Draw! </span><br><small>This is getting intense!</small>';
                }

                if (playingList.length > 1) {
                    resultDiv.innerHTML += nextRandom;
                } else {
                    resultDiv.innerHTML += lastRandom;
                }
            }, 650 +
                50 * fastSpeedIteration +
                150 * midSpeedIteration +
                650 * (i - (midSpeedIteration + fastSpeedIteration - 1)));
        }
    }
}

function result() {
    document.getElementById("destiny-number").innerHTML = "";
    document.getElementById("result-message").innerHTML = "";
    document.getElementById("random-display").classList.add("d-none");
    document.getElementById("result-display").classList.remove("d-none");
    document.getElementById("winner-list").innerHTML =
        '<img src="https://lucian.solutions/images/125.png" alt="LucianLove" class="mb-4" style="max-height: 224px; max-width: 100%; height: auto; width: auto;" width="800" height="800" loading="lazy"></img>';
    playingList.forEach(getWinnerFromPlayingList);
}

function checkSorting() {
    const element = document.getElementsByName("sorting");
    let sorting = "";
    for (i = 0; i < element.length; i++) {
        if (element[i].checked) {
            sorting = element[i].value;
            break;
        }
    }

    if (playing == 0) {
        switch (sorting) {
            case "numericdesc":
                waitingList = waitingList.sort(compareNumber);
                waitingList = waitingList.reverse();
                break;
            case "numericasc":
                waitingList = waitingList.sort(compareNumber);
                break;
            case "alphadesc":
                waitingList = waitingList.sort(compareName);
                waitingList = waitingList.reverse();
                break;
            case "alphaasc":
            default:
                waitingList = waitingList.sort(compareName);
        }
        writeHTML = "";
        printWaitingList();
    } else if (playing == 1) {
        switch (sorting) {
            case "numericdesc":
                playingList = playingList.sort(compareNumber);
                playingList = playingList.reverse();
                break;
            case "numericasc":
                playingList = playingList.sort(compareNumber);
                break;
            case "alphadesc":
                playingList = playingList.sort(compareName);
                playingList = playingList.reverse();
                break;
            case "alphaasc":
            default:
                playingList = playingList.sort(compareName);
        }
        writeHTML = "";
        printPlayingList();
    }
}
