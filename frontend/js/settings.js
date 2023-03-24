window.onload = () => {
    for (let activity of document.getElementsByClassName("activity")) {
        activity.addEventListener("change", (event) => { updatePercent(event)});
        activity.addEventListener("wheel", (event) => { updatePercentWheel(event)});
    }
}

async function updateSlaveSettings() {
    let data = [];

    let activity = [];
    for (let act of document.getElementsByClassName("activity")) {
        activity.push({"Name": act.dataset.activityname, "Percent":  act.value});
    }

    data.push({
        "Id": document.getElementById("Id").value,
        "Name": document.getElementById("Name").value,
        "Description": document.getElementById("Description").value,
        "Rank": document.getElementById("Rank").value,
        "Level": document.getElementById("Level").value,
        "Exp": document.getElementById("Exp").value,
        "Image": document.getElementById("Image").value,
        "Activities": JSON.stringify(activity)
    })

    
    
    await fetch("../api/update/user/information", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });

    window.location.href = window.location.href;
}

async function addActivity() {
    let data = [];

    if(document.getElementById("newActivity").value == "") {
        return;
    }

    data.push({
        "Id": document.getElementById("Id").value,
        "Name": document.getElementById("newActivity").value,
    })



    await fetch("../api/update/activity/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });

   window.location.href = window.location.href;
}

async function deleteActivity(element) {
    let data = [];

    data.push({
        "BA_Id": element
    });

    await fetch("../api/update/activity/delete", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });

    window.location.href = window.location.href;
}

async function addQuest() {

    if(document.getElementById("newQuestName").value === "" || document.getElementById("newQuestType").value === "") {
        return;
    }

    let data = [];

    data.push({
        "Quest_Name": document.getElementById("newQuestName").value,
        "Quest_Type": document.getElementById("newQuestType").value
    });

    await fetch("../api/update/quests/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });
    window.location.href = window.location.href;
}

function updatePercentWheel(event) {
    const element = event.target.dataset.activityname;

    if (event.deltaY < 0){
        let newValue = parseInt(document.getElementById("range" + element).value) + 1;
        document.getElementById("range" + element).value = newValue;
    }else{
        document.getElementById("range" + element).value -= 1;
    }
    event.preventDefault();
    event.stopPropagation();
    document.getElementById("percent" + element).innerHTML = document.getElementById("range" + element).value + " %";
}
function updatePercent(event) {
    const element = event.target.dataset.activityname;
    document.getElementById("percent" + element).innerHTML = document.getElementById("range" + element).value + " %";
}
async function deleteQuest(element) {
    let data = [];

    data.push({
        "Quest_Id": element
    });

    await fetch("../api/update/quests/delete", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });

    window.location.href = window.location.href;
}

