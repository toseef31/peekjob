@extends('frontend.layouts.app')

@section('title','Post New Job')

@section('content')
<!--Jobs section start-->
<section id="chat">
    <div class="container"> 
        <div id="cometchat_embed_synergy_container" style="width:1000px;height:500px;max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;" ></div>
        <script src="/cometchat/js.php?type=core&name=embedcode" type="text/javascript"></script>
        <script>var iframeObj = {};iframeObj.module="synergy";iframeObj.style="min-height:420px;min-width:350px;";iframeObj.width="1000px";iframeObj.height="500px";iframeObj.src="/cometchat/cometchat_embedded.php"; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(iframeObj);}</script>
    </div>
</section>        
@endsection