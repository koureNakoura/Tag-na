const titreSpans = document.querySelectorAll('h1 span');
const h2 = document.querySelectorAll('h2 ');
const btns = document.querySelectorAll('.btn-get-started');
//const logo = document.querySelector('.logo');
//const medias = document.querySelectorAll('.bulle');
//const l1 = document.querySelector('.l1');
//const l2 = document.querySelector('.l2');

window.addEventListener('load', () => {

    const TL = gsap.timeline({paused: true});

    TL
    .staggerFrom(titreSpans, 1, {top: -50, opacity: 0, ease: "power2.out"}, 0.3)
    .staggerFrom(h2, 1, {top: -50, opacity: 0, ease: "power2.out"}, 0.3)
    .staggerFrom(btns, 1, {opacity: 0, ease: "power2.out"}, 0.3, '-=1')
  //  gsap.from(l1, 1, {width: 0, ease: "power2.out"}, '-=2')
 //   gsap.from(l2, 1, {width: 0, ease: "power2.out"}, '-=2')
 //   gsap.from(logo, 0.4, {transform: "scale(0)", ease: "power2.out"}, '-=2')
 //   gsap.staggerFrom(medias, 1, {right: -200, ease: "power2.out"}, 0.3, '-=1');

    
    

    TL.play();
})