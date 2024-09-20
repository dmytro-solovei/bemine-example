getLanguageInputs()

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); // Gallery Section

$(document).on('click', '.remove-btn', function (e) {
    var _this = this;

    var image = $(_this).data('image');
    var $confirm = confirm('Are you sure ?');

    if ($confirm) {
        $.ajax({
            url: "/dsfgsfghzxdfgzdfhzdgv/product/gallery/photo",
            type: "post",
            data: {
                image: image
            },
            success: function success(response) {
                let elem = $(_this).parent().closest('.existing-gallery-block')

                if (elem.find('.gallery-items > div').length > 1) {
                    $(_this).parent().closest('.form-group').remove()
                } else {
                    elem.remove()
                }
            },
            error: function error(_error) {
                console.log(_error);
            }
        });
    }
}); // $('.galleryImageDelete').click(function () {
//     let $ids = [];
//     let $block = $(this).parent().parent();
//     $block.find('img').each(function (index, img) {
//         $ids.push($(img).data('image-id'))
//     });
//
//     let $form = $('#galleryImageDeleteModal');
//     $form.find('#deletingGalleryIds').val($ids)
//     $form.modal();
// })
// function deleteProductGallery() {
//     let ids = $('#deletingGalleryIds').val();
//     let $productId = $('#productId').val();
//     let $galleryBlock = $(".gallery-image-block");
//     let galleryImageDeleteModal = $('#galleryImageDeleteModal');
//
//     $.ajax({
//         url: "/dsfgsfghzxdfgzdfhzdgv/product/gallery",
//         type: "post",
//         data: {
//             ids: ids,
//             productId: $productId,
//         },
//         success: function (response) {
//             $galleryBlock.find(`[data-image-id='${response.data[0]}']`).parent().parent().parent().parent().hide();
//         },
//         error: function (error) {
//             console.log(error);
//         },
//         complete: function () {
//             galleryImageDeleteModal.modal('hide')
//         }
//     });
// }
// End Of Gallery Section

$('#delete,#inactive,#activate,.delete').click(function () {
    var $confirm = confirm('Are you sure ?');

    if ($confirm) {
        $(this).parent().submit();
    }
});

var existingGalleryBlock = $('.existing-gallery-block').length;
var galleryCount = existingGalleryBlock ? existingGalleryBlock : 1;
var sizeCount = 0;

$(document).on('click','#add_gallery', function () {
    let _this = this

    let allElements = $(_this).parent().closest('.product-gallery').find('#gallery_block .gallery-block-row')
    let lastBlockCount = Number(allElements.last().attr('data-gallery-block-count'))

    if (!allElements.length) {
        lastBlockCount = 0
    }
    var galleryBlock = $('#gallery_block');

    lastBlockCount++;
    $.ajax({
        url: "/dsfgsfghzxdfgzdfhzdgv/product/add-gallery/block/" + lastBlockCount + '/' + sizeCount,
        type: "post",
        data: {},
        success: function success(response) {
            galleryBlock.append(response.body);
        },
        error: function error(_error2) {
            console.log(_error2);
        }
    });
});
$(document).on('click', '#add_additional', function () {
    var additionalBlock = $('#additional_block');
    $.ajax({
        url: "/dsfgsfghzxdfgzdfhzdgv/product/add-additional/block",
        type: "post",
        data: {},
        success: function success(response) {
            additionalBlock.append(response.body);
        },
        error: function error(_error3) {
            console.log(_error3);
        }
    });
});
var informationBlockCount = (_$$length = $('.information_blocks').length) !== null && _$$length !== void 0 ? _$$length : 1;
$(document).on('click', '#add_information', function () {
    var informationBlock = $('#information_block');
    informationBlockCount++;
    $.ajax({
        url: "/dsfgsfghzxdfgzdfhzdgv/product/add-information/block/" + informationBlockCount,
        type: "post",
        data: {},
        success: function success(response) {
            informationBlock.append(response.body);
        },
        error: function error(_error4) {
            console.log(_error4);
        }
    });
});
$(document).on('click', '.add_color_size', function () {
    var addButtonParent = $(this).parents().eq(2);
    var galleryBlockCount = $(this).parents().eq(3).data('gallery-block-count');
    var blockSizeColorCount = $(this).data('size-block-count');
    blockSizeColorCount++;
    $.ajax({
        url: "/dsfgsfghzxdfgzdfhzdgv/product/add-color-size/block/" + galleryBlockCount + '/' + blockSizeColorCount,
        type: "post",
        data: {},
        success: function success(response) {
            addButtonParent.append(response.body);
            galleryBlockCount++;
        },
        error: function error(_error5) {
            console.log(_error5);
        }
    });
});

