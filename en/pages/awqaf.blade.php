@extends('en.layouts.default')

@section('content')
<!-- ====================== Calculator Section Start ===================== -->

<section id="Projects" class="container mt-5">
  <div class="projects">
    <div class="row sectionHeading">
      <h1 class="text-center CLR">Awaqf</h1>
      <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
    </div>
   
    <div class=" " >
    <!-- -----Tab start----- -->
        <div class="row" >
            <!-- ---  filter Start--- -->
            <div class="filter">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id" id="project_id" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($awqafprojects as $key => $awqafproject) 
                                <option value="{{$awqafproject->project_id}}">{{$awqafproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id" id="category_id"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname" id="countryname"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost" id="searchcost" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100" onclick="getdata()">Submit</button> 
                    </div>
                </div>
            </div>


            <div class="row mt-4" id="listdata">
				 @include('en.pages.data.awqaf_data')
                
            </div>
           
            
        </div>
    <!-- -----Tab end----- --> 
    </div>
  </div>
</section>
<!-- ====================== Projects Section End ===================== -->
<script type="text/javascript">
    function addtocart(route,id)
    {
		var project_price = $('#'+id).val();
        $.ajax({
            url: route,
            method: "get",
            data: {
                _token: '{{ csrf_token() }}', 
                project_price: project_price, 
            },
            success: function (response) {
               window.location.reload();
            }
        });
    }
    function donatenow(route,id)
    {
		var project_price = $('#'+id).val();
        $.ajax({
            url: route,
            method: "get",
            data: {
                _token: '{{ csrf_token() }}', 
                project_price: project_price, 
            },
            success: function (response) {
               location.href= '{{ route('cart',app()->getLocale()) }}'
            }
        });
    }
    
    function getdata() {
		
    var project_id = $('#project_id').val();
    var category_id = $('#category_id').val();
    var countryname = $('#countryname').val();
    var searchcost = $('#searchcost').val();

    $.ajax({
        url: "{{ route('awqaf',app()->getLocale()) }}",
        type: "GET",
        datatype: "html",
        data: {
            'project_id': project_id,
            'category_id': category_id,
            'countryname': countryname,
            'searchcost': searchcost,
        },
        success: function(data) {
		
            $('#listdata').empty().html(data);
        }
		})
	}
   
  
</script>
@stop
