@extends('admin.layouts.app')

@section('content')

<div class="card-body mt-0">
    <h4 class="card-title">Add Project</h4>

    <form autocomplete="off" id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('project.store') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="newstype required">Project Type</label>

            <select class="form-control required" id="newstype" name="project_type">
                <option value="">select</option>
                @if(!$Ptype->isEmpty())
                @foreach($Ptype as $protyp)
                <option value="{{$protyp->id}}">{{$protyp->type}}</option>
                @endforeach
                @endif
            </select>

            @error('project_type')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="newstype required">Project Category</label>

            <select class="form-control required" id="newstype" name="project_category">
                <option value="">Select</option>
                @if(!$PCategor->isEmpty())
                @foreach($PCategor as $proCat)

                <option value="{{$proCat->id}}">{{$proCat->title}}</option>
                @endforeach
                @endif
            </select>

            @error('project_category')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>


        <div class="form-group">
            <label for="newstype required">Project Continents</label>

            <select class="form-control required" id="newstype" name="project_continents">
                <option value="">Select</option>
                @if(!$Pcontinent->isEmpty())
                @foreach($Pcontinent as $proCon)

                <option value="{{$proCon->title}}">{{$proCon->title}}</option>
                @endforeach
                @endif
            </select>

            @error('project_continents')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="newstype required">Project Country</label>

            <select class="form-control required" id="project_country" name="project_country">
                <option value="">Select</option>
                @if(!$Pcountry->isEmpty())
                @foreach($Pcountry as $proCoun)

                <option value="{{$proCoun->country}}">{{$proCoun->country}}</option>
                @endforeach
                @endif
            </select>

            @error('project_country')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Project Name (AR)</label>
            <input type="text" class="form-control required" id="project_name_ar" placeholder="Name" name="project_name_ar" />

            @error('project_name_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Project Name</label>
            <input type="text" class="form-control required" id="project_name" placeholder="Name" name="project_name" />

            @error('project_name')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Project Title</label>
            <input type="text" class="form-control required" id="title" placeholder="Name"
                name="title" />

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Project Title (AR)</label>
            <input type="text" class="form-control required" id="title_ar" placeholder="Name"
                name="title_ar" />

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Project Price</label>
            <input type="text" class="form-control required" id="project_price" placeholder="Amount"
                name="project_price" />

            @error('project_price')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Project Amount</label>
            <input type="text" class="form-control required" id="target_amount" placeholder="Amount"
                name="target_amount" />

            @error('target_amount')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Project qnty</label>
            <input type="text" class="form-control required" id="qnty" placeholder="qnty" name="qnty" />

            @error('qnty')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">From Date</label>
            <div id="datepicker-popup" class="input-group date datepicker">
                <input type="text" class="form-control" placeholder="date" name="from_date">
                <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                </span>
            </div>

            @error('from_date')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">To Date</label>
            <div id="datepicker-popups" class="input-group date datepicker">
                <input type="text" class="form-control" placeholder="date" name="to_date">
                <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                </span>
            </div>
            <!-- <input type="date" class="form-control required" id="to_date" placeholder="date" name="to_date" /> -->

            @error('to_date')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Year</label>
            <input type="text" class="form-control required" id="year" placeholder="year" name="year" />

            @error('year')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>


        <div class="form-group">
            <label for="title">Project Description</label>
            <textarea class="form-control required" id="description" placeholder="Enter text here..." name="description"> </textarea>
            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Project Description (AR)</label>
            <!-- <input type="text" class="form-control required" id="to_date" placeholder="Name" name="description"/> -->
            <textarea class="form-control required" id="description_ar" placeholder="Enter text here..." name="description_ar"> </textarea>
            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group ">
            <label for="title">Main Project</label><br>


            <div class="col-sm-5">
                <div class="form-radio">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="main_project" id="membershipRadios2"
                            value="Yes" checked="">
                        Yes
                        <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-radio">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="main_project" id="membershipRadios2"
                            value="No" checked="">
                        No
                        <i class="input-helper"></i></label>
                </div>
            </div>

            @error('main_project')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Target</label>
            <div class="col-sm-5">
                <div class="form-radio">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="target" id="membershipRadios2" value="Yes"
                            checked="">
                        Yes
                        <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-radio">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="target" id="membershipRadios2" value="No"
                            checked="">
                        No
                        <i class="input-helper"></i></label>
                </div>
            </div>


            @error('target')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Featured</label>
            <div class="col-sm-5">
                <div class="form-radio">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="featured" id="membershipRadios2" value="Yes"
                            checked="">
                        Yes
                        <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-radio">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="featured" id="membershipRadios2" value="No"
                            checked="">
                        No
                        <i class="input-helper"></i></label>
                </div>
            </div>

            @error('featured')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Url</label>
            <input type="url" class="form-control required" id="to_date" placeholder="url" name="short_url" />

            @error('short_url')
            <label id="title-error" class="alert alert-danger" for="short_url"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
            </div>
        </div>
        @error('image')
        <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
        @enderror
        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('project.index') }}" class="btn btn-outline-danger">Cancel</a>
    </form>

</div>
<script>
$(document).ready(function() {
    // $('#baseForm').validate();
    /*Tinymce editor*/

    if ($("#datepicker-popup".length)) { 
        $('#datepicker-popup').datepicker({
            enableOnReadonly: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
        $('#datepicker-popups').datepicker({
            enableOnReadonly: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    }
});

$(document).ready(function() {
    /*Tinymce editor*/
    if ($("#description,#description_ar").length) {
        tinymce.init({
            selector: '#description,#description_ar',
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
@endsection