function initDateTimePicker() {
    var dateTimePicker = $('.datetimepicker');

    if (!dateTimePicker.length) {
        return;
    }

    dateTimePicker.datetimepicker({
        format: 'd/m/Y H:i'
    });
}

var dealDayCount = 0;
$('#add-deal-day').click(function () {
    var dealDaysBlock = $('#deal-days');
    dealDayCount++;
    $.ajax({
        url: "/dsfgsfghzxdfgzdfhzdgv/deal-day/add-block/" + dealDayCount,
        type: "post",
        data: {},
        success: function success(response) {
            dealDaysBlock.append(response.body);
            initDateTimePicker();
        },
        error: function error(_error6) {
            console.log(_error6);
        }
    });
});
$(document).ready(function () {
    $('.multiple-select').select2(); //todo

    $('.select2').select2(); //todo

    initDateTimePicker(); // let $modalDeleteButton = document.getElementById("modalDeleteButton");
    // if ($modalDeleteButton) {
    //     $modalDeleteButton.addEventListener("click", function () {
    //         deleteProductGallery()
    //     }, false);
    // }

    $(document).on('change', '.gallery_image', function () {
        for (i = 0; i < this.files.length; i++) {
            var src = URL.createObjectURL(this.files[i]);

            var imgPreview = $(this).parent().closest('.gallery-block-row').find('.avatar_preview')
            $(imgPreview).append('<img height="80" style="margin: 5px" src=' + src + '>');
        }
    });
    $('.popular-by-filter').change(function () {
        var id = $(this).attr('id');
        $('#filter_popular_by').val(id);
    });
    $(document).on('click', '.delete-additional,.delete-information', function () {
        var $confirm = confirm('Are you sure ?');

        if (!$confirm) {
            return false;
        }

        $(this).parent().remove();
    });
    $(document).on('change', '.order-status', function () {
        $(this).parent().submit();
    });
});
$(document).on('change', '.order-status', function () {
    $(this).parent().submit();
});
$(document).on('click', '.remove-item', function (e) {
    if (confirm('Are you sure you want to delete this item')) {
        $(e.currentTarget).parent('form').submit();
    }
});

$(document).on('click', '.open-edit-form', function (e) {
    let $this = $(this);
    let id = $this.attr('data-id');
    let $createBlockForm = $(`.create-block[data-id=${id}] .create-block-content form`);
    let $createBlock = $(`.create-block[data-id=${id}] .create-block-content .edit-form`);

    if ($createBlock.css('display') === 'none') {
        $createBlock.css('display', 'block');
    }

    $.ajax({
        url: `/dsfgsfghzxdfgzdfhzdgv/section/add/edit/block/${id}`,
        type: 'POST',
        data: {},
        success: function (response) {
            $createBlock.html(response.body);
            $createBlockForm.css('display', 'none');
        },
        error: function (error) {
            console.error(error);
        }
    });
});


$(document).on('click', '.update-item', (e) => {
    const $contentEditable = $(e.currentTarget).closest('[contenteditable]');
    const id = $contentEditable.attr('data-id');

    const transformedObject = $contentEditable.find('input').toArray().reduce((acc, input) => {
        acc[input.name] = input.value;
        return acc;
    }, {});

    $.ajax({
        type: "PUT",
        url: `/dsfgsfghzxdfgzdfhzdgv/section/${id}`,
        data: transformedObject,
        dataType: "json",
        success: function (response) {
            location.reload();
        }
    });
});


function getLanguageInputs() {
    $.ajax({
        url: "/dsfgsfghzxdfgzdfhzdgv/section/add/create/block",
        method: "POST",
        success: function(response) {
            const appendElements = document.querySelectorAll('.append-input');
            appendElements.forEach(element => {
                element.innerHTML = response.body;
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}


$(document).on('click', '.collapsed-content', function() {
    $('.edit-form').hide();
    $('form').show();
});

