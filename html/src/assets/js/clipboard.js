function copyClipboard(element) {
  const src = element.parentNode.parentNode.parentNode.querySelector(
    'img,video,iframe',
  ).src
  navigator.clipboard.writeText(src)
  // alert('Lien du fichier copié')
}
