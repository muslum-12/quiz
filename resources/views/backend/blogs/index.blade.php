@extends('backend.layout')
@section('content')
<section class="content-header">
   <div class="box box-primary">
      <div clas="box-header width-border">
        <h3 class="box-title">Blog Sayfası</h3>
        <div align="right">
          <a href="{{route('blog.create')}}"><button class="btn btn-success">Yeni Ekle</button></a>
        </div>
      </div>
     <div class="box-body">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Başlık</th>
              <th></th>
              <th></th>
            </tr>
            <tbody id="sortable">
              @foreach ($data['blog'] as $blog)
              <tr id="item-{{$blog->id}}">
                <td class="sortable">{{$blog['blog_title']}}</td>
                <td width="5"><a href="{{route('settings.Edit',['id'=>$blog->id])}}"><i class="fa fa-pencil-square"></i></a></td>
                <td width="5"><a href="javascript:void(0)"><i id="@php echo $blog->id @endphp"class="fa fa-trash-o"></i></a></td>
              </tr>
              @endforeach
            </tbody>
          </thead>
          </table>
      </div>
   </div>
</section>
<script type="text/javascript">
     $(function(){

         $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $('#sortable').sortable({
             revert: true,
             handle: ".sortable",
             stop: function (event, ui) {
                 var data = $(this).sortable('serialize');
                 $.ajax({
                     type: "POST",
                     data: data,
                     url: "{{route('blog.Sortable')}}",
                     success: function (msg) {
                         // console.log(msg);
                         if (msg) {
                alertify.success("İşlem Başarılı");
                         } else {
                             alertify.error("işlem Başarısız");
                         }
                     }
                 });

             }
         });
         $('#sortable').disableSelection();

     });
// ajaxla veri silme
$(".fa-trash-o").click(function(){
  destroy_id=$(this).attr('id');

  alertify.confirm('Silme İşlemini Onaylayın!','Bu İşlem Geri Alınamaz',
  function(){
 $.ajax({
   type:"DELETE",
   url:"blog/"+destroy_id,
   success:function(msg){
      if(msg)
      {
        $("#item-"+destroy_id).remove();
        alertify.success("Silme İşlem Tamamlandı");
      }else{
        alertify.error(" Silme İşlem Tamamlanmadı");
      }
   }
 });


  },
  function(){
    alertify.error('Silme İşlemi İptal Edildi');
  }
)
});







 </script>
@endsection
@section('css')@endsection
@section('js')@endsection
