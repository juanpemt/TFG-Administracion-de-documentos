function updatemenu() {
  if (document.getElementById('responsive-menu').checked == true) {
    document.getElementById('menu').style.borderBottomRightRadius = '0';
    document.getElementById('menu').style.borderBottomLeftRadius = '0';
  }else{
    document.getElementById('menu').style.borderRadius = '10px';
  }
}


// function fileValidation(){
//   var fileInput = document.getElementById('file');
//   var filePath = fileInput.value;
//   var allowedExtensions = /(.pdf)$/i;
//   if(!allowedExtensions.exec(filePath)){
//       alert('Error el archivo no es PDF.');
//       fileInput.value = '';
//       return false;
//   }
// }