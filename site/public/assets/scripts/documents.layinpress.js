document.addEventListener("DOMContentLoaded", () => {
  const files = document.querySelectorAll('.wp-block-file');

  files.forEach(file => {
    const fileUrl = file.querySelector('a').getAttribute('href');
    const fileTitle = file.querySelector('a').textContent;

    let anchor = document.createElement('a');
    anchor.classList = ['document'];
    anchor.href = fileUrl;
    
    let content = document.createElement('div');
    content.classList = ['content'];
    content.textContent = fileTitle;

    anchor.appendChild(content);

    file.replaceWith(anchor);
  });
});
