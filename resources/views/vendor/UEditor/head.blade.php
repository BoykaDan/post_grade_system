<script src="{!!asset('/laravel-u-editor/ueditor.config.js')!!}"></script>
<script src="{!!asset('/laravel-u-editor/ueditor.all.min.js')!!}"></script>
{{-- 载入语言文件,根据laravel的语言设置自动载入 --}}
<script src="{!!asset($UeditorLangFile)!!}"></script>

<!-- 配置文件 -->
<script src="{!!asset('/laravel-u-editor/ueditor.config.js')!!}"></script>

<!-- 编辑器源码文件 -->
<script src="{!!asset('/laravel-u-editor/ueditor.all.js')!!}"></script>

<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        initialFrameHeight : 800,
    });
    ue.ready(function(){
        //因为Laravel有防csrf防伪造攻击的处理所以加上此行
        ue.execCommand('serverparam','_token','{{ csrf_token() }}');
    });

</script>