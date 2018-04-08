<script>

  function js_updatedimage($image_num) {
    $id_name = '#js_updatedImage' + $image_num;

    $($id_name).attr('value', '1');

  }



  $(function(){

    $(document).on('change', '.js_btn_file', function(e){
      var $fileNum = $(this).attr('data-file-btn');
        $file = e.target.files[0],
        $reader = new FileReader(),
        $preview = $('.js_form_image_preview' + $fileNum);

      if($file.type.indexOf('image') < 0){
        return false;
      }

      $reader.onload = (function($file){
        return function(e){
          $preview.attr('src', e.target.result);
          $(this).val($file['name']);

          $fileSize01 = $file['size'];
          $fileType01 = $file['type'];
        };
      })($file);
      $reader.readAsDataURL($file);

      if($(this).hasClass('js_edit')) {
        js_updatedimage($fileNum);
      }
    });



  });

  $(document).on('click', '.js_btn_delete', function(){
    var $deleteNum = $(this).attr('data-delete-btn');
    $('.js_form_image_preview' + $deleteNum).attr('src', '');

    var $beforeId = '#js_before_image' + $deleteNum;
        $addText = '<input id="js_image'+ $deleteNum + '" class="image_button js_btn_file" data-file-btn="' + $deleteNum + '" accept="image/*" name="image' + $deleteNum + '" type="file">';

    console.log($addText);
    $("#js_image"+$deleteNum).remove();
    $($beforeId)
        .after($addText);
  });


  //   function deleteImageAjax($article_id,$image_num) {

  //   $url = '/articles/deleteImage/'+ $article_id + '/' + $image_num;
  //   console.log($url );
  //   $.ajaxSetup({
  //       headers: {
  //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       }
  //   });
  //   $.ajax({
  //       type: "POST",
  //       url : $url,
  //       contentType: 'application/json',
  //       dataType: 'json'
  //     })
  //     .done((data, textStatus, jqXHR) => {

  //         console.log('done');
  //         console.log(data);
  //         console.log(textStatus);

  //     })
  //     .fail((jqXHR, textStatus, errorThrown) => {
  //         console.log('fail', jqXHR.status);
  //         console.log(jqXHR);
  //         console.log(textStatus);
  //                   console.log(errorThrown);
  //         var res = $.parseJSON(jqXHR.responseText);
  //         console.log(res.code,res.message);
  //         console.log(res.message);

  //         alert('できなかった');
  //     });

  // }

</script>