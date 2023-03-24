async function updateQuest($name, $date, $type) {
        if($name === "" || $date === "") {
            return;
        }

        let data = [];
        data.push({
            "Id": document.getElementById("Id").value,
            "Quest_Name": $name,
            "Quest_Type": $type,
            "Date": $date,
        })

        let a = await fetch("../../api/update/quests/user/update", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
        });
        let b = await a.text();
        console.log(b);
}