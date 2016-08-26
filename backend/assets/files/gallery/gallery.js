var fileInput = $('#gallery-fileInput');
var preloader = $('#gallery-preloader');
var gallery = $('#gallery');
var messageBox = $('#gallery-message');

var messages = {
    error: '<div class="fmw-message alert alert-danger"></div>',
    success: '<div class="fmw-message alert alert-success"></div>'
};

function uploadHandler(){
    fileInput.fileUpload({uploadUrl: gallerySetting.uploadUrl})
        .on('uploadFile:start', function(){
            preloader.fadeIn(300);
            $(this).attr('disabled', 'disabled');
        })
        .on('uploadFile:end', function(e, response){
            preloader.fadeOut(300);
            $(this).removeAttr('disabled');
            $(this).val('');
            try {
                response = JSON.parse(response);
                if (response.error) {
                    messageBox.find('.alert').remove();
                    messageBox.append($(messages.error).text(response.error));
                } else {
                    messageBox.find('.alert').remove();
                    var c = $('.gallery-item').length;
                    var item = $('<div class="gallery-item col-lg-3"><div class="panel panel-success"><div class="panel-body"><button class="btn btn-sm btn-danger pull-right removeBtn" data-path="' + response.file.path + '"><span class="glyphicon glyphicon-remove"></span></button><img src="' + response.file.url + response.file.path + '" class="img-responsive img-thumbnail"></div><div class="panel-footer"><textarea class="form-control" name="Gallery[items]['+c+'][GalleryItem][description]"></textarea><input type="hidden" name="Gallery[items]['+c+'][GalleryItem][picture]" value="'+response.file.path+'"></div></div></div>');
                    gallery.append(item);
                    removeHandler();
                    replaceHandler();
                }
            } catch (e) {
                var text = '<strong>Ошибка парсинга....</strong>';
                messageBox.append($(messages.error).text(text));
            }
        });
}

function removeHandler(){
    $('.removeBtn').removeFile({removeUrl: gallerySetting.removeUrl})
        .on('removeFile:start', function(){
            preloader.fadeIn(300);
            $(this).attr('disabled', 'disabled');
        })
        .on('removeFile:end', function(e, response){
            preloader.fadeOut(300);
            fileInput.removeAttr('disabled');
            messageBox.find('.alert').remove();
            try {
                response = JSON.parse(response);
                if (response.error) {
                    messageBox.append($(messages.error).text(response.error));
                } else {
                    messageBox.append($(messages.success).text(response.success));
                    $(this).parents('.gallery-item').remove();
                    $(this).parents('.gallery-notsaved-item').remove();
                    if ($('.gallery-notsaved-item').length == 0) {
                        $('#notSaved').remove();
                    }
                }
            } catch (e) {
                var text = '<strong>Ошибка парсинга....</strong>';
                messageBox.append($(messages.error).text(text));
            }
        });
}

function replaceHandler(){
    $('.replaceBtn').on('click', function () {
        messageBox.find('.alert').remove();
        var el = $(this).parents('.gallery-notsaved-item');
        var c = $('.gallery-item').length;
        var item = $('<div class="gallery-item col-lg-3"><div class="panel panel-success"><div class="panel-body"><button class="btn btn-sm btn-danger pull-right removeBtn" data-path="' + $(this).data('path') + '"><span class="glyphicon glyphicon-remove"></span></button><img src="' +el.find('img').attr('src') + '" class="img-responsive img-thumbnail"></div><div class="panel-footer"><textarea class="form-control" name="Gallery[items]['+c+'][GalleryItem][description]"></textarea><input type="hidden" name="Gallery[items]['+c+'][GalleryItem][picture]" value="'+$(this).data('path')+'"></div></div></div>');
        gallery.append(item);
        removeHandler();
        if ($('.gallery-notsaved-item').length == 0) {
            $('#notSaved').remove();
        }
    })
}
