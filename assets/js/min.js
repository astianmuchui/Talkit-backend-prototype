const lines = document.getElementById("lines");
const cancel = document.getElementById("cancel");
const menu = document.getElementById("menu");

lines.onclick = ()=>{
    menu.style.display = "flex";

}
cancel.onclick = ()=>{
    menu.style.display = "none";
}
