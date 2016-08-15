function showPreloader(){
    $('#preloader').show();
}

function hidePreloader(){
    $('#preloader').hide();
}

function showError(error){
    $('#picture').parent().addClass('hasError').find('.hint-block').text(error);
}

function hideError(){
    $('#picture').parent().removeClass('hasError').find('.hint-block').text('');
}
function clear(){
    $('#picture').val('');
    $('#description').val('');
    $('#picture-preview').find('img').remove();
}
function showPreview(obj){
    var pictureUrl = obj.storageUrl+obj.path;
    $('#picture-preview').append('<img src="'+pictureUrl+'" data-path="'+obj.path+'">');
}

function uploadPicture(){
    showPreloader();
    var file = this.files[0];
    var form = new FormData();
    form.append($(this).attr('name'), file);

    $.ajax({
        url: uploadUrl,
        type: 'POST',
        contentType: false,
        processData: false,
        data: form,
        success: function(response){
            var result = JSON.parse(response);
            hidePreloader();
            if(result.error){
                showError(result.error, 'Ошибка загрузки файла');

            }else{
                hideError();
                showPreview(result);
            }
        }
    });
}

function removePicture(){
    showPreloader();
    var path = $('#picture-preview img').data('path');
    $.ajax({
        url: removeUrl,
        type: 'POST',
        data: 'path='+path,
        success: function(response){
            hidePreloader();
            if(!response){
                showError('Не удалось удалить изображение');
            }else{
                hideError();
                clear();
            }
        }
    });

}

function addToGallery(){
    var picture = $('#picture-preview img');
    var pictureUrl = picture.attr('src');
    var picturePath = picture.data('path');
    var descr = $('#description').val();
    var countPictures = $('#gallery').find('.gallery-item').length;
    var el = '<div class="gallery-item"><div class="actions"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></div><div class="picture"><img src="'+pictureUrl+'"><input type="hidden" name="GalleryModel[galleryItems]['+countPictures+'][picture]" value="'+picturePath+'"></div><textarea name="GalleryModel[galleryItems]['+countPictures+'][description]">'+descr+'</textarea></div>';
    clear();
    $('#gallery').append(el);
}


$('#picture').change(uploadPicture);
$('#removePicture').click(removePicture);
$('#addToGallery').click(addToGallery);
