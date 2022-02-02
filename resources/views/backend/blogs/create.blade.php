@extends('backend.layout')
@section('content')
<section class="content-header">
   <div class="box box-primary">
      <div clas="box-header width-border">
        <h3 class="box-title">Blog Düzenleme Sayfası</h3>
      </div>
      <div class="box-body">
 <form action="#" method="post" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
          <label>Açıklama</label>
          <div class="row">
            <div class="col-xs-12">
             <input  class="form-control" readonly type="text">
            </div>
          </div>
      </div>
      <div class="form-group">
            <label>Resim Seç</label>
            <div class="row">
              <div class="col-xs-12">
               <input  class="form-control"  type="file">
              </div>
            </div>
      </div>

     <div class="form-group">
          <label>İçerik</label>
          <div class="row">
            <div class="col-xs-12">
             <textarea class="form-control" id="editor1"></textarea>
               <script>
              CKEDITOR.replace('editor1');
               </script>
            </div>
          </div>
      <!---  <input type="hidden" name="old_file" value="{{$settings->settings_value}}">-->
          <div align="right" class="box-footer">
            <button type="submit" class="btn btn-success">Düzenle</button>
          </div>
        </div>
      </form>
      </div>
   </div>
</section>

@endsection
@section('css')@endsection
@section('js')@endsection
