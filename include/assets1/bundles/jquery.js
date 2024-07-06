
    function showPreview(event,nid){
      // console.log(event,nid);
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      // console.log(src);
        // console.log('file-ip-'+nid+'-preview');
      var preview = document.getElementById('file-ip-'+nid+'-preview');
      preview.src = src;
      preview.style.display = "block";
    }
  }
                   