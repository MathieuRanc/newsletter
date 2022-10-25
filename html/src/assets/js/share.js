// on click on file class 'file' id is added to the form hidden field

let files = document.querySelectorAll('.file')

files.forEach((file) => {
  file.addEventListener('click', function () {
    // display the div with class 'edit-menu'
    document.querySelector('.edit-menu').style.display = 'block'

    let data = file.getElementsByClassName('infos')[0].textContent
    data = JSON.parse(data)

    document.getElementById('file_id').value = data.id
    document.getElementById('name').value = data.name

    let preview = ''
    if (data.type === 'image') {
      preview = `<img src="https://newsletter.lmlccommunication.fr/${data.location}" />`
    } else if (data.type === 'video') {
      preview = `<video controls><source src="https://newsletter.lmlccommunication.fr/${data.location}" type="video/mp4"></video>`
    } else if (data.type === 'audio') {
      preview = `<audio controls><source src="https://newsletter.lmlccommunication.fr/${data.location}" type="audio/mp3"></audio>`
    } else if (data.type === 'document') {
      preview = `<a href="https://newsletter.lmlccommunication.fr/${data.location}" target="_blank">${data.name}</a>`
    } else {
      preview = `<a href="https://newsletter.lmlccommunication.fr/${data.location}" target="_blank">${data.name}</a>`
    }

    document.getElementById('file-preview').innerHTML = preview

    if (data.guests && data.guests.length > 0) {
      document
        .querySelectorAll('form input[type="checkbox"]')
        .forEach((input) => {
          input.checked = false
          // add active class to label in guests list
          let guests = data.guests.split(',')
          guests.forEach((guest) => {
            if (input.value === guest) {
              input.checked = true
            }
          })
        })
    } else {
      document
        .querySelectorAll('form input[type="checkbox"]')
        .forEach((input) => (input.checked = false))
    }

    document.getElementById('name').addEventListener('change', (event) => {
      console.log(event.target.value)
      let xhr = new XMLHttpRequest()
      xhr.open('POST', '/update_file.php')

      xhr.setRequestHeader('Accept', 'application/json')
      xhr.setRequestHeader('Content-Type', 'application/json')

      xhr.onload = () => console.log(xhr.responseText)

      let json = { id: data.id, name: event.target.value }

      xhr.send(json)
    })
  })
})

function closeMenu() {
  document.querySelector('.edit-menu').style.display = 'none'
}
