@extends('en.layouts.default')

@section('content')


<!-- ====================== Calculator Section Start ===================== -->

<section id="Projects" class="container mt-5"> 
  <div class="projects">
    <div class="row sectionHeading">
      <h1 class="text-center CLR">Projects</h1>
      <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
    </div>
   
    <div class=" " >
    <!-- -----Tab start----- -->
        <div class="row" >
            <div class="table-responsive p-0">
                <table class="table mb-0">
                  <thead class="nav nav-pills mb-0 justify-content-center" id="pills-tab" role="tablist">
                    <tr>
                      <th scope="col-5" class="nav-item" role="presentation"><button class="nav-link active" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="true">Projects completed</button></th>
                      <th scope="col"class="nav-item" role="presentation"><button class="nav-link" id="pills-seasonal-tab" data-bs-toggle="pill" data-bs-target="#pills-seasonal" type="button" role="tab" aria-controls="pills-seasonal" aria-selected="false">Seasonal projects</button></th>
                      <th scope="col" class="nav-item" role="presentation"><button class="nav-link" id="pills-permanent-tab" data-bs-toggle="pill" data-bs-target="#pills-permanent" type="button" role="tab" aria-controls="pills-permanent" aria-selected="false">Permanent projects</button></th>
                      <th scope="col"class="nav-item" role="presentation"><button class="nav-link " id="pills-current-tab" data-bs-toggle="pill" data-bs-target="#pills-current" type="button" role="tab" aria-controls="pills-current" aria-selected="false">Current projects</button></th>
                      <th scope="col" class="nav-item" role="presentation"><button class="nav-link" id="pills-construction-tab" data-bs-toggle="pill" data-bs-target="#pills-construction" type="button" role="tab" aria-controls="pills-construction" aria-selected="false">Construction</button></th>
                      <th scope="col"class="nav-item" role="presentation"><button class="nav-link" id="pills-developmental-tab" data-bs-toggle="pill" data-bs-target="#pills-developmental" type="button" role="tab" aria-controls="pills-developmental" aria-selected="false">Developmental social</button></th>
                      <th scope="col" class="nav-item" role="presentation"><button class="nav-link" id="pills-sacrifice-tab" data-bs-toggle="pill" data-bs-target="#pills-sacrifice" type="button" role="tab" aria-controls="pills-sacrifice" aria-selected="false">The sacrifice project 1441</button></th>
                      <th scope="col"class="nav-item" role="presentation"><button class="nav-link" id="pills-charity-tab" data-bs-toggle="pill" data-bs-target="#pills-charity" type="button" role="tab" aria-controls="pills-charity" aria-selected="false"> Charity deduction</button></th> 
                    </tr>
                  </thead>
                </table>
              </div>
           
            <div class="tab-content mt-3" id="pills-tabContent">
			
            <!-- ---- Tab-1 ----- -->
            <div class="tab-pane fade show active" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab" tabindex="0">
				
				 <!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_01" id="project_id_01" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($completeprojects as $key => $completeproject) 
                                <option value="{{$completeproject->project_id}}">{{$completeproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_01" id="category_id_01"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_01" id="countryname_01"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_01" id="searchcost_01" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100" onclick="getdata(0,1)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_01">
                 @include('en.pages.data.completeproject_data')
                </div>
              </div>
            <!-- ---- Tab-2 ----- -->
            <div class="tab-pane fade" id="pills-seasonal" role="tabpanel" aria-labelledby="pills-seasonal-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_12" id="project_id_12" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($seasonalprojects as $key => $seasonalproject) 
                                <option value="{{$seasonalproject->project_id}}">{{$seasonalproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_12" id="category_id_12"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_12" id="countryname_12"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_12" id="searchcost_12" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100" onclick="getdata(1,2)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_12">
                @include('en.pages.data.seasonalproject_data')
                </div>
            </div>
            <!-- ---- Tab-3 ----- -->
            <div class="tab-pane fade" id="pills-permanent" role="tabpanel" aria-labelledby="pills-permanent-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_22" id="project_id_22" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($permanentprojects as $key => $permanentproject) 
                                <option value="{{$permanentproject->project_id}}">{{$permanentproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_22" id="category_id_22"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_22" id="countryname_22"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_22" id="searchcost_22" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100" onclick="getdata(2,2)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_22">
                @include('en.pages.data.permanentproject_data')
                </div>
            </div>
            <!-- ---- Tab-4 ----- -->
            <div class="tab-pane fade" id="pills-current" role="tabpanel" aria-labelledby="pills-current-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_00" id="project_id_00" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($currentprojects as $key => $currentproject) 
                                <option value="{{$currentproject->project_id}}">{{$currentproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_00" id="category_id_00"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_00" id="countryname_00"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_00" id="searchcost_00" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100"  onclick="getdata(0,0)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_00">
              @include('en.pages.data.currentproject_data')
                </div>
            </div>
            <!-- ---- Tab-5 ----- -->
            <div class="tab-pane fade" id="pills-construction" role="tabpanel" aria-labelledby="pills-construction-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_42" id="project_id_42" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($constructionprojects as $key => $constructionproject) 
                                <option value="{{$constructionproject->project_id}}">{{$constructionproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_42" id="category_id_42"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_42" id="countryname_42"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_42" id="searchcost_42" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100"  onclick="getdata(4,2)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_42">
                  @include('en.pages.data.constructionproject_data')
                </div>
            </div>
            <!-- ---- Tab-6 ----- -->
            <div class="tab-pane fade" id="pills-developmental" role="tabpanel" aria-labelledby="pills-developmental-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_52" id="project_id_52" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($developmentalsocialprojects as $key => $developmentalsocialproject) 
                                <option value="{{$developmentalsocialproject->project_id}}">{{$developmentalsocialproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_52" id="category_id_52"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_52" id="countryname_52"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_52" id="searchcost_52" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100"  onclick="getdata(5,2)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_52">
              @include('en.pages.data.developmentalsocialproject_data')
                </div>
            </div>
            <!-- ---- Tab-7 ----- -->
            <div class="tab-pane fade" id="pills-sacrifice" role="tabpanel" aria-labelledby="pills-sacrifice-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_62" id="project_id_62" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($sacrificeprojects as $key => $sacrificeproject) 
                                <option value="{{$sacrificeproject->project_id}}">{{$sacrificeproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_62" id="category_id_62"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_62" id="countryname_62"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_62" id="searchcost_62" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100"  onclick="getdata(6,2)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_62">
               @include('en.pages.data.sacrificeproject_data')
                </div>
            </div>
            <!-- ---- Tab-8 ----- -->
            <div class="tab-pane fade" id="pills-charity" role="tabpanel" aria-labelledby="pills-charity-tab" tabindex="0">
				<!-- ---  filter Start--- -->
            <div class="filter mb-3">
                <div class="row justify-content-center ">
                    <div class="col-md-4">
                        <select class="form-select" name="project_id_72" id="project_id_72" aria-label="Default select example">
                            <option  value="" selected>Project name</option>
                              @foreach ($charitydeductionprojects as $key => $charitydeductionproject) 
                                <option value="{{$charitydeductionproject->project_id}}">{{$charitydeductionproject->project_name}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select value="" class="form-select"  name="category_id_72" id="category_id_72"   aria-label="Default select example">
                            <option value="" selected>Project type</option>
                            @foreach ($categorys as $key => $category) 
                            <option value="{{$category->id }}">{{$category->title}}</option>
                             @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select"  name="countryname_72" id="countryname_72"  aria-label="Default select example">
                            <option value="" selected>Country</option>
                            @foreach ($countrys as $key => $country) 
                            <option value="{{$country->id }}">{{$country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text"  name="searchcost_72" id="searchcost_72" class="form-control" id="exampleInput" placeholder="Cost">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn BTN-1 w-100" onclick="getdata(7,2)">Submit</button> 
                    </div>
                </div>
            </div>

            <!-- --- tab-filter End--- -->	
                <div class="row" id="listdata_72">
				@include('en.pages.data.charitydeductionproject_data')	
                </div>
            </div>
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
    function getdata(typeid,status) {
		
    var project_id = $('#project_id_'+typeid+''+status).val();
    var category_id = $('#category_id_'+typeid+''+status).val();
    var countryname = $('#countryname_'+typeid+''+status).val();
    var searchcost = $('#searchcost_'+typeid+''+status).val();
    

    $.ajax({
        url: "{{ route('projects',app()->getLocale()) }}",
        type: "GET",
        datatype: "html",
        data: {
            'project_id': project_id,
            'category_id': category_id,
            'countryname': countryname,
            'searchcost': searchcost,
            'typeid':typeid,
            'status':status,
           
        },
        success: function(data) {
		
            $('#listdata_'+typeid+''+status).empty().html(data);
        }
		})
	}
  
</script>
@stop
