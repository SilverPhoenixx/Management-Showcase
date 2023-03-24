window.onload = () => {
    document.getElementById("date").valueAsDate = new Date();
}

async function addDiaryEntry() {
    const date = document.getElementById("date").valueAsDate;
    const month = date.getMonth() < 9 ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
    const dateString = date.getDate() + "." + month + "." + date.getFullYear();
    const text = document.getElementById("text").value;
    const title = document.getElementById("title").value;

    if(title === "" || text === "") {
        return;
    }


    let data = [];
    data.push({
        "Id": document.getElementById("Id").value,
        "Text": text,
        "Title": title,
        "Date": dateString,
    })



    await fetch("../../api/update/diary/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });

    window.location.href = window.location.href;
}

async function deleteDiary(event) {
    if(title === "" || text === "") {
        return;
    }

    let data = [];
    data.push({
        "Id": event,
    })



    await fetch("../../api/update/diary/delete", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data)
    });

    window.location.href = window.location.href;
}