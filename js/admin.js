const addBtn = document.getElementById("addBtn");
const modal = document.getElementById("modal");
const cancelBtn = document.getElementById("cancelBtn");
const form = document.getElementById("candidateForm");
const list = document.getElementById("candidateList");
const modalTitle = document.getElementById("modalTitle");

let editingId = null;
let candidates = [];

function openModal(editId = null) {
  modal.classList.remove("hidden");
  if (editId !== null) {
    const cand = candidates.find(c => c.id == editId);
    document.getElementById("candidateId").value = cand.id;
    document.getElementById("fname").value = cand.firstName;
    document.getElementById("lname").value = cand.lastName;
    document.getElementById("position").value = cand.position;
    document.getElementById("party").value = cand.party;
    document.getElementById("platform").value = cand.platform;
    modalTitle.textContent = "Edit Candidate";
    editingId = cand.id;
  } else {
    form.reset();
    modalTitle.textContent = "Add Candidate";
    editingId = null;
  }
}

function closeModal() {
  modal.classList.add("hidden");
  editingId = null;
}

async function renderCandidates() {
    let res = await fetch('../api/get_candidates.php');
    candidates = await res.json();
    list.innerHTML = "";
    candidates.forEach(c => {
        const card = document.createElement("div");
        card.className = "card";
        console.log('photoUrl for ' + c.fullname + " is " + c.photoUrl);
        card.innerHTML = `
            <img src="../assets/candidates/${c.photoUrl}?t=${Date.now()}" class="card-img" alt="${c.fullname}">
            <h3>${c.fullname}</h3>
            <p><strong>Running:</strong> ${c.position}</p>
            <p><strong>Party:</strong> ${c.party}</p>
            <p>${c.platform}</p>
            <div class="card-actions">
                <button onclick="editCandidate(${c.id})">Edit</button>
                <button onclick="editPage(${c.id})" style="background:#00aa00;">Page</button>
                <button onclick="deleteCandidate(${c.id})" style="background:#dd0000;">Delete</button>
            </div>
        `;
        list.appendChild(card);
    });
}

function editCandidate(id) {
  openModal(id);
}

async function deleteCandidate(id) {
    if(confirm("Deleted records are not stored. \nAre you sure you want to delete this candidate?")) {
        await fetch('../api/delete_candidate.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({id})
        })
        await renderCandidates();
    }
}

function editPage(id) {
    window.location.href = "editor.html";
}

// modal.classList.remove('hidden')

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData();
    const candidate_id = editingId ?? Date.now(); //check if editing or adding candidate

    formData.append("candidate_id", candidate_id);
    formData.append("fname", form.fname.value);
    formData.append("lname", form.lname.value);
    formData.append("position", form.position.value);
    formData.append("party", form.party.value);
    formData.append("platform", form.platform.value);

    const photoFile = document.getElementById("photoUpload").files[0];
    if (photoFile) {
        formData.append("photoUpload", photoFile);
        document.getElementById('photoUpload').value = '';
    }

    if (editingId) {
        // Send form data to server
        const response = await fetch("../api/update_candidate.php", {
            method: "POST",
            body: formData // must not set Content-Type manually
        });

        if (response.ok) {
            await renderCandidates(); // refresh the list
           
            closeModal(); // close the form
        } else {
            alert("Error updating candidate.");
        }    // const index = candidates.findIndex(c => c.id == editingId);
    // candidates[index] = newCandidate;
    } else {
        console.log("Sending form data...");
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }
        const response = await fetch('../api/add_candidate.php', {
            method: 'POST',
            body: formData
        })
        console.log(window.location.href)

        if(response.ok) {
            console.log('response is ok.');
            await renderCandidates();
           
            closeModal();
        } else {
            alert("Error adding candidate.");
        }
        // candidates.push(newCandidate);
    }
});

addBtn.addEventListener("click", () => openModal());
cancelBtn.addEventListener("click", closeModal);

renderCandidates();
