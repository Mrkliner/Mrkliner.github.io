const canvas = document.getElementById("game");
const stx = canvas.getContext("2d");
const ground = new Image();
ground.scr = "Mrkliner.github.io/Game/img/ground.png";
const food = new Image();
food.scr = "Mrkliner.github.io/Game/img/food.png";
let box = 32;
let score = 0;
function DrawGame() {
  ctx.drawImage(ground, 0, 0);
}
let game = setIntrval(DrawGame, 100);
