

const allCross = document.querySelectorAll('.visible-pannel img');
console.log(allCross);

allCross.forEach(element => {

    element.addEventListener('click', function () {

        const height = this.parentNode.parentNode.childNodes[3].scrollHeight;

        const currentChoice = this.parentNode.parentNode.childNodes[3];


        // console.log(this.src);
        if (this.src.includes('bottom-arrow')) {
            this.src = 'img/top-arrow.png';
            gsap.to(currentChoice, { duration: 0.2, height: height + 20, opacity: 1, padding: '0px 0px' })
        } else if (this.src.includes('top-arrow')) {
            this.src = 'img/bottom-arrow.png';
            gsap.to(currentChoice, { duration: 0.2, height: 0, opacity: 0, padding: '0px 0px' })
        }

    })
})

