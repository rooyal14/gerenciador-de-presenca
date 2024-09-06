// ---------- modal dos alunos-----------------------
// Seleciona os elementos necessários
const aluno_modal= document.getElementById("aluno_modal");
const openModalBtn_aluno = document.getElementById("openModalBtn_aluno");
const closeBtn_aluno = document.getElementsByClassName("close_aluno")[0];

// Quando o usuário clicar no botão, abre o modal
openModalBtn_aluno.onclick = function(){
  aluno_modal.style.display = "block";
}

// Quando o usuário clicar no "x", fecha o modal
closeBtn_aluno.onclick = function() {
  aluno_modal.style.display = "none";
}

// ---------- modal dos profs-----------------------
const professor_modal= document.getElementById("professor_modal");
const openModalBtn_professor = document.getElementById("openModalBtn_professor");
const closeBtn_professor = document.getElementsByClassName("close_professor")[0];

openModalBtn_professor.onclick = function(){
  professor_modal.style.display = "block";
}

closeBtn_professor.onclick = function(){
  professor_modal.style.display = "none";
}

// ---------- modal das matérias ----------------------
const materia_Modal= document.getElementById("materia_Modal");
const openModalBtn_materia= document.getElementById("openModalBtn_materia");
const close_materia= document.getElementsByClassName("close_materia")[0];

openModalBtn_materia.onclick= function(){
  materia_Modal.style.display = "block";
}
close_materia.onclick = function(){
  materia_Modal.style.display="none";
}