document.addEventListener("DOMContentLoaded", () => {
  const navigation = document.querySelector('nav');
  let menuButtons = navigation.querySelectorAll('.menu-button');

  menuButtons.forEach(button => {
    const id = button.id;
    const iconPath = '../../../../../../uploads/' + id + '.png';
    const imageUrl = 'url(\'' + iconPath + '\')';

    button.style.setProperty('--image-url', imageUrl);
  });
});
