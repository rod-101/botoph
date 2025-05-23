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
    const cand = candidates.find(c => c.id === editId);
    document.getElementById("candidateId").value = cand.id;
    document.getElementById("name").value = cand.name;
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

function renderCandidates() {
  list.innerHTML = "";
  candidates.forEach(c => {
    const card = document.createElement("div");
    card.className = "card";
    card.innerHTML = `
      <h3>${c.name}</h3>
      <p><strong>Position:</strong> ${c.position}</p>
      <p><strong>Party:</strong> ${c.party}</p>
      <p>${c.platform}</p>
      <div class="card-actions">
        <button onclick="editCandidate(${c.id})">Edit</button>
        <button onclick="deleteCandidate(${c.id})" style="background:#cc0000;">Delete</button>
      </div>
    `;
    list.appendChild(card);
  });
}

function editCandidate(id) {
  openModal(id);
}

function deleteCandidate(id) {
  candidates = candidates.filter(c => c.id !== id);
  renderCandidates();
}

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const id = editingId ?? Date.now();
  const newCandidate = {
    id,
    name: form.name.value,
    position: form.position.value,
    party: form.party.value,
    platform: form.platform.value,
  };

  if (editingId) {
    const index = candidates.findIndex(c => c.id === editingId);
    candidates[index] = newCandidate;
  } else {
    candidates.push(newCandidate);
  }

  renderCandidates();
  closeModal();
});

addBtn.addEventListener("click", () => openModal());
cancelBtn.addEventListener("click", closeModal);

// Initial dummy data
candidates = [
  { id: 1, name: "Juan Dela Cruz", position: "President", party: "Partido Pilipino", platform: "Education reform, clean energy, peace & order." },
  { id: 2, name: "Maria Santos", position: "Senator", party: "Bagong Bayan", platform: "Healthcare for all, job generation, digital transformation." }
];
renderCandidates();
