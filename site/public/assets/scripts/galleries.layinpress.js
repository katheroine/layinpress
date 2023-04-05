document.addEventListener("DOMContentLoaded", () => {
  const galleries = document.querySelectorAll('.wp-block-gallery');

  galleries.forEach(gallery => {
    const captionText = gallery.querySelector('figcaption.blocks-gallery-caption').textContent;
    const figures = gallery.querySelectorAll('figure');

    let slideshow = document.createElement('div');
    slideshow.classList = ['gallery slideshow'];

    let preloader = document.createElement('div');
    preloader.classList = ['preloader'];

    slideshow.appendChild(preloader);

    let content = document.createElement('div');
    content.classList = ['content'];

    let counter = document.createElement('div');
    counter.classList = ['counter'];

    let actualNumber = document.createElement('span');
    actualNumber.classList = ['actual_number'];
    actualNumber.textContent = '1';
    
    let quantity = document.createElement('span');
    quantity.classList = ['quantity'];
    quantity.textContent = figures.length;

    counter.appendChild(actualNumber);
    counter.append('/');
    counter.appendChild(quantity);

    content.appendChild(counter);

    let navigation = document.createElement('div');
    navigation.classList = ['navigation'];

    let buttonPrev = document.createElement('button');
    buttonPrev.classList = ['prev'];
    buttonPrev.setAttribute('onclick', 'showPrev(this);');
    buttonPrev.textContent = '❮';

    let buttonNext = document.createElement('button');
    buttonNext.classList = ['next'];
    buttonNext.setAttribute('onclick', 'showNext(this);');
    buttonNext.textContent = '❯';

    navigation.appendChild(buttonPrev);
    navigation.appendChild(buttonNext);

    content.appendChild(navigation);

    let images = document.createElement('div');
    images.classList = ['images'];

    figures.forEach(figure => {
      images.appendChild(figure);
    });

    content.appendChild(images);

    var caption = document.createElement('div');
    caption.classList = ['caption'];
    caption.textContent = captionText;

    content.appendChild(caption);

    slideshow.appendChild(content);

    gallery.replaceWith(slideshow);
  });

  initSlideshows();
});

function initSlideshows() {
  var slideshows = Array.from(
    document.getElementsByClassName("slideshow")
  );

  slideshows.forEach(initSlideshow);
}

function initSlideshow(slideshow, index) {
  var preloader = slideshow.getElementsByClassName("preloader")[0];
  var content = slideshow.getElementsByClassName("content")[0];
  var figures = Array.from(
    slideshow.getElementsByTagName("figure")
  );

  var firstFigure = figures[0];
  firstFigure.style.display = "flex";
  firstFigure.classList.add("current");

  var figuresNumber = figures.length;
  var counterQuantity = slideshow.getElementsByClassName("quantity")[0];
  counterQuantity.innerText = figuresNumber;

  preloader.style.display = "none";
  content.style.display = "block";
}

function showNext(nextButton) {
  var slideshow = nextButton.closest(".slideshow");

  currentFigure = slideshow.getElementsByClassName("current")[0];
  nextFigure = currentFigure.nextElementSibling;

  if (!nextFigure) {
    nextFigure = slideshow.getElementsByTagName("figure")[0];
    actualNumber = 1;
  } else {
    actualNumber = Array.from(
      slideshow.getElementsByTagName("figure")
    ).lastIndexOf(currentFigure) + 2;
  }

  toggleCurrentAndFollowingElements(currentFigure, nextFigure);

  refreshCounterActualNumber(slideshow, actualNumber);
}

function showPrev(prevButton) {
  var slideshow = prevButton.closest(".slideshow");

  currentFigure = slideshow.getElementsByClassName("current")[0];
  currentIndex = Array.from(
    slideshow.getElementsByTagName("figure")
  ).lastIndexOf(currentFigure);
  prevFigure = currentFigure.previousElementSibling;

  if (!prevFigure) {
    var figures = slideshow.getElementsByTagName("figure");
    lastIndex = figures.length - 1;
    prevFigure = slideshow.getElementsByTagName("figure")[lastIndex];
    actualNumber = figures.length;
  } else {
    actualNumber = currentIndex;
  }

  toggleCurrentAndFollowingElements(currentFigure, prevFigure);

  refreshCounterActualNumber(slideshow, actualNumber);
}

function toggleCurrentAndFollowingElements(currentElement, followingElement) {
  currentElement.style.display = "none";
  currentElement.classList.remove("current");
  followingElement.style.display = "flex";
  followingElement.classList.add("current");
}

function refreshCounterActualNumber(slideshow, actualNumber) {
  var counterActualNumber = slideshow.getElementsByClassName("actual_number")[0];
  counterActualNumber.innerText = actualNumber;
}
