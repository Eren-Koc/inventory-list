
$('.submit-btn').on('click',function(){

    let adet =document.getElementById("form-count").value;
    let urun = document.getElementById("form-product").value;

    if(adet!=="" || urun!==""){   
        Swal.fire({
            position: 'center-center',
            icon: 'success',
            title: 'Başarıyla Eklendi',
            showConfirmButton: false,
            timer: 1000
          })
        }
});

function DeleteRequest(clicked_id){

    Swal.fire({
        title: 'Silmek istediğine emin misin?',
        text: "Bu işlem geri döndürülemez!",
        icon: 'warning',
        cancelButtonText:'Hayır',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, Sil!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Silindi!',
            'Silme işlemi tamamlandı.',
            'success'
          )
          window.location.replace(clicked_id);
        }
      })

}

function LogoutRequest(clicked_id){

  Swal.fire({
      title: 'Çıkış yapmak istediğine emin misin?',
      text: "Çıkış işlemi",
      icon: 'warning',
      cancelButtonText:'Hayır',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Evet'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Çıkış Yapıldı!',
          'Başarıyla çıkış yapıldı.',
          'success'
        )
        window.location.replace(clicked_id);
      }
    })

}
