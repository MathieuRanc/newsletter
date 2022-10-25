// Custom example logic

let complete = false

var uploader = new plupload.Uploader({
  runtimes: 'html5,flash,silverlight,html4',
  browse_button: 'pickfiles', // you can pass an id...
  container: document.getElementById('container'), // ... or DOM Element itself
  // url: '/upload_files.php',
  // url: 'https://newsletter.lmlccommunication.fr/upload_files.php',
  url: 'http://localhost:8000/upload_files.php',
  flash_swf_url: './assets/js/plupload/Moxie.swf',
  silverlight_xap_url: './assets/js/plupload/Moxie.xap',

  drop_element: 'container', // will be appended to DOM when dropped

  chunk_size: '2mb',

  filters: {
    max_file_size: '2gb',
  },
  max_retries: 3,

  init: {
    PostInit: function () {
      document.getElementById('filelist').innerHTML = ''

      document.getElementById('uploadfiles').onclick = function () {
        // console.log('uploader :', uploader['files'][0]);
        uploader.start()
        return false
      }
    },

    FilesAdded: function (up, files) {
      plupload.each(files, function (file) {
        document.getElementById('filelist').innerHTML +=
          '<div id="' +
          file.id +
          '"><div class="bg"></div><div>' +
          file.name +
          ' (' +
          plupload.formatSize(file.size) +
          ')</div></div>'
      })
    },

    UploadProgress: function (up, file) {
      // document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML =
      //   '<span>' + file.percent + '%</span>'
      document
        .getElementById(file.id)
        .getElementsByClassName('bg')[0].style.width = file.percent + '%'
    },

    Error: function (up, err) {
      document
        .getElementById('console')
        .appendChild(
          document.createTextNode('\nError #' + err.code + ': ' + err.message),
        )
    },
  },
})

uploader.init()
