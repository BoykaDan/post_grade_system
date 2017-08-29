<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="title" class="col-md-2 control-label">
                标题
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" autofocus
                       id="title" value="{{ $title }}">
            </div>
        </div>
        <div class="form-group">
            <label for="subtitle" class="col-md-2 control-label">
                副标题
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="subtitle"
                       id="subtitle" value="{{ $subtitle }}">
            </div>
        </div>
        <div class="form-group">
            <label for="page_image" class="col-md-2 control-label">
                页面图片检索
            </label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="page_image"
                               id="page_image" onchange="handle_image_change()"
                               alt="Image thumbnail" value="{{ $page_image }}">
                    </div>
                    <script>
                        function handle_image_change() {
                            $("#page-image-preview").attr("src", function () {
                                var value = $("#page_image").val();
                                if ( ! value) {
                                    value = {!! json_encode(config('blog.page_image')) !!};
                                    if (value == null) {
                                        value = '';
                                    }
                                }
                                if (value.substr(0, 4) != 'http' &&
                                    value.substr(0, 1) != '/') {
                                    value = {!! json_encode(config('blog.uploads.webpath')) !!}
                                            + '/' + value;
                                }
                                return value;
                            });
                        }
                    </script>
                    <div class="visible-sm space-10"></div>
                    <div class="col-md-4 text-right">
                        <img src="{{ page_image($page_image) }}" class="img img_responsive"
                             id="page-image-preview" style="max-height:40px">
                    </div>
                </div>
            </div>
        </div>

        <div >


            <!-- 加载编辑器的容器 -->
            <script id="container" name="content" type="text/plain">
                {!! $content !!}
            </script>

            @include('UEditor::head')





                <div id="btns">
                    <div>
                    <button onclick="getAllHtml()">获得整个html的内容</button>
                    <button onclick="getContent()">获得内容</button>
                    <button onclick="setContent()">写入内容</button>
                    <button onclick="setContent(true)">追加内容</button>
                    <button onclick="getContentTxt()">获得纯文本</button>
                    <button onclick="getPlainTxt()">获得带格式的纯文本</button>
                    <button onclick="hasContent()">判断是否有内容</button>
                    <button onclick="setFocus()">使编辑器获得焦点</button>
                    <button onmousedown="isFocus(event)">编辑器是否获得焦点</button>
                    <button onmousedown="setblur(event)" >编辑器失去焦点</button>

                    </div>
                    <div>
                    <button onclick="getText()">获得当前选中的文本</button>
                    <button onclick="insertHtml()">插入给定的内容</button>
                    <button id="enable" onclick="setEnabled()">可以编辑</button>
                    <button onclick="setDisabled()">不可编辑</button>
                    <button onclick=" UE.getEditor('container').setHide()">隐藏编辑器</button>
                    <button onclick=" UE.getEditor('container').setShow()">显示编辑器</button>
                    <button onclick=" UE.getEditor('container').setHeight(300)">设置高度为300默认关闭了自动长高</button>
                    </div>

                    <div>
                    <button onclick="getLocalData()" >获取草稿箱内容</button>
                    <button onclick="clearLocalData()" >清空草稿箱</button>
                    </div>

                    </div>
                    <div>
                    <button onclick="createEditor()">
                    创建编辑器</button>
                    <button onclick="deleteEditor()">
                    删除编辑器</button>
                    </div>

                    <script type="text/javascript">

                //实例化编辑器
                //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('container)就能拿到相关的实例
                var ue = UE.getEditor('container');


                function isFocus(e){
                    alert(UE.getEditor('container').isFocus());
                    UE.dom.domUtils.preventDefault(e)
                }
                function setblur(e){
                    UE.getEditor('container').blur();
                    UE.dom.domUtils.preventDefault(e)
                }
                function insertHtml() {
                    var value = prompt('插入html代码', '');
                    UE.getEditor('container').execCommand('insertHtml', value)
                }
                function createEditor() {
                    enableBtn();
                    UE.getEditor('container');
                }
                function getAllHtml() {
                    alert(UE.getEditor('container').getAllHtml())
                }
                function getContent() {
                    var arr = [];
                    arr.push("使用editor.getContent()方法可以获得编辑器的内容");
                    arr.push("内容为：");
                    arr.push(UE.getEditor('container').getContent());
                    alert(arr.join("\n"));
                }
                function getPlainTxt() {
                    var arr = [];
                    arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
                    arr.push("内容为：");
                    arr.push(UE.getEditor('container').getPlainTxt());
                    alert(arr.join('\n'))
                }
                function setContent(isAppendTo) {
                    var arr = [];
                    arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
                    UE.getEditor('container').setContent('欢迎使用ueditor', isAppendTo);
                    alert(arr.join("\n"));
                }
                function setDisabled() {
                    UE.getEditor('container').setDisabled('fullscreen');
                    disableBtn("enable");
                }

                function setEnabled() {
                    UE.getEditor('container').setEnabled();
                    enableBtn();
                }

                function getText() {
                    //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
                    var range = UE.getEditor('container').selection.getRange();
                    range.select();
                    var txt = UE.getEditor('container').selection.getText();
                    alert(txt)
                }

                function getContentTxt() {
                    var arr = [];
                    arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
                    arr.push("编辑器的纯文本内容为：");
                    arr.push(UE.getEditor('container').getContentTxt());
                    alert(arr.join("\n"));
                }
                function hasContent() {
                    var arr = [];
                    arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
                    arr.push("判断结果为：");
                    arr.push(UE.getEditor('container').hasContents());
                    alert(arr.join("\n"));
                }
                function setFocus() {
                    UE.getEditor('container').focus();
                }
                function deleteEditor() {
                    disableBtn();
                    UE.getEditor('container').destroy();
                }
                function disableBtn(str) {
                    var div = document.getElementById('btns');
                    var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
                    for (var i = 0, btn; btn = btns[i++];) {
                        if (btn.id == str) {
                            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                        } else {
                            btn.setAttribute("disabled", "true");
                        }
                    }
                }
                function enableBtn() {
                    var div = document.getElementById('btns');
                    var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
                    for (var i = 0, btn; btn = btns[i++];) {
                        UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                    }
                }

                function getLocalData () {
                    alert(UE.getEditor('container').execCommand( "getlocaldata" ));
                }

                function clearLocalData () {
                    UE.getEditor('container').execCommand( "clearlocaldata" );
                    alert("已清空草稿箱")
                }
                </script>





        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="publish_date" class="col-md-3 control-label">
                发布日期
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_date" id="publish_date"
                       type="text" value="{{ $publish_date }}">
            </div>
        </div>
        <div class="form-group">
            <label for="publish_time" class="col-md-3 control-label">
                发布时间
            </label>
            <div class="col-md-8">
                <input class="form-control" name="publish_time" id="publish_time"
                       type="text" value="{{ $publish_time }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input {{ checked($is_draft) }} type="checkbox" name="is_draft">
                        草稿?
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="grades" class="col-md-3 control-label">
                分类:
            </label>
            <div class="col-md-8">
                <select name="grades[]" id="grades" class="form-control" multiple>
                    @foreach ($allGrades as $grade)
                        <option @if (in_array($grade, $grades)) selected @endif
                        value="{{ $grade }}">
                            {{ $grade }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="layout" class="col-md-3 control-label">
                布局
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="layout"
                       id="layout" value="{{ $layout }}">
            </div>
        </div>
        <div class="form-group">
            <label for="meta_description" class="col-md-3 control-label">
                内容描述
            </label>
            <div class="col-md-8">
        <textarea class="form-control" name="meta_description"
                  id="meta_description"
                  rows="6">{{ $meta_description }}</textarea>
            </div>
        </div>

    </div>
</div>