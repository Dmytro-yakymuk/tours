
(function (root, factory) {
    //@author http://ifandelse.com/its-not-hard-making-your-library-support-amd-and-commonjs/
    if (typeof module === "object" && module.exports) {
        module.exports = factory(require("jquery"));
    } else {
        factory(root.jQuery);
    }
}(this, function ($) {
    var Ssi_upload = function (element, options) {
        this.options = options;
        this.$element = '';
        this.language = locale[this.options.locale];
        this.uploadList = [];
        this.totalProgress = [];
        this.toUpload = [];
        this.imgNames = [];
        this.totalFilesLength = 0;
        this.successfulUpload = 0;
        this.pending = 0;
        this.inProgress = 0;
        this.currentListLength = 0;
        this.inputName = '';
        this.init(element);
        this.tour_id = 0;
    };
    Ssi_upload.prototype.init = function (element) {
        $(element).addClass('ssi-uploadInput')
            .after(this.$element = $('<div class="ssi-uploader">'));
        var $chooseBtn = $('' +
            '<span class="ssi-InputLabel">' +
            '<button class="ssi-button success">' + this.language.chooseFiles + '</button>' +
            '</span>').append(element);
        var $clearBtn = $('<button id="ssi-clearBtn" class="ssi-hidden ssi-button info" >' + this.language.clear +
            '</button>');
        this.$element.append($('<div class="ssi-buttonWrapper">').append($chooseBtn, $clearBtn));
        var $uploadBox;
        if (!this.options.preview) {
            this.$element.addClass('ssi-uploaderNP');
            var $fileList = $('<table id="ssi-fileList" class="ssi-fileList"></table>');
            var $namePreview = $('<span class="ssi-namePreview"></span>');
            var $mainBox = $('<div id="ssi-uploadFiles" class="ssi-tooltip ssi-uploadFiles ' + (this.options.dropZone ? 'ssi-dropZone' : '') + '"><div id="ssi-uploadProgressNoPreview" class="ssi-uploadProgressNoPreview"></div></div>')
                .append($namePreview);
            var $uploadDetails = $('<div class="ssi-uploadDetails"></div>').append($fileList);
            $uploadBox = $('<div class="ssi-uploadBoxWrapper ssi-uploadBox"></div>').append($mainBox, $uploadDetails);
            this.$element.prepend($uploadBox);
        } else {
            $uploadBox = $('<div id="ssi-previewBox" class="ssi-uploadBox ssi-previewBox ' + (this.options.dropZone ? 'ssi-dropZonePreview ssi-dropZone' : '') + '"><div id="ssi-info">' + (this.options.dropZone ? '<div id="ssi-DropZoneBack">' + this.language.drag + '</div>' : '') + '</div></div>');
            this.$element.append($uploadBox);
        }
        var thisS = this;
        var $input = $chooseBtn.find(".ssi-uploadInput");
        this.inputName = $input.attr('name') || 'files';
        $chooseBtn.find('button').click(function (e) {
            e.preventDefault();
            $input.trigger('click');
        });




        //upload_images
        // ===================================================================================================
        function upload_images(files) {
            $.each(files, function (key, value) {
                var data = new FormData();

                data.append('image', value);

                this.tour_id = $('input#tour_id').val();

                $.ajax({
                    url: "/api/upload/" + this.tour_id,
                    method: 'POST',
                    type: 'POST',
                    data: data,
                    async: false,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false
                }).done(function (result) {

                });

                var tour_id = $('#tour_id').val();
                $.ajax({
                    url: '/api/images/' + tour_id,
                    method: 'POST',
                    type: 'POST'
                }).done(function (result) {
                    $('#imageUpload').html(result);
                });
            });
        }
        // ===================================================================================================


        //choose files
        // ===================================================================================================
        $input.on('change', function () {
            thisS.toUploadFiles(this.files);

            upload_images(this.files);

            // if(!thisS.options.inForm){
            //     $input.val('');
            // }
        });

        // ===================================================================================================






        //drag n drop
        // ===================================================================================================
        if (thisS.options.dropZone) {
            $uploadBox.on("drop", function (e) {
                e.preventDefault();
                $uploadBox.removeClass("ssi-dragOver");
                var files = e.originalEvent.dataTransfer.files;
                thisS.toUploadFiles(files);

                upload_images(files);

            });
            $uploadBox.on("dragover", function (e) {
                e.preventDefault();
                $uploadBox.addClass("ssi-dragOver");
                return false;
            });
            $uploadBox.on("dragleave", function (e) {
                e.preventDefault();
                $uploadBox.removeClass("ssi-dragOver");
                return false;
            });
        }
        // ===================================================================================================


        if (!thisS.options.preview) {
            $mainBox.click(function () {
                if (thisS.currentListLength > 1)
                    $uploadDetails.toggleClass('ssi-uploadBoxOpened');
            })
        }

        $clearBtn.click(function (e) { //choose files completed and pending files
            e.preventDefault();
            thisS.clear();
        });

        $uploadBox.on('mouseenter', '.ssi-statusLabel', function (e) {
            var $eventTarget = $(e.currentTarget);
            var title = $eventTarget.attr('data-status');
            if (!title || title === '') {
                return;
            }
            tooltip($eventTarget, title, thisS);
        });









        $uploadBox.on('click', '.ssi-removeBtn', function (e) { //remove the file from list
            e.preventDefault();
            var $currentTarget = $(e.currentTarget);
            var index = $currentTarget.data('delete'); //get file's index
            thisS.pending--; //reduce pending number by 1
            thisS.currentListLength--; //reduce current list length by 1


            if (thisS.options.preview) { //if preview is true
                $currentTarget.parents('table.ssi-imgToUploadTable').remove(); //remove table
            } else {
                var target = $currentTarget.parents('tr.ssi-toUploadTr'); //find the tr of file
                $namePreview.html((thisS.currentListLength) + ' files'); //set the main name to the remaining files
                target.prev().remove();// remove empty tr (using id for margin between rows)
                target.remove();// remove the file
                if (thisS.currentListLength === 1) { //if only one file left in the list
                    setLastElementName(thisS); //set main preview to display the name
                }
            }
            thisS.toUpload[index] = null; //set the file's obj to null (we don't splice it because we need to keep the same indexes)
            thisS.imgNames[index] = null; //set the file's name to null

            if (thisS.currentListLength === 0) { // if no more files in the list
                if (!thisS.options.dropZone) { // if drag and drop is disabled
                    $uploadBox.removeClass('ssi-uploadNoDropZone');
                }
                $clearBtn.addClass('ssi-hidden');

            }
        });

        //----------------------------UPLOADFILES------------------------------------



    };
    function tooltip($target, text, thisS) {
        $target = $($target);
        text = text || $target.data('title');
        if (!text) text = $target.attr('title');
        if (!text) return;
        var $toolTip = $('<div class="ssi-fadeOut ssi-fade ssi-tooltipText">'
            + text +
            '</div>').appendTo(thisS.$element);
        $target.one('mouseleave', function () {
            $toolTip.remove();
        });
        var offset = -16;
        if ($target.hasClass('ssi-noPreviewSubMessage')) {
            offset = 23;
        }
        $toolTip.css({
            top: $target.position().top - $toolTip.height() + offset,
            left: $target.position().left - $toolTip.width() / 2
        })
            .removeClass('ssi-fadeOut');
        return $toolTip;
    }


    Ssi_upload.prototype.toUploadFiles = function (files) {
        if (typeof this.options.maxNumberOfFiles === 'number') {
            if ((this.inProgress + this.pending) >= this.options.maxNumberOfFiles) {// if in progress files + pending files are more than the number that we have define as max number of files pre download
                return;//don't do anything
            }
        }
        var thisS = this,
            j = 0,
            length,
            imgContent = '',
            $clearBtn = this.$element.find('#ssi-clearBtn'),
            $fileList = this.$element.find('#ssi-fileList'),
            $uploadBox = this.$element.find('.ssi-uploadBox'),
            imgs = [];
        if ((this.inProgress === 0 && this.pending === 0)) { //if no file are pending or are in progress
            this.clear(); //clear the list
        }
        var extErrors = [], sizeErrors = [], errorMessage = '';
        var toUploadLength, filesLength = length = toUploadLength = files.length;
        if (typeof this.options.maxNumberOfFiles === 'number') {//check if requested files agree with our arguments
            if (filesLength > this.options.maxNumberOfFiles - (this.inProgress + this.pending)) { //if requested files is more than we need
                filesLength = toUploadLength = this.options.maxNumberOfFiles - (this.inProgress + this.pending); // set variable to the number of files we need
            }
        }
        //
        for (var i = 0; i < filesLength; i++) {
            var file = files[i],
                ext = file.name.getExtension();// get file's extension

            if ($.inArray(ext, this.options.allowed) === -1) { // if requested file not allowed
                if (length > filesLength) {//there are more file we dont pick
                    filesLength++;//the add 1 more loop
                } else {
                    toUploadLength--;
                }
                if ($.inArray(ext, extErrors) === -1) {//if we see first time this extension
                    extErrors.push(ext); //push it to extErrors variable
                }
            } else if ((file.size * Math.pow(10, -6)).toFixed(2) > this.options.maxFileSize) {//if file size is more than we ask
                if (length > filesLength) {
                    filesLength++;
                } else {
                    toUploadLength--;
                }
                sizeErrors.push(cutFileName(file.name, ext, 15));//register a size error
            } else if ($.inArray(file.name, this.imgNames) === -1) {// if the file is not already in the list
                setupReader(file);
                this.pending++; // we have one more file that is pending to be uploaded
                this.currentListLength++;// we have one more file in the list
            } else {
                if (length > filesLength) {
                    filesLength++;
                } else {
                    toUploadLength--;
                }
            }
        }



        var extErrorsLength = extErrors.length, sizeErrorsLength = sizeErrors.length;
        if (extErrorsLength + sizeErrorsLength > 0) { // in the end expose all errors
            if (extErrorsLength > 0) {
                errorMessage = this.language.extError.replaceText(extErrors.toString().replace(/,/g, ', '));
            }
            if (sizeErrorsLength > 0) {
                errorMessage += this.language.sizeError.replaceText(sizeErrors.toString().replace(/,/g, ', '), this.options.maxFileSize + 'mb');
            }
            this.options.errorHandler.method(errorMessage, this.options.errorHandler.error);
        }
        function setupReader() {
            var index = thisS.imgNames.length;
            if (index === 0) {//do it only the first time
                if (thisS.options.preview) {
                    if (!thisS.options.dropZone) {
                        $uploadBox.addClass('ssi-uploadNoDropZone')
                    }
                }
                $clearBtn.removeClass('ssi-hidden');
            }
            $clearBtn.prop('disabled', true);
            thisS.toUpload[index] = file;
            var filename = file.name;
            var ext = filename.getExtension(); //get file's extension
            thisS.imgNames[index] = filename; //register file's name
            if (thisS.options.preview) {
                var getTemplate = function (content) {
                    return '<table class="ssi-imgToUploadTable ssi-pending">' +
                        '<tr><td class="ssi-upImgTd">' + content + '</td></tr>' +
                        '<tr><td><div id="ssi-uploadProgress' + index + '" class="ssi-hidden ssi-uploadProgress"></div></td></tr>' +
                        '<tr><td><button data-delete="' + index + '" class=" ssi-button error ssi-removeBtn"><span class="trash10 trash"></span></button></td></tr>' +
                        '<tr><td>' + cutFileName(filename, ext, 15) + '</td></tr></table>'
                };
                var fileType = file.type.split('/');
                if (fileType[0] == 'image') {
                    $clearBtn.prop("disabled", true);
                    var fileReader = new FileReader();
                    fileReader.onload = function () {
                        imgContent += getTemplate('<img class="ssi-imgToUpload" src=""/><i class="fa-spin fa fa-spinner fa-pulse"></i>'); // set the files element without the img
                        imgs[index] = fileReader.result;
                        j++;
                        if (toUploadLength === j) {// if all elements are in place lets load images

                            $uploadBox.append(imgContent);
                            setTimeout(function () {
                                setImg();//and load the images
                                $clearBtn.prop("disabled", false);
                            }, 10);
                            $clearBtn.prop("disabled", false);

                            imgContent = '';
                            toUploadLength = [];
                        } else if (toUploadLength / 2 == Math.round(j)) {
                            $uploadBox.append(imgContent);
                            setImg();//and load the images
                            imgContent = '';
                        }
                    };
                    fileReader.readAsDataURL(file);
                } else {
                    imgs[index] = null;
                    $uploadBox.append(getTemplate('<div class="document-item" href="test.mov" filetype="' + ext + '"><span class = "fileCorner"></span></div>'));
                    j++;
                }
            } else {
                $clearBtn.prop('disabled', false);
                thisS.$element.find('.ssi-namePreview').html((index === 0 ? cutFileName(filename, ext, 13) : (thisS.currentListLength + 1) + ' ' + thisS.language.files));//set name preview
                $fileList.append('<tr class="ssi-space"><td></td></tr>' +//append files element to dom
                    '<tr class="ssi-toUploadTr ssi-pending"><td><div id="ssi-uploadProgress' + index + '" class="ssi-hidden ssi-uploadProgress ssi-uploadProgressNoPre"></div>' +
                    '<span>' + cutFileName(filename, ext, 20) + '</span></td>' +
                    '<td><a data-delete="' + index + '" class="ssi-button ssi-removeBtn  ssi-removeBtnNP"><span class="trash7 trash"></span></a></td></tr>');
            }

            var setImg = function () {//load the images
                for (var i = 0; i < imgs.length; i++) {
                    if (imgs[i] !== null) {
                        $uploadBox.find("#ssi-uploadProgress" + i).parents('table.ssi-imgToUploadTable')
                            .find('.ssi-imgToUpload')
                            .attr('src', imgs[i]) //set src of the image
                            .next().remove();//remove the spinner
                        imgs[i] = null;
                    }
                }
                imgs = [];
            };
        }
    };
    var clearCompleted = function (thisS) {//clear all completed files
        var $completed = thisS.$element.find('.ssi-completed');
        thisS.successfulUpload = 0;
        if (!thisS.options.preview) $completed.prev('tr').remove();
        $completed.remove();
    };
    var clearPending = function (thisS) {//clear all pending files
        var $pending = thisS.$element.find('.ssi-pending');
        var length = thisS.imgNames.length;
        for (var i = 0; i < length; i++) {
            if (thisS.imgNames[i] === null) {
                thisS.toUpload.splice(i, 1);
                thisS.imgNames.splice(i, 1);
            }
        }
        thisS.toUpload.splice(-thisS.pending, thisS.pending);
        thisS.imgNames.splice(-thisS.pending, thisS.pending);
        thisS.pending = 0;
        if (!thisS.options.preview) $pending.prev('tr').remove();
        $pending.remove();
    };

    Ssi_upload.prototype.clear = function (action) {//clean the list of all non in progress files
        switch (action) {
            case 'pending':
                clearPending(this);
                break;
            case 'completed':
                clearCompleted(this);
                break;
            default:
                clearPending(this);
                clearCompleted(this);
        }
        $clearBtn = this.$element.find('#ssi-clearBtn');
        this.currentListLength = getCurrentListLength(this);
        if (this.inProgress === 0) { //if no file are uploading right now
            this.totalProgress = [];
        }
        if ((this.currentListLength === 0)) { // if no items in the list
            $clearBtn.addClass('ssi-hidden');
            this.totalFilesLength = 0;
            if (!this.options.dropZone) {
                this.$element.find('.ssi-uploadBox').removeClass('ssi-uploadNoDropZone')
            }
        }
        $clearBtn.prop('disabled', true);

        if (!this.options.preview) {
            setNamePreview(this);
        }
    };

    var setNamePreview = function (thisS) {//set the name preview according to the remaining elements in the list
        if (thisS.currentListLength > 1) {//if more than one element left
            thisS.$element.find('.ssi-namePreview').html(thisS.currentListLength + ' files'); // set the name preview to the length of the remaining items
        } else if (thisS.currentListLength === 1) {//if one left
            setLastElementName(thisS); // set the name of the element
        } else { //if no elements left
            thisS.$element.find('.ssi-uploadDetails').removeClass('ssi-uploadBoxOpened');
            thisS.$element.find('#ssi-fileList').empty();//empty list
            thisS.$element.find('.ssi-namePreview').empty();//empty the name preview
        }

    };







    var getCurrentListLength = function (thisS) { //get the list length
        return (thisS.inProgress + thisS.successfulUpload + thisS.pending);
    };
    var setLastElementName = function (thisS) { //if one file in list get the last file's name and put it to the name preview
        var fileName = thisS.$element.find('#ssi-fileList').find('span').html();//find the only span left
        var ext = fileName.getExtension();//get the extension
        thisS.$element.find('.ssi-uploadDetails').removeClass('ssi-uploadBoxOpened');
        thisS.$element.find('.ssi-namePreview').html(cutFileName(fileName, ext, 15));//short the name and put it to the name preview
    };


    $.fn.ssi_uploader = function (opts) {
        var defaults = {
            url: '',
            data: {},
            locale: 'en',
            preview: true,
            dropZone: true,
            maxNumberOfFiles: '',
            responseValidation: false,
            ignoreCallbackErrors: false,
            maxFileSize: 2,
            inForm: false,
            ajaxOptions: {},
            onUpload: function () {
            },
            onEachUpload: function () {
            },
            beforeUpload: function () {
            },
            beforeEachUpload: function () {
            },
            allowed: '',
            errorHandler: {
                method: function (msg) {
                    alert(msg);
                },
                success: 'success',
                error: 'error'
            }
        };
        var options = $.extend(true, defaults, opts);
        options.allowed = options.allowed || ['jpg', 'jpeg', 'png', 'bmp', 'gif'];
        return this.each(function () {
            var $element = $(this);
            if ($element.is('input[type="file"]')) {
                if ($element.data('ssi_upload')) return;
                var ssi_upload = new Ssi_upload(this, options);
                $element.data('ssi_upload', ssi_upload);
            } else {
                console.log('The targeted element is not file input.')
            }
        });
    };
    //functions
    String.prototype.replaceText = function () {//replace $ with variables
        var args = Array.apply(null, arguments);
        var text = this;
        for (var i = 0; i < args.length; i++) {
            text = text.replace('$' + (i + 1), args[i])
        }
        return text;
    };
    String.prototype.getExtension = function () {//returns the extension of a path or file
        return this.split('.').pop().toLowerCase();
    };
    var cutFileName = function (word, ext, maxLength) {//shorten the name
        if (typeof ext === 'undefined') ext = '';
        if (typeof maxLength === 'undefined') maxLength = 10;
        var min = 4;
        if (maxLength < min) return;
        var extLength = ext.length;
        var wordLength = word.length;
        if ((wordLength - 2) > maxLength) {
            word = word.substring(0, maxLength);
            var wl = word.length - extLength;
            word = word.substring(0, wl);
            return word + '...' + ext;
        } else return word;
    };



    var locale = {
        en: {
            success: 'Success',
            sucUpload: 'Successful upload',
            chooseFiles: 'Choose files',
            uploadFailed: 'Upload failed',
            serverError: 'Internal server error',
            error: 'Error',
            files: 'files',
            upload: 'Upload',
            clear: 'Clear',
            drag: 'Drag n Drop',
            sizeError: '$1 exceed the size limit of $2',// $1=file name ,$2=max ie( example.jpg has has exceed the size limit of 2mb)
            extError: '$1 file types are not supported',//$1=file extension ie(exe files are not supported)
            someErrorsOccurred: 'Some errors occurred!',
            wentWrong: 'Something went wrong!',
            pending: 'Pending',
            completed: 'Completed',
            inProgress: 'In progress'
        }
    };

}));