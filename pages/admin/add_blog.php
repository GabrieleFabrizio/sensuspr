<div class="container">
    <h3 class="dmn__blog__newmodify__title">Add new BLOG POST:</h3>
    <form name="form_insertBlog" id="form_insertBlog" method="post" enctype="multipart/form-data" action="javascript:fInsertBlog()">
        <input type="hidden" id="IDblog" name="IDblog" value="<?=$infoData->SingleBlog["ID"]?>" />
        <div id="box_corpo">
            <!----------------------- TITOLO -------------------->
            <div class="form-group">
                <div class="dmn__blog__newmodify__cont">
                    <div class="dmn__blog__newmodify__cont__left">
                        <label for="CATEGORY" class="form-control-label">Post Status*</label>
                        <select id="CATEGORY" name="CATEGORY" class="form-control">
                            <option value="1">ONLINE</option>
                            <option value="-1">DRAFT</option>
                        </select>
                        <label for="RELPOSTS" class="form-control-label">Related Posts (id of posts comma separated)</label>
                        <textarea type="text" class="form-control" id="RELPOSTS" name="RELPOSTS" placeholder="Related posts" rows="1"></textarea>   
                    </div>
                    <div class="dmn__blog__newmodify__cont__right2">
                        <label for="POSTCATEG1" class="form-control-label">Select the Blogpost Categories*</label>
                        <select id="POSTCATEG1" class="form-control" name="POSTCATEG1">
                            <option value="0"></option>
                            <?php  foreach ($Blog->blogCateg  as $row) {?>
                            <option value="<?=$row['ID']?>"><?=$row['NAME']?> -> <?=$row['DESCR']?></option>
                            <?php }?>
                        </select>
                        <select id="POSTCATEG2" class="form-control" name="POSTCATEG2">
                            <option value="0"></option>
                            <?php  foreach ($Blog->blogCateg  as $row) {?>
                            <option value="<?=$row['ID']?>"><?=$row['NAME']?> -> <?=$row['DESCR']?></option>
                            <?php }?>
                        </select>
                        <select id="POSTCATEG3" class="form-control" name="POSTCATEG3">
                            <option value="0"></option>
                            <?php  foreach ($Blog->blogCateg  as $row) {?>
                            <option value="<?=$row['ID']?>"><?=$row['NAME']?> -> <?=$row['DESCR']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="dmn__blog__newmodify__cont">
                    <div class="dmn__blog__newmodify__cont__left">
                        <label for="TITLE" class="form-control-label">Title* (50 to 60 chars) <span id="titleTextCheck"></span></label>
                        <textarea type="text" rows="2" class="form-control" data-provide="markdown"
                         id="TITLE" name="TITLE" placeholder="TITLE" maxlength="100" 
                         oninput="checkMetadataLenght(this,'titleTextCheck',50,60)"
                         onchange="SetFilename()" 
                         required></textarea>
                    </div>
                    <div class="dmn__blog__newmodify__cont__right2">
                        <label for="SUBTITLE" class="form-control-label">Sub title*</label>
                        <textarea type="text" rows="2" class="form-control" data-provide="markdown" id="SUBTITLE" name="SUBTITLE" placeholder="SUBTITLE" maxlength="300" required></textarea>
                    </div>
                </div>
                <div class="dmn__blog__newmodify__cont">
                    <div class="dmn__blog__newmodify__cont__left">
                        <label for="KEYWORDS" class="form-control-label">Keywords*(separated by ; )</label> 
                        <textarea type="text" rows="3" class="form-control" data-provide="markdown" id="KEYWORDS" name="KEYWORDS" placeholder="KEYWORDS" maxlength="300" required></textarea>
                    </div>
                    <div class="dmn__blog__newmodify__cont__right2">
                        <label for="METADESCR" class="form-control-label">Meta Description* (Between 110 and 160 char. is best, max. 250)<span id="metaTextCheck"></span></label>
                        <textarea type="text" rows="3" class="form-control" data-provide="markdown" 
                        id="METADESCR" name="METADESCR" placeholder="META DESCRIPTION" maxlength="250" 
                        oninput="checkMetadataLenght(this,'metaTextCheck',110,160)"
                        required></textarea>
                    </div>
                </div>
                <div class="dmn__blog__newmodify__cont">
                    <div class="dmn__blog__newmodify__cont__left">
                        <label for="AUTHOR" class="form-control-label">Author* (Max. 100 Chars)</label>
                        <textarea type="text" rows="1" class="form-control" data-provide="markdown" id="AUTHOR" name="AUTHOR" placeholder="Author" maxlength="100" required></textarea>
                    </div>
                    <div class="dmn__blog__newmodify__cont__right2">
                        <label for="FILENAME" class="form-control-label">Filename*</label>
                        <textarea type="text" rows="1" class="form-control" data-provide="markdown" id="FILENAME" name="FILENAME" placeholder="FILENAME" maxlength="100" required></textarea>
                    </div>
                </div>
                <h3 class="dmn__blog__newmodify__subtitle">Blogpost content</h3>
                <textarea type="text" rows="25" class="form-control TEXT" data-provide="markdown" id="TEXT" name="TEXT" placeholder="TEXT" required></textarea>
                <br/>
                <div class="dmn__blog__newmodify__cont">
                    <div class="dmn__blog__newmodify__cont__left2">
                        <br/>
                        <label for="LINKIMAGE" class="form-control-label">Optional: custom image<br/>(get the filename.ext from the library below, don't use the full link as for the text window)</label>
                        <textarea type="text" rows="1" class="form-control" data-provide="markdown" id="LINKIMAGE" name="LINKIMAGE" placeholder="LINKIMAGE" maxlength="100"></textarea>
                    </div>
                    <div class="dmn__blog__newmodify__cont__right dmn__blog__newmodify__cont__low-right">
                        <button type="submit" class="btn btn-info dmn__blog__newmodify__cont__submitbtn pointer" id="buttonUpdate">Create Blog Post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- GALLERY LIBRARY -->
    <div id="GalleryLibrary"></div>
    <!-- END GALLERY BLOG LIBRARY-->
</div>


<script>
    function SetFilename() {
        if ($("#FILENAME").val() == '') {
            var outString = $("#TITLE").val().replace(/[`~!@#$%^&*()_| +\-=?;:'",.<>\{\}\[\]\\\/]/gi, '-');
            //  outString =outString.replace(, '');
            $("#FILENAME").val(outString + ".html");
        }
    }

</script>
<script>
    $(document).ready(function() {

        var params = {
            page: "admin",
            step: "BlogImageGallery",
            PAGENUMBER: "1"
        };
        ajaxCall("GalleryLibrary", params);


        if (window.File && window.FileReader && window.FileList && window.Blob) {
            // Great success! All the File APIs are supported.
        } else {
            alert('The File APIs are not fully supported in this browser.');
        }



        CKEDITOR.replace('TEXT', {
            language: 'en',
            uiColor: '#9AB8F3',
            toolbarGroups: [{
                    name: 'clipboard',
                    groups: ['clipboard', 'undo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker']
                },
                {
                    name: 'links'
                },
                {
                    name: 'insert'
                },
                {
                    name: 'tools'
                },
                {
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                },

                {
                    name: 'others'
                },
                '/',
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align']
                },
                {
                    name: 'styles'
                },
                {
                    name: 'colors'
                }
            ],
            toolbarCanCollapse: true,
            toolbarStartupExpanded: true,
            height: '600px'
        });
    });

</script>

<script>
    function handleFileSelectBrowse(evt) {
        var files = evt.target.files; // FileList object

        // files is a FileList of File objects. List some properties.
        var output = [];
        for (var i = 0, f; f = files[i]; i++) {
            output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ', f.size, ' bytes, last modified: ', f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a', '</li>');
            $("#FILENAME").val(escape(f.name));

            var start = 0;
            var stop = f.size - 1;

            var reader = new FileReader();

            // If we use onloadend, we need to check the readyState.
            reader.onloadend = function(evt) {
                if (evt.target.readyState == FileReader.DONE) { // DONE == 2
                    CKEDITOR.instances.TEXT.setData(evt.target.result);
                    // alert(evt.target.result);
                }
            };
            var blob = f.slice(start, stop + 1);
            reader.readAsBinaryString(blob);
        }
        document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
    }

</script>


<script>
    function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        var files = evt.dataTransfer.files; // FileList object.

        // files is a FileList of File objects. List some properties.
        var output = [];
        for (var i = 0, f; f = files[i]; i++) {


            output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                f.size, ' bytes, last modified: ',
                f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                '</li>');
            $("#FILENAME").val(escape(f.name));

            var start = 0;
            var stop = f.size - 1;

            var reader = new FileReader();

            // If we use onloadend, we need to check the readyState.
            reader.onloadend = function(evt) {
                if (evt.target.readyState == FileReader.DONE) { // DONE == 2
                    CKEDITOR.instances.TEXT.setData(evt.target.result);
                    //alert(evt.target.result)
                }
            };
            var blob = f.slice(start, stop + 1);
            reader.readAsBinaryString(blob);
        }


        document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
    }

    function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
    }

</script>
