document.addEventListener("DOMContentLoaded", () => {
  const navigation = document.querySelector('nav');
  let navigationMenuButtons = navigation.querySelectorAll('.menu-button');
  replaceIcons(navigationMenuButtons);

  const contactInfo = document.querySelector('#contact-info');
  let contactInfoMenuButtons = contactInfo.querySelectorAll('.menu-button');
  replaceIcons(contactInfoMenuButtons);
});

function replaceIcons(buttons) {
  buttons.forEach(button => {
    const id = button.id;
    const iconPath = '../../../../../../uploads/' + id + '.png';
    const imageUrl = 'url(\'' + iconPath + '\')';

    button.style.setProperty('--image-url', imageUrl);
  });
}
