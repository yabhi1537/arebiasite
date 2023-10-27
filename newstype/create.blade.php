@extends('admin.layouts.app')

@section('content') 
<div class="card-body mt-0"> 
                  <h4 class="card-title">Add News Type</h4>

                  <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('newstype.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label for="title">News Type</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="type">
                    
                    @error('type')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="title">News Type (AR)</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="type_ar">
                    
                    @error('type_ar')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{ route('newsType.index') }}" class="btn btn-outline-danger">Cancel</a>
                  </form>
                </div>
 
                @endsection


<script>
  $(document).ready(function() {
    // $('#baseForm').validate();
  
/*Tinymce editor*/
  if ($("#description").length) {
    tinymce.init({
      selector: '#description',
      height: 500,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
      ],
      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
      image_advtab: true,
      templates: [{
          title: 'Test template 1',
          content: 'Test 1'
        },
        {
          title: 'Test template 2',
          content: 'Test 2'
        }
      ],
      content_css: []
    });
  }
  });

</script>
