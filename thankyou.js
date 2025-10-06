// JavaScript for confetti effect and go-back functionality
const canvas = document.querySelector('.confetti');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

function randomColor() {
  const colors = ['#4CAF50', '#FFD700', '#FF4500', '#1E90FF', '#32CD32'];
  return colors[Math.floor(Math.random() * colors.length)];
}

const confettiPieces = Array.from({ length: 100 }, () => ({
  x: Math.random() * canvas.width,
  y: Math.random() * canvas.height,
  color: randomColor(),
  size: Math.random() * 5 + 2,
  speed: Math.random() * 5 + 1,
}));

function drawConfetti() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  confettiPieces.forEach((piece) => {
    ctx.beginPath();
    ctx.arc(piece.x, piece.y, piece.size, 0, Math.PI * 2);
    ctx.fillStyle = piece.color;
    ctx.fill();
    piece.y += piece.speed;
    if (piece.y > canvas.height) piece.y = -piece.size;
  });
  requestAnimationFrame(drawConfetti);
}

drawConfetti();

function goBack() {
  window.location.href="teacher.html";
}
function redirectToPage() {
    window.location.href = "bank_details.html"; // Redirects to the bank details collection page
  }