$(document).ready(function() {

    var ModxImage = function (context) {
        var ui = $.summernote.ui;
        var ilnag = context.options.lang;
        // create button
        var button = ui.button({
            contents: '<i class="note-icon-picture"/> ',
            container: false,
            tooltip: $.summernote.lang[ilnag].image.image,
            click: function () {
                if (Ext.isEmpty(this.browser)) {
                    this.browser = MODx.load({
                        xtype: 'modx-browser'
                        ,returnEl: null
                        ,id: 'MODX-image-browser'
                        ,multiple: false
                        ,config: MODx.config
                        ,source: MODx.config.default_media_source || MODx.source
                        ,allowedFileTypes: 'gif,jpg,jpeg,png'
                        ,listeners: {
                            'select': {fn: function(data) {
                                    var  filename= data.name;
                                    var url = data.fullRelativeUrl;
                                    context.invoke('editor.insertImage',  url, filename);
                                },scope:this}
                        }
                    });
                }
                this.browser.show();
                return true;
            }
        });

        return button.render();   // return button as jquery object
    }
    function sendFile(file, sm) {
        var form_data = new FormData();
        form_data.append('file', file);
        form_data.append('HTTP_MODAUTH', MODx.siteId);
        form_data.append('action', 'mgr/item/upload');
        var oReq = new XMLHttpRequest();
        oReq.open("POST", Summernote.connectorUrl, true);
        oReq.onload = function() {
            if (oReq.status == 200) {
                var res = JSON.parse(oReq.responseText);
                if(res.success === true){
                    sm.summernote('editor.insertImage', res.message.file);
                } else {
                    Ext.MessageBox.alert(res.message.title,res.message.message);
                }
            } else {
            }
        };

        oReq.send(form_data);
    }
    function init_summer(el){
        el.summernote({
            lang: "ru-RU" ,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'modximage' ,'video','hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            height: 300,
            width: '100%',
            buttons: {
                'modximage': ModxImage
            },

            callbacks: {
                onImageUpload : function(files, editor, welEditable) {

                    for(var i = files.length - 1; i >= 0; i--) {
                        sendFile(files[i], el);
                    }
                }
            }
        });
    }
    $('.modx-richtext,#ta').each(function () {
        init_summer($(this));
    })

});