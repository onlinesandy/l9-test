<div class="chatImgCard">
    <div class="card mb-0">
        <div class="card-body py-3">

            <div class="replymessage-block mb-0 d-flex align-items-start">

                <div class="flex-grow-1">
                    <div class="col imgPreviewHolder" id="imgPreviewHolder">
                        <img id="imgPreview" src="#" alt="pic" class="d-none chat-img" />
                    </div>
                    <div id="progressbar" class="mt-2 d-none"><span id="progressbar_span" class="bg-primary"></span></div>
                </div>
                <div class="flex-shrink-0">
                    <button type="button" id="close_toggle_chat_img" class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                        <i class="bx bx-x align-middle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    #progressbar {
        width: 100%;
        background-color: #ddd;
        clear: both;
    }

    #progressbar span {
        width: 0%;
        height: 5px;
        display: block;
    }

    .imgPreviewHolder {
        height: 100px;
        width: 100px;
    }

    .imgPreviewHolder img {
        max-width: 100px;
        max-height: 100px;
        min-width: 100px;
        min-height: 100px;

    }

    .imgPreviewHolder input[type="file"] {
        margin-top: 5px;
    }

    .imgPreviewHolder .heading {
        font-family: Montserrat;
        font-size: 45px;
        color: green;
    }
    .chat-img{
        height: 100px;
        width: 100px;
    }
</style>
