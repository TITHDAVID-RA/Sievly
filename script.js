const wrapper = document.querySelector('.wrapper');
const question = document.querySelector('.question');
const gif = document.querySelector('.gif');
const yesBtn = document.querySelector('.yes-btn');
const noBtn = document.querySelector('.no-btn');

yesBtn.addEventListener('click', () => {
    // A more personalized, sweet message
    question.innerHTML = "Happy Valentine’s Day to the girl who makes every day better just by being in it. I’m so lucky I get to call you mine today and every other day. I love you ❤️";
    
    // Change the gif to a "happy/celebration" one
    gif.src = "https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExcjR5eGk0enYxdGNod3cweXppOGFrbWlxM3F5MWxxY2NrZ3M4cGxzaSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/dyYOjf4hSYLuFPt4lm/giphy.gif";

    // Hide the No button
    noBtn.style.display = 'none';
    
    // Make the Yes button extra happy
    yesBtn.style.transform = "scale(1.2)";
    yesBtn.innerHTML = "Best day ever!";
});

noBtn.addEventListener('mouseover', () => {
    // Calculate random position
    const noBtnRect = noBtn.getBoundingClientRect();
    const maxX = window.innerWidth - noBtnRect.width;
    const maxY = window.innerHeight - noBtnRect.height;

    const randomX = Math.floor(Math.random() * maxX);
    const randomY = Math.floor(Math.random() * maxY);

    noBtn.style.left = randomX + 'px';
    noBtn.style.top = randomY + 'px';
});